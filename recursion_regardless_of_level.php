<?php
require_once "show_exception_function.php";

$matrix = [
    2, 3, [
        3, [
            4, 5
        ], 23
    ], 90
];

/**
 * function print value while value is nor array
 * @param array $matrix
 */
function recursionRegardlessLevel(array &$matrix){
    if(count($matrix) === 0){
        throw new \Exception("Matrix is empty");
    }
    for($i = 0, $count = count($matrix); $i < $count; $i++){
        if(is_array($matrix[$i])) {
            recursionRegardlessLevel($matrix[$i]);
        }
        else {
            print_r($matrix[$i]);
        }
        echo "\n";
    }
}

try {
    recursionRegardlessLevel($matrix);
} catch(\Exception $e) {
    showExceptionMessage(($e->getTrace()[0]["function"]), $e->getMessage(), $e->getFile(), ($e->getTRace()[0]["line"]));
}