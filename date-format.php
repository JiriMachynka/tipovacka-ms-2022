<?php

function dateFormat($date) {
    $date = array_reverse(explode(" ", $date));
    $time = substr($date[0], 0, 5);
    $date = implode(". ", array_reverse(explode("-", $date[1])));
    return $time . " " . $date;
}   

function inputDateFormat($date) {
    $time = explode(" ", $date)[0] . ":00";
    $date = explode(" ", $date);
    array_shift($date);
    $date = implode("-", array_reverse(explode(".", implode("", $date))));
    return $date . " " . $time;
} 

?>