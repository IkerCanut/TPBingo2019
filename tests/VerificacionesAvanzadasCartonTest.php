<?php

namespace Bingo;

use PHPUnit\Framework\TestCase;

class VerificacionesAvanzadasCartonTest extends TestCase {

  /**
   * Verifica que los números del carton se encuentren en el rango 1 a 90.
   */
  public function testUnoANoventa() {
    $carton = new CartonEjemplo();
    foreach ($carton->numerosDelCarton() as $numero) {
        $this->assertTrue($numero <= 90 && $numero >= 1);
    }
  }

  /**
   * Verifica que cada fila de un carton tenga exactamente 5 celdas ocupadas.
   */
  public function testCincoNumerosPorFila() {
    $carton = new CartonEjemplo();
    foreach ($carton->filas() as $fila) {
        $contadorDeNumeros = 0;
        foreach ($fila as $numero) {
            if ($numero != 0){
                $contadorDeNumeros++;
            }
        }
        $this->assertEquals($contadorDeNumeros, 5);
    }
  }

  /**
   * Verifica que para cada columna, haya al menos una celda ocupada.
   */
  public function testColumnaNoVacia() {
    $carton = new CartonEjemplo();
    foreach ($carton->columnas() as $columna) {
        $contadorDeNumeros = 0;
        foreach ($columna as $numero) {
            if ($numero != 0){
                $contadorDeNumeros++;
            }
        }
        $this->assertTrue($contadorDeNumeros > 0);
    }
  }

  /**
   * Verifica que no haya columnas de un carton con tres celdas ocupadas.
   */
  public function testColumnaCompleta() {
    $carton = new CartonEjemplo();
    foreach ($carton->columnas() as $columna) {
        $contadorDeNumeros = 0;
        foreach ($columna as $numero) {
            if ($numero != 0) {
                $contadorDeNumeros++;
            }
        }
        $this->assertTrue($contadorDeNumeros < 3);
    }
  }

  /**
   * Verifica que solo hay exactamente tres columnas que tienen solo una celda
   * ocupada.
   */
  public function testTresCeldasIndividuales() {
    $carton = new CartonEjemplo();
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
    $this->assertEquals($contadorColumnasConUnElemento, 3);
  }

  /**
   * Verifica que los números de las columnas izquierdas son menores que los de
   * las columnas a la derecha.
   */
  public function testNumerosIncrementales() {
    $carton = new CartonEjemplo();
    $columnas = $carton->columnas();
    for($i=0, $j=1; $j<=9; $i++, $j++) {
        foreach ($columnas[$i] as $NumeroColumnaIzquierda) {
            foreach ($columnas[$j] as $NumeroColumnaDerecha) {
                if ($NumeroColumnaIzquierda != 0 && $NumeroColumnaDerecha != 0) {
                    $this->assertTrue($NumeroColumnaDerecha > $NumeroColumnaIzquierda);
                }
            }
        }
    }
  }

  /**
   * Verifica que en una fila no existan más de dos celdas vacias consecutivas.
   */
  public function testFilasConVaciosUniformes() {
    $carton = new CartonEjemplo();
    foreach($carton->filas() as $fila) {
        $contadorDeCerosConsecutivos = 0;
        foreach($fila as $numero) {
            if ($numero == 0){
                $contadorDeCerosConsecutivos++;
            } else {
                $contadorDeCerosConsecutivos = 0;
            }
            $this->assertTrue($contadorDeCerosConsecutivos < 3);
        }
    }
  }

}
