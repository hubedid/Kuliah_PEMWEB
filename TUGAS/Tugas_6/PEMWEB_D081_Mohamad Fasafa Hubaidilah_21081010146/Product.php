<?php
    class Product {
        protected $name, $price, $discount;
        public function __construct($name){
            $this->name = $name;
        }
        public function getPrice(){
            return $this->price;
        }
        public function getDiscount(){
            return $this->discount;
        }
        public function getName(){
            return $this->name;
        }
        public function setPrice($price){
            $this->price = $price;
        }
        public function setDiscount($discount){
            $this->discount = $discount;
        }
        public function setName($name){
            $this->name = $name;
        }
    }

// $produk = new Product("haosk");
// $produk->setName("sontol");
// echo $produk->getName();