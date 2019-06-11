<?php

namespace Bingo;

class Carton implements CartonInterface {

  private $numeros_carton = [];

  public function __construct(array $aux) {
    $this->numeros_carton = array_map(null, $aux[0], $aux[1], $aux[2], $aux[3], $aux[4], $aux[5], $aux[6], $aux[7], $aux[8]);
  }
    
   /**
   * {@inheritdoc}
   */
  public function filas() {
    return $this->numeros_carton;
  }

  /**
   * {@inheritdoc}
   */
  public function columnas() {
    $cols = [];
    
    $filas = $this->filas();
    $cols = array_map(null, $filas[0], $filas[1], $filas[2]);
    
    return $cols;
  }
  
    /**
   * {@inheritdoc}
   */
  public function tieneNumero(int $numero) {
    return in_array($numero, $this->numerosDelCarton());
  }

}
