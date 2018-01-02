<?php
    require_once 'Artikel.php';
    class Warenkorb{
        private $email;
        private $bestellNr;
        private $waren = [];
        private $anzahl = 0;
        
        public function __construct($email){
            $this->email = $email;
        }
        
        //copy constructor
        public static function copy($obj){
            $instance = new self($obj->getEmail());
            $this->bestellNr = $obj->getBestellnummer();
            $this->waren = $obj->getWaren();
            $this->anzahl = $obj->getAnzahl();
            return $instance;
        }
        
        //rechnet die Umsatzsteuer mit 10 % für Lebensmittel aus
        public function getUst($brutto){
            $ust = ($brutto*10)/100;
            if (($ust*10)%10 != 0 || ($ust*100)%10 != 0){
		$ust = $ust*100;
		$ust = (int)$ust;
		$ust = $ust/100;
            }
            return $ust;
        }
        
        //setzt die Bestellnummer und inkrementiert sie für die nächste Bestellung in der Datenbank 
        public function setBestellNr(){
            $db = new SQLite3('../backshop.db');
            $sql = "SELECT * FROM bestellnummerzaehler";
            $list = $db->query($sql);
            while($row = $list->fetchArray()){
                $this->bestellNr = $row['nr'];
            }
            $sql = "UPDATE bestellnummerzaehler set nr=nr+1 where nr=" . $this->bestellNr;
            $db->exec($sql);
        }
        
        //speichert einen bestellten Artikel
        public function setWare($ware){
            $obj = Artikel::copy($ware);
            $this->waren[$this->anzahl] = $obj;
            $this->anzahl++;
        }
        
        public function getBestellnummer(){
            return $this->bestellNr;
        }
        
        public function getEmail(){
            return $this->email;
        }
        
        public function getWaren(){
            return $this->waren;
        }
        
        public function getAnzahl(){
            return $this->anzahl;
        }
    }
?>

