<?php
    /*if ($_SERVER["REQUEST_METHOD"] == "POST") {
         $text=$_POST['Text'];
         $TekstDoSzyfrowania=$text; */
        $TekstDoSzyfrowania="VENI";
        $trimedslowa=array();

        //funkcja przystosowująca tekst//
         function przystosowanieTekstu(){

             global $TekstDoSzyfrowania;
             global $trimedslowa;

             $TekstDoSzyfrowania=strtolower($TekstDoSzyfrowania);
             $TekstDoSzyfrowania=trim($TekstDoSzyfrowania);
             $slowa=explode(" ",$TekstDoSzyfrowania);

             foreach ($slowa as $v){
                 if ($v!=NULL) {
                     array_push($trimedslowa,trim($v));
                 }
             }
         }

            //funkcja zamieniajaca przystosowany tekst na kod morse //
            function toMorse()
            {
                $zaszyfrowanyMorse = "";
                global $trimedslowa;
                require_once('tablica_morsa.php');
                foreach ($trimedslowa as $slowo) {
                    for ($i = 0; $i < strlen($slowo); $i++) {
                        $zaszyfrowanyMorse .= $morse[$slowo[$i]]." ";
                    }
                    $zaszyfrowanyMorse .= "    ";
                }
                return ($zaszyfrowanyMorse);

            }

            //funkcja zamieniajaca przystosowany tekst na szyfr afiniczny//
            function toAfini()
            {  // if (isset($_POST['cesar_a'])&&isset($_POST['cesar_b']))
               // $a=$_POST['cesar_a'];
               // $b=$_POST['cesar_b'];
                $a=3;
                $b=12;
                $zaszyfrowanyCesar ="";
                global $trimedslowa;
                require_once('tablica_cesar.php');
                foreach ($trimedslowa as $slowo) {
                    for ($i = 0; $i < strlen($slowo); $i++) {
                        $zaszyfrowanyCesar .=  $flippedCesar[((($cesar[$slowo[$i]]*$a)+$b)%26)] ;
                    }
                    $zaszyfrowanyCesar .= " ";
                }
                return($zaszyfrowanyCesar);
            }

            function toVigenere()
            {
                $zaszyfrowanyVigenere = "";
                global $trimedslowa;
                require_once('tablica_morsa.php');
                foreach ($trimedslowa as $slowo) {
                    for ($i = 0; $i < strlen($slowo); $i++) {
                        $zaszyfrowanyMorse .= $morse[$slowo[$i]] . " ";
                    }
                    $zaszyfrowanyMorse .= "    ";
                }
                return ($zaszyfrowanyMorse);

            }


                przystosowanieTekstu();
                echo (toMorse());
                echo (toAfini());


   //    }
?>