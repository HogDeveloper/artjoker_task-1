<?php
require_once "show_exception_function.php";

/**
 * return percentage
 * @param int $a
 * @param int $b
 * @return float|int
 */
function calculatePercentage(int $a, int $b){
    if($a === 0 || $b === 0){
        throw new Exception("Division by zero");
    }
    if($a < 0 || $b < 0){
        throw new Exception("One or two of the parameters is negative. Please check your parameters");
    }
    return (($a / $b) * 100);
}

/**
 * Function check number is prime with iteration
 * @param $number
 * @return bool
 */
function isPrimeNumber(int $number) {
    if($number < 1){
        throw new Exception("The number cannot be less than one");
    }
    if ($number < 2) {
        return false;
    }
    if($number === 2) {
        return true;
    }
    if($number % 2 === 0) {
        return false;
    }
    $i = 3;
    $maxFactor = sqrt($number);
    while ($i <= $maxFactor){
        if ($number % $i === 0) {
            return false;
        }
        $i += 2;
    }
    return true;
}

/**
 * return count positive numbers in array
 * @param array $arr
 * @return int
 */
function getPositiveNumbers(array &$arr){
    if(empty($arr)){
        throw new Exception("Array is empty");
    }
    $counter = 0;
    for($i = 0, $count = count($arr); $i < $count; $i++){
        if($arr[$i] > 0) {
            $counter++;
        }
    }
    return $counter;
};

/**
 * return count negative numbers in array
 * @param array $arr
 * @return int
 */
function getNegativeNumbers(array &$arr){
    if(empty($arr)){
        throw new Exception("Array is empty");
    }
    $counter = 0;
    for($i = 0, $count = count($arr); $i < $count; $i++){
        if($arr[$i] < 0) {
            $counter++;
        }
    }
    return $counter;
};
/**
 * return count zero numbers in array
 * @param array $arr
 * @return int
 */
function getZeroNumbers(array &$arr){
    if(empty($arr)){
        throw new Exception("Array is empty");
    }
    $counter = 0;
    for($i = 0, $count = count($arr); $i < $count; $i++){
        if($arr[$i] === 0) {
            $counter++;
        }
    }
    return $counter;
};
/**
 * return count prime numbers in array
 * @param array $arr
 * @return int
 */
function getPrimeNumbers(array &$arr){
    if(empty($arr)){
        throw new Exception("Array is empty");
    }
    $counter = 0;
    for($i = 0, $count = count($arr); $i < $count; $i++){
        if(isPrimeNumber($arr[$i])) {
            $counter++;
        }
    }
    return $counter;
}

$arrayA = [0,2,0,-3,-2,41,-3.42,39,0,7];

//print_r("Исходный массив: [ " . implode(", ", $arrayA) . " ] \n");
//print_r("Процент положительных чисел в массиве: " . calculatePercentage(getPositiveNumbers($arrayA), count($arrayA)) . "% \n");
//print_r("Процент отрицательных чисел в массиве: " . calculatePercentage(getNegativeNumbers($arrayA), count($arrayA)) . "% \n");
//print_r("Процент нулевых чисел в массиве: " . calculatePercentage(getZeroNumbers($arrayA), count($arrayA)) . "% \n");
//print_r("Процент целых чисел в массиве: " . calculatePercentage(getPrimeNumbers($arrayA), count($arrayA)) . "% \n");
//echo "\n";


$arrayB = [4,5,63,2,1,66,43,41,0,-63,18,-1,612,-43];

/**
 * function return sort array "down to up"
 * @param array $array
 * @return array
 */
function sortArrayDownToUp (array &$array){
    if(empty($arr)){
        throw new Exception("Array is empty");
    }
    $counter = 0;
    for ($i = 0, $count = count($array); $i < $count; $i++) {
        if($counter > $count) {
            break;
        }
        if (!isset($array[$i + 1])) {
            break;
        }
        if($array[$i] < $array[$i + 1]) {
            continue;
        }
        else {
            $item = $array[$i];
            unset($array[$i]);
            $array[] = $item;
            $array = array_values($array);
            $i = -1;
        }
        $counter++;
        $count++;
    }
    return $array;
}

/**
 * * function return sort array "up to down"
 * @param array $array
 * @return array
 */
function sortArrayUpToDown (array &$array){
    if(empty($arr)){
        throw new Exception("Array is empty");
    }
    $counter = 0;
    for ($i = 0, $count = count($array); $i < $count; $i++) {
        if($counter > $count) {
            break;
        }
        if (!isset($array[$i + 1])) {
            break;
        }
        if($array[$i] > $array[$i + 1]) {
            continue;
        }
        else {
            $number = $array[$i];
            unset($array[$i]);
            $array[] = $number;
            $array = array_values($array);
            $i = -1;
        }
        $counter++;
        $count++;
    }
    return $array;
}

//print_r(sortArrayDownToUp($arrayB));
//print_r(sortArrayUpToDown($arrayB));
