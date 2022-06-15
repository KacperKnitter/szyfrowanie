<?php
    /*if ($_SERVER["REQUEST_METHOD"] == "POST") {
         $text=$_POST['Text'];
         $TekstDoSzyfrowania=$text; */
        $TekstDoSzyfrowania="   ala   ma kota";
        $trimedslowa=array();

        //funkcja przystosowująca tekst//
         function PrzystosowanieTekstu(){

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
             return ($trimedslowa);
         }



   //    }