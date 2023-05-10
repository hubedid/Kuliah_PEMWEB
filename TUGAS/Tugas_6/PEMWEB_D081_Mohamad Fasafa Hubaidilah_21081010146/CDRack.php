<?php
// require("Product.php");
    class CDRack extends Product{
        protected $capacity, $model;
        public function __construct($name){
            parent::__construct($name);
        }
        public function getCapacity(){
            return $this->capacity;
        }
        public function getModel(){
            return $this->model;
        }
        public function setCapacity($capacity){
            $this->capacity = $capacity;
        }
        public function setModel($model){
            $this->model = $model;
        }
        public function setPrice($price){
            parent::setPrice($price + ($price * (15 / 100)));
        }
    }
