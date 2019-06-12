<?php

namespace Bingo;

class FabricaCartones {

  public function generarCarton() {
    while(1) {
        $carton = ($this->intentoCarton());
        $aux = array_map(null,$carton[0],$carton[1],$carton[2],$carton[3],$carton[4],$carton[5],$carton[6],$carton[7],$carton[8]);
        $CartonAux = new Carton($aux);
        if ($this->cartonEsValido($CartonAux)) {
          return ($aux);
        }
    }
  }

  protected function cartonEsValido(Carton $carton) {
    if ($this->validarUnoANoventa($carton) &&
      $this->validarCincoNumerosPorFila($carton) &&
      $this->validarColumnaNoVacia($carton) &&
      $this->validarColumnaCompleta($carton) &&
      $this->validarTresCeldasIndividuales($carton) &&
      $this->validarNumerosIncrementales($carton) &&
      $this->validarFilasConVaciosUniformes($carton)
    ) {
      return TRUE;
    }
    return FALSE;
  }

  protected function validarUnoANoventa(Carton $carton) {
    foreach ($carton->numerosDelCarton() as $numero) {
        if ($numero > 90 && $numero < 1) {
            return FALSE;
        }
    }
    return TRUE;
  }

  protected function validarCincoNumerosPorFila(Carton $carton) {
    foreach ($carton->filas() as $fila) {
        $contadorDeNumeros = 0;
        foreach ($fila as $numero) {
            if ($numero != 0){
                $contadorDeNumeros++;
            }
        }
        if ($contadorDeNumeros != 5) {
            return FALSE;
        }
    }
    return TRUE;
  }

  protected function validarColumnaNoVacia(Carton $carton) {
    foreach ($carton->columnas() as $columna) {
        $contadorDeNumeros = 0;
        foreach ($columna as $numero) {
            if ($numero != 0){
                $contadorDeNumeros++;
            }
        }
        if ($contadorDeNumeros == 0) {
            return FALSE;     
        }
    }
    return TRUE;
  }

  protected function validarColumnaCompleta(Carton $carton) {
    foreach ($carton->columnas() as $columna) {
        $contadorDeNumeros = 0;
        foreach ($columna as $numero) {
            if ($numero != 0) {
                $contadorDeNumeros++;
            }
        }
        if ($contadorDeNumeros >= 3) {
            return FALSE;
        }
    }
    return TRUE;
  }

  protected function validarTresCeldasIndividuales(Carton $carton) {
    $contadorColumnasConUnElemento = 0;
    foreach ($carton->columnas() as $columna) {
        $contadorDeNumeros = 0;
        foreach ($columna as $numero) {
            if ($numero != 0){
                $contadorDeNumeros++;
            }
        }
        if ($contadorDeNumeros == 1) {
            $contadorColumnasConUnElemento++;
        }
    }
    if ($contadorColumnasConUnElemento == 3) {
        return TRUE;
    }
    else {
        return FALSE;
    }
  }

  protected function validarNumerosIncrementales(Carton $carton) {
    $columnas = $carton->columnas();
    for($i=0, $j=1; $j<=8; $i++, $j++) {
        foreach ($columnas[$i] as $NumeroColumnaIzquierda) {
            foreach ($columnas[$j] as $NumeroColumnaDerecha) {
                if ($NumeroColumnaIzquierda != 0 && $NumeroColumnaDerecha != 0) {
                    if ($NumeroColumnaDerecha <= $NumeroColumnaIzquierda) {
                        return FALSE;
                    }
                }
            }
        }
    }
    return TRUE;
  }

  protected function validarFilasConVaciosUniformes(Carton $carton) {
    foreach($carton->filas() as $fila) {
        $contadorDeCerosConsecutivos = 0;
        foreach($fila as $numero) {
            if ($numero == 0){
                $contadorDeCerosConsecutivos++;
            } else {
                $contadorDeCerosConsecutivos = 0;
            }
            if ($contadorDeCerosConsecutivos >= 3) {
                return FALSE;
            }
        }
    }
    return TRUE;
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
