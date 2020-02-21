<?php
    $APP_ID = '9e081409';
    $APP_KEY = 'c122653d4096a00999bf36f4e1d4958e';
    $url = 'https://api.edamam.com/api/food-database/parser?ingr=whey&category=generic-foods&category-label=food&app_id=9e081409&app_key=c122653d4096a00999bf36f4e1d4958e';
    $ch = curl_init();


    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);

    $jsonData = curl_exec($ch);

    curl_close($ch);

    $jsonData = stripslashes(html_entity_decode($jsonData));
    $array = json_decode($jsonData, true);

    $qual = 'FAT';
    
    $food = $array['parsed'][0]['food'];
    $nutrients = $array['parsed'][0]['food']['nutrients'][$qual];
    print_r($food);
    print_r($nutrients);

    
   
?>

