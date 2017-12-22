<?php
    class Warenkorb{
        private static $nr = 0;
        private $kundennummer;
        private $bestellNr;
        private $waren = [];
        private $anzahl = 0;
        
        public function __construct($kundennummer) {
            Warenkorb::$nr++;
            $this->bestellNr = Warenkorb::$nr;
            $this->kundennummer = $kundennummer;
        }
        
        public function setWare($ware){
            $this->waren[$this->anzahl] = $ware;
            $this->anzahl++;
        }
        
        
    }

?>

