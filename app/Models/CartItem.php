<?php
namespace App\Models;

class CartItem {
  public $prod;
  public $quantity;
  public function __construct($prod, $quantity) 
  {
    $this->prod = $prod;
    $this->quantity = $quantity;
  }
}