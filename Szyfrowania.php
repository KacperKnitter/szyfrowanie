<?php
    /*if ($_SERVER["REQUEST_METHOD"] == "POST") {
         $text=$_POST['Text'];
         $tekstDoSzyfrowania=$text; */
        $tekstDoSzyfrowania="TO JEST BARDZO TAJNY TEKST";
        $ascii_array=array();

        //funkcja przystosowująca tekst//
         function przystosowanieTekstu()
         {

             global $tekstDoSzyfrowania;
             global $ascii_array;

             for ($i=0;$i<strlen($tekstDoSzyfrowania);$i++) {

                 array_push($ascii_array, ord($tekstDoSzyfrowania[$i]));

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
                        $zaszyfrowanyMorse .= ($morseMale[chr($znak)])." ";
                    }
                    elseif ($znak <= 90 && $znak >= 65){
                        $zaszyfrowanyMorse .= ($morseDuze[chr($znak)])." ";
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
                foreach ($ascii_array as $znak) {
                    if ($znak <= 122 && $znak >= 97) {
                        $zaszyfrowanyCesar .= $flippedCesarMale[((($cesarMale[chr($znak)] * $a) + $b) % 26)];
                    }
                    elseif ($znak <= 90 && $znak >= 65){
                        $zaszyfrowanyCesar .= $flippedCesarDuze[((($cesarDuze[chr($znak)] * $a) + $b) % 26)];
                    }
                    else{
                        $zaszyfrowanyCesar .= chr($znak);
                    }
                }
                return($zaszyfrowanyCesar);
            }

            //funkcja zamieniajaca przystosowany tekst na szyfr Vigenere//
            function toVigenere()
            {
                $klucz = dopasowanieKlucza();
                $zaszyfrowanyVigenere = "";
                global $ascii_array;
                $i = 0;
                require_once('tablica_cesar.php');
                foreach ($ascii_array as $znak) {
                    if ($znak <= 122 && $znak >= 97) {
                        $zaszyfrowanyVigenere .= $flippedCesarMale[(($cesarMale[chr($znak)] + $cesarMale[$klucz[$i]]) % 26)];
                        $i++;
                    } elseif ($znak <= 90 && $znak >= 65) {
                        $zaszyfrowanyVigenere .= $flippedCesarDuze[(($cesarDuze[chr($znak)] + $cesarMale[$klucz[$i]]) % 26)];
                        $i++;
                    } else {
                        $zaszyfrowanyVigenere .= chr($znak);
                        $i++;
                    }

                }
                return ($zaszyfrowanyVigenere);

            }


            // dopasowyawnie słowa klucza do formatu tkstu do szyfrowania//
            function dopasowanieKlucza()
            {
                //    $slowoKlucz=strtolower($_POST['slowoKlucz']);
                $slowoKlucz = strtolower("TAJNE");
                global $ascii_array;
                $klucz = "";
                $i = 0;
                foreach ($ascii_array as $znak) {
                    if (!(($znak <= 122 && $znak >= 97) || ($znak <= 90 && $znak >= 65))) {
                        $klucz .= chr($znak);

                    } else {
                        while (!(ord($slowoKlucz[($i % strlen($slowoKlucz))]) <= 122 && ord($slowoKlucz[($i % strlen($slowoKlucz))]) >= 97)) {
                            $i++;
                        }
                        $klucz .= $slowoKlucz[($i % strlen($slowoKlucz))];
                        $i++;
                    }
                }
                return ($klucz);
            }

                przystosowanieTekstu();
             //  echo (toMorse());
              //  echo (toAfini());
              //  echo (dopasowanieKlucza());
                echo (toVigenere());
   //    }
?>