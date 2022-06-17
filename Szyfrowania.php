<?php


    /*if ($_SERVER["REQUEST_METHOD"] == "POST") {
         $text=$_POST['Text'];
         $tekstDoSzyfrowania=$text; */
        $tekstDoSzyfrowania="GH XNWL UBRUCN HTJWL RXOCL";
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
                require('tablica_morsa.php');

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
            {
                // if (isset($_POST['cesar_a'])&&isset($_POST['cesar_b']))
               // $a=$_POST['cesar_a'];
               // $b=$_POST['cesar_b'];
                $a=3;
                $b=12;
                $zaszyfrowanyCesar ="";
                global $ascii_array;
                require('tablica_cesar.php');

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
                require('tablica_cesar.php');

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
                $slowoKlucz = strtolower("NT OJES TBARDZ OTAJN YTEKS");
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

            function fromAfini()
            {   // if (isset($_POST['cesar_a'])&&isset($_POST['cesar_b']))
                // $a=$_POST['cesar_a'];
                // $b=$_POST['cesar_b'];
                $a = 3;
                $b = 12;
                global $ascii_array;
                $odszyfrowanyAfini = "";
                require('tablica_cesar.php');
                $odwrotneModulo = odwrotneModulo($a);
                foreach ($ascii_array as $znak) {
                    if ($znak <= 122 && $znak >= 97) {
                        $czyModuloDodatnie = ($odwrotneModulo * ($cesarMale[chr($znak)] - $b)) % 26;
                        if ($czyModuloDodatnie < 0) {
                            $czyModuloDodatnie = $czyModuloDodatnie + 26;
                        }
                        $odszyfrowanyAfini .= $flippedCesarMale[$czyModuloDodatnie];
                    } elseif ($znak <= 90 && $znak >= 65) {
                        $czyModuloDodatnie = ($odwrotneModulo * ($cesarDuze[chr($znak)] - $b)) % 26;
                        if ($czyModuloDodatnie < 0) {
                            $czyModuloDodatnie = $czyModuloDodatnie + 26;
                        }

                        $odszyfrowanyAfini .= $flippedCesarDuze[$czyModuloDodatnie];
                    } else {
                        $odszyfrowanyAfini .= chr($znak);
                    }
                }
                echo $odszyfrowanyAfini;

            }

            //funkcja obliczająca odwrotne modulo [rozszerzenie gmp nie działa :( ]//
            function odwrotneModulo($a)
            {
                $b = 26;
                $u = 1;
                $w = $a;
                $x = 0;
                $z = $b;
                while ($w != 0) {
                    if ($w < $z) {
                        $p = $u;
                        $u = $x;
                        $x = $p;
                        $p = $w;
                        $w = $z;
                        $z = $p;
                    }
                    $q = (integer)($w / $z);
                    $u = ($u - ($q * $x));
                    $w = ($w - ($q * $z));
                }
                if ($z = 1) {
                    if ($x < 0) {
                        $x = $x + $b;
                    }
                    return $x;
                }
            }

            function fromVigenere()
            {
                require('tablica_cesar.php');
                $array_klucz=array();
                $slowoKlucz = dopasowanieKlucza();
                // "odwracanie klucza"//
                for ($i = 0; $i < strlen($slowoKlucz); $i++) {
                    array_push($array_klucz, ord($slowoKlucz[$i]));
                }
                $klucz = "";
                $i = 0;

                foreach ($array_klucz as $znak) {
                    if ($znak <= 122 && $znak >= 97) {
                        $klucz .= $flippedCesarMale[((-$cesarMale[chr($znak)] + 26) % 26)];
                    } elseif ($znak <= 90 && $znak >= 65) {
                        $klucz .= $flippedCesarDuze[((-$cesarDuze[chr($znak)] + 36) % 26)];
                    } else {
                        $klucz .= chr($znak);
                    }

                }
                $odszyfrowanyVigenere = "";
                global $ascii_array;
                $i = 0;


                foreach ($ascii_array as $znak) {
                    if ($znak <= 122 && $znak >= 97) {
                        $odszyfrowanyVigenere .= $flippedCesarMale[(($cesarMale[chr($znak)] + $cesarMale[$klucz[$i]]) % 26)];
                        $i++;
                    } elseif ($znak <= 90 && $znak >= 65) {
                        $odszyfrowanyVigenere .= $flippedCesarDuze[(($cesarDuze[chr($znak)] + $cesarMale[$klucz[$i]]) % 26)];
                        $i++;
                    } else {
                        $odszyfrowanyVigenere .= chr($znak);
                        $i++;
                    }

                }
                return ($odszyfrowanyVigenere);

            }

                przystosowanieTekstu();
             //  echo (toMorse());
              //  echo (toAfini());
              //  echo (dopasowanieKlucza());
               // echo (toVigenere());
              //  echo (fromAfini())
                echo (fromVigenere());
   //    }
?>