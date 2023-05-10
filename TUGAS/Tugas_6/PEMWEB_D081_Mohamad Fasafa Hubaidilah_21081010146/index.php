<?php
require("Product.php");
require("cdMusic.php");
require("CDRack.php");
// Class Product
echo "------------------- Class Product : -------------------";
$produk = new Product("Product Mantap");
echo "\nNama Product : " . $produk->getName();
$produk->setPrice(80000);
echo "\nHarga Product : Rp " . $produk->getPrice();
$produk->setDiscount(10);
echo "\nDiscount Product : " . $produk->getDiscount() . "%";
$hargaSetelahDiskonProduct = $produk->getPrice() - ($produk->getPrice() * ($produk->getDiscount() / 100));
echo "\nHarga Setelah Diskon : Rp " . $hargaSetelahDiskonProduct;
echo "\n--------------------------------------------------------";

// Class CDMusic
echo "\n\n------------------- Class CDMusic ----------------------";
$cdMusic = new cdMusic("Siang Sebrang Sebuah Istana");
echo "\nNama cdMusic : " . $cdMusic->getName();
$cdMusic->setArtist("Iwan Fals");
echo "\nArtist : " . $cdMusic->getArtist();
$cdMusic->setGenre("Country");
echo "\nGenre : " . $cdMusic->getGenre();
$cdMusic->setPrice(100000);
echo "\nHarga CDMusic : Rp " . $cdMusic->getPrice();
$cdMusic->setDiscount(12);
echo "\nDiscount CDMusic : " . $cdMusic->getDiscount() . "%";
$hargaSetelahDiskoncdMusic = $cdMusic->getPrice() - ($cdMusic->getPrice() * ($cdMusic->getDiscount() / 100));
echo "\nHarga Setelah Diskon : Rp " . $hargaSetelahDiskoncdMusic;
echo "\n--------------------------------------------------------";

// Class CDRack
echo "\n\n-------------------- Class CDRack ----------------------";
$cdRack = new CDRack("Ini Class CDRack");
echo "\nNama CDRack : " . $cdRack->getName();
$cdRack->setCapacity(100);
echo "\nRack Capacity : " . $cdRack->getCapacity();
$cdRack->setModel("Leter L");
echo "\nModel Rack : " . $cdRack->getModel();
$cdRack->setPrice(2000000);
echo "\nHarga CDRack : Rp " . $cdRack->getPrice();
$cdRack->setDiscount(15);
echo "\nDiscount CDRack : " . $cdRack->getDiscount() . "%";
$hargaSetelahDiskoncdRack = $cdRack->getPrice() - ($cdRack->getPrice() * ($cdRack->getDiscount() / 100));
echo "\nHarga Setelah Diskon : Rp " . $hargaSetelahDiskoncdRack;
echo "\n--------------------------------------------------------";


