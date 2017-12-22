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
        
        public function insertArtikel(){
            $db = new SQLite3('backshop.db');
            $sql = "INSERT INTO backwaren VALUES "
                    . "(" . $this->artikelnr .", '" . $this->bhersdatum . "', '" . $this->gname . "', " . $this->preis . ", '" . $this->bhaltdauer . "', " . $this->lagerMenge . ")";
            $result = $db->exec($sql);
            $db->close();
            unset($db);
            return $result;
        }
        
        public function insertArtikelOhneBhaltdauer(){
            $db = new SQLite3('backshop.db');
            $sql = "INSERT INTO backwaren (artikelnr, bhersdatum, gname, bpreis, menge) values " .
                   "(" . $this->artikelnr . ", '" . $this->bhersdatum . "', '" . $this->gname . "', " . $this->preis . ", " . $this->lagerMenge . ")";
            $result = $db->exec($sql);
            $db->close();
            unset($db);
            return $result;
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
            return $this->getPreis();
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