<?php
    /*if ($_SERVER["REQUEST_METHOD"] == "POST") {
         $text=$_POST['Text'];
         $TekstDoSzyfrowania=$text; */
        $TekstDoSzyfrowania="   ala   ma kota";
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
                przystosowanieTekstu();
                echo (toMorse());


   //    }
?>