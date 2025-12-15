<?php


function get_post($pdo, $var)
{
    return $pdo->quote($_POST[$var]);
}

function proverka_poley(array $fields) : bool{
    foreach($fields as $field){
        if(!isset($_POST[$field]) or trim($_POST[$field])===''){
            return false;
        }
    }
    return true;
}
?>