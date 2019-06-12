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
  public function filas() {
    return $this->numeros_carton;
  }

  /**
   * {@inheritdoc}
   */
  public function columnas() {
    $cls = [];
    
    $filas = $this->filas();
    $cls = array_map(null, $filas[0], $filas[1], $filas[2]);
    
    return $cls;
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
