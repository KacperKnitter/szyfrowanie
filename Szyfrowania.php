<?php
    /*if ($_SERVER["REQUEST_METHOD"] == "POST") {
         $text=$_POST['Text'];
         $tekstDoSzyfrowania=$text; */
        $tekstDoSzyfrowania="ala ma 
        kota";
        $ascii_array=array();

        //funkcja przystosowująca tekst//
         function przystosowanieTekstu()
         {

             global $tekstDoSzyfrowania;
             global $ascii_array;

             $tekstToLow = strtolower($tekstDoSzyfrowania);

             for ($i=0;$i<strlen($tekstToLow);$i++) {

                 array_push($ascii_array, ord($tekstToLow[$i]));

             }

         }

            //funkcja zamieniajaca przystosowany tekst na kod morse //
            function toMorse()
            {
                $zaszyfrowanyMorse = "";
                global $ascii_array;
                require_once('tablica_morsa.php');
                foreach ($ascii_array as $znak) {
                    $znak = (string)$znak;
                    if (($znak <= 122 && $znak >= 97) || ($znak >= 48 && $znak <= 57)) {
                        $zaszyfrowanyMorse .= ($morse[chr($znak)])." ";
                    }
                    else {
                        $zaszyfrowanyMorse .= chr($znak)."    ";
                    }
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
                global $ascii_array;
                require_once('tablica_cesar.php');
                foreach ($ascii_array as $slowo) {
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
                global $ascii_array;
                require_once('tablica_morsa.php');
                foreach ($ascii_array as $slowo) {
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