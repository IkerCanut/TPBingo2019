<?php

namespace Bingo;

class Carton implements CartonInterface {

  private $numeros_carton = [];

  public function __construct(intentoCarton $intento) {
    $aux = $intentos->intentoCarton();
    $this->numeros_carton = array_map(null, $aux[0], $aux[1], $aux[2], $aux[3], $aux[4], $aux[5], $aux[6], $aux[7], $aux[8]);
  }
    
   /**
   * {@inheritdoc}
   */
  public function filas() {
    return [
      [0, 16, 0, 38, 47, 0, 67, 77, 0],
      [9, 0, 28, 35, 0, 55, 0, 0, 84],
      [0, 12, 26, 0, 45, 0, 61, 0, 89],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function columnas() {
    return [
      [0,9,0],
      [16,0,12],
      [0,28,26],
      [38,35,0],
      [47,0,45],
      [0,55,0],
      [67,0,61],
      [77,0,0],
      [0,84,89],
    ];
  }
  
    /**
   * {@inheritdoc}
   */
  public function tieneNumero(int $numero) {
    return in_array($numero, $this->numerosDelCarton());
  }

}
