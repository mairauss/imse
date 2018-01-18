<?php
 try{
	require_once('dbconnection.php');
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(Exception $e){
	$error = $e->getMessage();
}

if(isset($error)){ echo $error; }
?>

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
         
        public function setBestellNr($nr){
			$this->bestellNr = $nr; 
        }
        
        //speichert einen bestellte Backware
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

