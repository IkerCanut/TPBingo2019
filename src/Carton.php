<?php

namespace Bingo;

class Carton implements CartonInterface {

  private $numeros_carton = [];

  public function __construct(array $aux) {
    $this->numeros_carton = $aux;
  }
    
   /**
   * {@inheritdoc}
   */
  public function columnas() {
    return $this->numeros_carton;
  }

  /**
   * {@inheritdoc}
   */
  public function filas() {
    $fls = [];
    
    $columnas = $this->columnas();
    $fls = array_map(null, $columnas[0], $columnas[1], $columnas[2]);
    
    return $fls;
  }
  
    /**
   * {@inheritdoc}
   */
  public function tieneNumero(int $numero) {
    return in_array($numero, $this->numerosDelCarton());
  }

    public function numerosDelCarton() {
    $numeros = [];
    foreach ($this->filas() as $fila) {
      foreach ($fila as $celda) {
        if ($celda != 0) {
          $numeros[] = $celda;
        }
      }
    }
    return $numeros;
  }

}
