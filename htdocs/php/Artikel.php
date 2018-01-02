<?php
    class Artikel{
        private $artikelnr;
        private $bhersdatum;
        private $gname;
        private $preis;
        private $bhaltdauer = null;
        private $lagerMenge;
        private $bestellMenge = 0;
        
        public function __construct(){}
    
        public static function constructFull($artikelnr, $bhersdatum, $gname, $preis, $bhaltdauer, $lagerMenge){
            $instance = new self();
            $instance->artikelnr = $artikelnr;
            $instance->bhersdatum = $bhersdatum;
            $instance->gname = $gname;
            $instance->preis = $preis;
            $instance->bhaltdauer = $bhaltdauer;
            $instance->lagerMenge = $lagerMenge;
            return $instance;
        }
    
        public static function construct2($artikelnr, $bhersdatum, $gname, $preis, $lagerMenge){
            $instance = new self();
            $instance->artikelnr = $artikelnr;
            $instance->bhersdatum = $bhersdatum;
            $instance->gname = $gname;
            $instance->preis = $preis;
            $instance->lagerMenge = lagerMenge;
            return $instance;
        }
        
        public static function copy($obj){
            $instance = new self();
            $instance->artikelnr = $obj->getArtikelNr();
            $instance->gname = $obj->getGName();
            $instance->bhaltdauer = $obj->getBhaltdauer();
            $instance->bhersdatum = $obj->getBhersdatum();
            $instance->lagerMenge = $obj->getLagerMenge();
            $instance->preis = $obj->getPreis();
            $instance->bestellMenge = $obj->getBestellMenge();
            return $instance;
        }
        
        public function insertArtikel(){
            $db = new SQLite3('../backshop.db');
            $sql = "INSERT INTO backwaren VALUES "
                    . "(" . $this->artikelnr .", '" . $this->gname . "', '" . $this->preis . "', " . $this->bhersdatum . ", '" . $this->bhaltdauer . "', " . $this->lagerMenge . ")";
            $result = $db->exec($sql);
            $db->close();
            unset($db);
            return $result;
        }
        
        public function insertArtikelOhneBhaltdauer(){
            $db = new SQLite3('../backshop.db');
            $sql = "INSERT INTO backwaren (artikelnr, bhersdatum, gname, bpreis, menge) values " .
                   "(" . $this->artikelnr . ", '" . $this->gname . "', '" . $this->preis . "', " . $this->bhersdatum . ", " . $this->lagerMenge . ")";
            $result = $db->exec($sql);
            $db->close();
            unset($db);
            return $result;
        }
        
        public function updateLagermenge($artikelnr, $bhersdatum, $menge){
            $db = new SQLite3('../backshop.db');
            $sql = "UPDATE backwaren SET menge = menge-" . $menge . " WHERE artikelnr =" . $artikelnr . " AND bhersdatum =" . $bhersdatum ."";
            $result = $db->exec($sql);
            $db->close();
            unset($db);
            return $result;
        }
        
        public function mengeToNumber($menge){
            $zahl;
            if (isset($menge[1]) && $menge[1] != '"'){
                $zahl = $menge[1];
                for ($i = 2; isset($menge[$i]) && ($menge[$i] != '"'); $i++){
                    $zahl = $zahl . $menge[$i];
                }
                return $zahl;
            }
            return null;    
        }
        
        public function sucheArtikel($artikelnummer, $bhersdatum){
            
        }
        
        public function getArtikelNr(){
            return $this->artikelnr;
        }
        
        public function getBhersDatum(){
            return $this->bhersdatum;
        }
        
        public function getGName(){
            return $this->gname;
        }
        
        public function getPreis(){
            return $this->preis;
        }
        
        public function getBHaltDauer(){
            return $this->bhaltdauer;
        }
        
        public function getLagerMenge(){
            return $this->lagerMenge;
        }
        
        public function getBestellMenge(){
            return $this->bestellMenge;
        }
        
        public function setBestellMenge($bestellMenge){
            $this->bestellMenge = $bestellMenge;
        }
  }
?>