<html>
    <header>
        <body>
            Hello World
            <?php
                require_once 'person.php';
                $var = 2;
                $wert = 1;
                echo $var+$wert . "\n";
                $obj1 = new Person(62, "Onur");
                //echo $buch->getBuch() . ", gehört " . $buch->getPersonDaten() , "<br/>"
            ?>
        </body>
    </header>
    <?php
        $buch = new Buch(343, "dcdccd", $obj1);
        //$buch->createTable();
        $buch->saveBuch();
        
        $buch->selectBuch();
    ?>
</html>