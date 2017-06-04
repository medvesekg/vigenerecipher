<?php
include "functions.php";

$output = null;
$capitals = false;
$spaces = false;
$warning = null;

$abeceda = array("a","b","c","č","d","e","f","g","h","i","j","k","l","m","n","o","p","r","s","š","t","u","v","z","ž","A","B","C","Č","D","E","F","G","H","I","J","K","L","M","N","O","P","R","S","Š","T","U","V","Z","Ž");

if(isset($_POST['encrypt']) || isset($_POST['decrypt'])) {
    $text = trim(filter_input(INPUT_POST, 'text', FILTER_SANITIZE_STRING));
    $key = trim(filter_input(INPUT_POST, 'key', FILTER_SANITIZE_STRING));
    
    $key = mb_strtolower($key);
    $key = str_replace(' ', '', $key);
    $key_array = str_split_unicode($key);
    
    foreach($key_array as $letter) {
        if(!in_array($letter, $abeceda)) {
            $output = "V ključu so dovoljene samo črke slovenske abecede.";
            $warning = "Bad input";
        }
    }
    
    if(isset($_POST['spaces'])) {
        $spaces = true;
    }
    
    if(isset($_POST['capitals'])) {
        $capitals = true;
    }
    
    if(!$warning == "Bad input") {
        if($text == "" || $key == "") {
            $output = "Prosimo vnesite besedilo in ključ.";
        } else {
            if(isset($_POST['encrypt'])) {
                $output = vigenere_cipher($text,$key,$spaces,$capitals);
            } elseif(isset($_POST['decrypt'])) {
                $output = vigenere_decipher($text,$key);
            }
        }
    }
}

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link rel="stylesheet" href="style.css" type="text/css">
        <title>Vigenerejeva šifra</title>
    </head>
    <body>
        <div class="main">
            <div class="container">
                <div class="row">
                    <h1>Vigenèrejeva šifra</h1>
                </div>
                <div class="row">
                    <div class="opis">
                        <p>Vigenèrejeva šifra je naprednejša oblika Cezarjeve šifre, kjer je na podlagi ključa vsaka črka šifrirana s svojo šifro. Npr. če šifriramo tekst "Danes je dober dan" s ključem "riba", bi prvo črko šifrirali z 'a->r' abecedo (torej Cezarjevo šifro z zamikom 17), drugo z 'a->i' abecedo, tretjo z 'a->b' itd. dokler ne pridemo do konca teksta. Pri Vigenèrejevi šifri torej črka v šifriranem tekstu ne odgovarja vedno istemu znaku, zaradi česar je v primerjavi z navadno Cezarjevo šifro težja za razbijanje. Program deluje s 25 črkami slovenske abecede, drugih znakov in črk ne šifrira.</p>
                    </div>
                </div>
                <div class="row form-row">
            
                    
                    <form method="post">
                        <div class="form-group">
                            <textarea class="form-control" id="text-input" name="text" placeholder="Vnesi besedilo"><?php echo $output; ?></textarea>
                            <input type="text" class="form-control key-input" placeholder="Vnesi ključ" name="key">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input" name="spaces">
                                        Ohrani presledke
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input" name="capitals">
                                        Ohrani velike začetnice
                                    </label>
                                </div>
                                <input type="submit" class="btn btn-default submit-button" value="Šifriraj" name="encrypt">
                                <input type="submit" class="btn btn-default submit-button" value="Odšifriraj" name="decrypt">
                            </div>
                    </form>
                    
                    
                </div>
            </div>
        </div>
    </body>
</html>
                                             
                                             
        