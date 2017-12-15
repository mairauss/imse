<?php
    class Person{
        private $nr;
        private $name;
                    
        public function __construct($nr, $name){
           $this->setName($name);
           $this->setNr($nr);
        }
        
        public function __destruct() {
            unset($this->name);
            unset($this->nr);
        }
        
        public function getName(){
            return $this->name;
        }
        
        public function getNr(){
            return $this->nr;
        }
        
        public function setName($name){
            $this->name = $name;
        }
        
        public function setNr($nr){
            $this->nr = $nr;
        }
    }
?>

<?php
    class Buch{
        private $isbnr;
        private $titel;
        private $person;
        
        public function __construct($isbnr, $titel, $person){
            $this->isbnr = $isbnr;
            $this->titel = $titel;
            $this->person = $person;
        }
        
        public function __destruct() {
            unset($this->isbnr);
            unset($this->titel);
            unset($this->person);
        }
        
        public function getPersonDaten(){
            return $this->person->getNr(). " ". $this->person->getName();
        }
        
        public function getPerson(){
            return $this->person;
        }
        
        public function getBuch(){
            return $this->isbnr . " " . $this->titel;
        }
        
        public function getIsbn(){
            return $this->isbnr;
        }
        
        public function getTitel(){
            return $this->titel;
        }
        
        public function createTable(){
            $db = new SQLite3('myDB.db');
            $sqlCreate = 'CREATE TABLE buch (
                         isbnr int not null,
                         titel text not null,
                         person_nr int,
                         name text,
                         primary key(isbnr)
                         )';
            $db->query($sqlCreate);
        }
        
        public function saveBuch(){
            $db = new SQLite3('myDB.db');
            if (($db->query('select 1 from buch limit 1')) == TRUE){
                $sqlInsert = 'insert into buch values (' . $this->getIsbn() . ", '" .  $this->getTitel() . "', " . $this->getPerson()->getNr() . ", '" . $this->getPerson()->getName() . "')";
                $db->query($sqlInsert);
            } else {
                echo 'Tabelle existiert nicht';
            }
        }
        
        public function selectBuch(){
            $db = new SQLite3('myDB.db');
            if (($db->query('select 1 from buch limit 1')) == TRUE) {
                $sqlSelect = 'select * from buch';
                $result = $db->query($sqlSelect);
                while ($row = $result->fetchArray()){
                    echo $row['isbnr'] . " " . $row['titel'] . " gehört: \n";
                    echo "   " . $row['person_nr'] . " " . $row['name'];
                    echo "<br/>"; //Zeilenumbruch
                }
            } else {
                echo 'Tabelle existiert nicht';
            }  
        }
    }
?>
