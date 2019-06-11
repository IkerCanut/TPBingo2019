<?php

namespace Bingo;

class FabricaCartones {

  public function generarCarton() {
    // Algo de pseudo-código para ayudar con la evaluacion.
    $carton = $this->intentoCarton();

    if ($this->cartonEsValido($carton)) {
      return $carton;
    }
  }

  protected function cartonEsValido($carton) {
    if (validarUnoANoventa($carton) &&
      validarCincoNumerosPorFila($carton) &&
      validarColumnaNoVacia($carton) &&
      validarColumnaCompleta($carton) &&
      validarTresCeldasIndividuales($carton) &&
      validarNumerosIncrementales($carton) &&
      validarFilasConVaciosUniformes($carton)
    ) {
      return TRUE;
    }
    return FALSE;
  }

  protected function validarUnoANoventa($carton) {
    $bandera = TRUE;
    foreach ($carton->numerosDelCarton() as $numero) {
        if ($numero > 90 && $numero < 1) {
            $bandera = FALSE;
        }
    }
    return $bandera;
  }

  protected function validarCincoNumerosPorFila($carton) {
    foreach ($carton->filas() as $fila) {
        $bandera = TRUE;
        $contadorDeNumeros = 0;
        foreach ($fila as $numero) {
            if ($numero != 0){
                $contadorDeNumeros++;
            }
        }
        if ($contadorDeNumeros != 5) {
            $bandera = FALSE;
        }
    }
    
    return $bandera;
  }

  protected function validarColumnaNoVacia($carton) {

  }

  protected function validarColumnaCompleta($carton) {

  }

  protected function validarTresCeldasIndividuales($carton) {

  }

  protected function validarNumerosIncrementales($carton) {

  }

  protected function validarFilasConVaciosUniformes($carton) {

  }

    // NO TOCAR
  public function intentoCarton() {
    $contador = 0;

    $carton = [
      [0,0,0],
      [0,0,0],
      [0,0,0],
      [0,0,0],
      [0,0,0],
      [0,0,0],
      [0,0,0],
      [0,0,0],
      [0,0,0]
    ];
    $numerosCarton = 0;

    while ($numerosCarton < 15) {
      $contador++;
      if ($contador == 50) {
        return $this->intentoCarton();
      }
      $numero = rand (1, 90);

      $columna = floor ($numero / 10);
      if ($columna == 9) { $columna = 8;}
      $huecos = 0;
      for ($i = 0; $i<3; $i++) {
        if ($carton[$columna][$i] == 0) {
          $huecos++;
        }
        if ($carton[$columna][$i] == $numero) {
          $huecos = 0;
          break;
        }
      }
      if ($huecos < 2) {
        continue;
      }

      $fila = 0;
      for ($j=0; $j<3; $j++) {
        $huecos = 0;
        for ($i = 0; $i<9; $i++) {
          if ($carton[$i][$fila] == 0) { $huecos++; }
        }

        if ($huecos < 5 || $carton[$columna][$fila] != 0) {
          $fila++;
        } else{
          break;
        }
      }
      if ($fila == 3) {
        continue;
      }

      $carton[$columna][$fila] = $numero;
      $numerosCarton++;
      $contador = 0;
    }

    for ( $x = 0; $x < 9; $x++) {
      $huecos = 0;
      for ($y =0; $y < 3; $y ++) {
        if ($carton[$x][$y] == 0) { $huecos++;}
      }
      if ($huecos == 3) {
        return $this->intentoCarton();
      }
    }

    return $carton;
  }


}
