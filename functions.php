<?php

//Funkcija za razstavljanje stringov v array
function str_split_unicode($str, $l = 0) {
    if ($l > 0) {
        $ret = array();
        $len = mb_strlen($str, "UTF-8");
        for ($i = 0; $i < $len; $i += $l) {
            $ret[] = mb_substr($str, $i, $l, "UTF-8");
        }
        return $ret;
    }
    return preg_split("//u", $str, -1, PREG_SPLIT_NO_EMPTY);
}




function vigenere_cipher($string, $key, $spaces = false, $capitals = false) {
        
        // Naša abeceda
        $letters = array("a","b","c", "č", "d","e","f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "r", "s", "š", "t", "u", "v", "z", "ž","a","b","c", "č", "d","e","f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "r", "s", "š", "t", "u", "v", "z", "ž");
        
        // Velike črke
        $capital_letters = array("A", "B", "C", "Č", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "R", "S", "Š", "T", "U", "V", "Z", "Ž", "A", "B", "C", "Č", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "R", "S", "Š", "T", "U", "V", "Z", "Ž");
        
        // vrednosti oz. zamiki za črke v ključu
        $key_values = array (
            "a" => 0,
            "b" => 1,
            "c" => 2,
            "č" => 3,
            "d" => 4,
            "e" => 5,
            "f" => 6,
            "g" => 7,
            "h" => 8,
            "i" => 9,
            "j" => 10,
            "k" => 11,
            "l" => 12,
            "m" => 13,
            "n" => 14,
            "o" => 15,
            "p" => 16,
            "r" => 17,
            "s" => 18,
            "š" => 19,
            "t" => 20,
            "u" => 21,
            "v" => 22,
            "z" => 23,
            "ž" => 24,
        );
        
       
        // pogoji za presledke in velike začetnice
        if($capitals == false) {
        $string = mb_strtolower($string); 
        }
        
        if($spaces == false) {
            $string = str_replace(' ', '', $string);
        }
        
        // Vnešeno besedilo spremeni v polje
        $string_array = str_split_unicode($string);
        
       // Vnešen ključ spremeni v polje
        $key = mb_strtolower($key);
        $key = str_replace(' ', '', $key);
        $key_array = str_split_unicode($key);
        
        // Najde ustrezne vrednosti (zamike) za vsako črko ključa
        $key_value_array = array();
        foreach($key_array as $letter) {
        $key_value_array[]= strtr($letter, $key_values);
        }
        
        // za vsako črko besedila najde ustrezno vrednost glede na ključ in aplicira ustrezno cezarjevo šifro
        $ciphered_string_array = array();
        $x = 0;
        foreach($string_array as $number => $letter) {
            
            if($letter == " ") {
                $ciphered_string_array[] = " ";
                continue;
            }
            
            $caesar_cipher = array();
            for($i = 0; $i<=24; $i++) {
            $caesar_cipher[$letters[$i]] = $letters[$i+$key_value_array[$x]];
            }
            
            $caesar_cipher_capital = array();
            for($i = 0; $i<=24; $i++) {
                $caesar_cipher_capital[$capital_letters[$i]] = $capital_letters[$i+$key_value_array[$x]];
            }
            
            $x++;
            
            if($x == count($key_value_array)) {
                $x = 0;
            }
            
            $encrypted_letter = strtr($letter, $caesar_cipher);
            $encrypted_letter = strtr($encrypted_letter, $caesar_cipher_capital);
            $ciphered_string_array[] = $encrypted_letter;
        }
        
     
        // vrne šifriran tekst
        $encrypted_text = implode($ciphered_string_array);
        return $encrypted_text;
      
    }



 function vigenere_decipher($string, $key) {
        
        // Naša abeceda
        $letters = array("a","b","c", "č", "d","e","f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "r", "s", "š", "t", "u", "v", "z", "ž","a","b","c", "č", "d","e","f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "r", "s", "š", "t", "u", "v", "z", "ž");
     
        // Velike črke
        $capital_letters = array("A", "B", "C", "Č", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "R", "S", "Š", "T", "U", "V", "Z", "Ž", "A", "B", "C", "Č", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "R", "S", "Š", "T", "U", "V", "Z", "Ž");
        
        // vrednosti oz. zamiki za črke v ključu
        $key_values = array (
            "a" => 0,
            "b" => 1,
            "c" => 2,
            "č" => 3,
            "d" => 4,
            "e" => 5,
            "f" => 6,
            "g" => 7,
            "h" => 8,
            "i" => 9,
            "j" => 10,
            "k" => 11,
            "l" => 12,
            "m" => 13,
            "n" => 14,
            "o" => 15,
            "p" => 16,
            "r" => 17,
            "s" => 18,
            "š" => 19,
            "t" => 20,
            "u" => 21,
            "v" => 22,
            "z" => 23,
            "ž" => 24,
        );
        
       
        // Vnešeno besedilo spremeni v polje
        //$string = strtolower($string);
        //$string = str_replace(' ', '', $string);   odstrani presledke
        $string_array = str_split_unicode($string);
        
       // Vnešen ključ spremeni v polje
        $key = mb_strtolower($key);
        $key = str_replace(' ', '', $key);
        $key_array = str_split_unicode($key);
        
        // Najde ustrezne vrednosti (zamike) za vsako črko ključa
        $key_value_array = array();
        foreach($key_array as $letter) {
            $key_value_array[]= strtr($letter, $key_values);
        }
        
        // za vsako črko besedila najde ustrezno vrednost glede na ključ in aplicira ustrezno cezarjevo šifro
        $deciphered_string_array = array();
        $x = 0;
        foreach($string_array as $number => $letter) {
            
            if($letter == " ") {
                $deciphered_string_array[] = " ";
                continue;
            }
            
            $caesar_cipher = array();
            for($i = 0; $i<=24; $i++) {
            $caesar_cipher[$letters[$i]] = $letters[25+$i-$key_value_array[$x]];
            }
            
            $caesar_cipher_capital = array();
            for($i = 0; $i<=24; $i++) {
                $caesar_cipher_capital[$capital_letters[$i]] = $capital_letters[25+$i-$key_value_array[$x]];
            }
            
            $x++;
            
            if($x == count($key_value_array)) {
                $x = 0;
            }
            
            $decrypted_letter = strtr($letter, $caesar_cipher);
            $decrypted_letter = strtr($decrypted_letter, $caesar_cipher_capital);
            $deciphered_string_array[] = $decrypted_letter;
        }
        
        // vrne odkodiran tekst
        $decrypted_text = implode($deciphered_string_array);
        return $decrypted_text;
    }