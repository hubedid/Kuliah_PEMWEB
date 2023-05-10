<?php
// require("Product.php");
    class CDMusic extends Product{
        protected $artist, $genre;
        public function __construct($name){
            parent::__construct($name);
        }
        public function getArtist(){
            return $this->artist;
        }
        public function getGenre(){
            return $this->genre;
        }
        public function setArtist($artist){
            $this->artist = $artist;
        }
        public function setGenre($genre){
            $this->genre = $genre;
        }
        public function setPrice($price){
            parent::setPrice($price + ($price * (10 / 100)));
        }
        public function setDiscount($discount){
            parent::setDiscount($discount +  5);
        }
    }
