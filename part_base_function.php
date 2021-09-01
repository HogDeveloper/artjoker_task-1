<?php
require_once "show_exception_function.php";

/**
 * Function return sum number of fibonacci (with recursion)
 * @param int $number
 * @return int
 */
function getSumNumberFibonacciWithRecursion (int $number = 1) {
    if($number < 0) {
        throw new Exception("Parameter must be greater than zero");
    }
    if($number <= 1) {
        return $number;
    }
    return getSumNumberFibonacciWithRecursion($number - 1) + getSumNumberFibonacciWithRecursion($number - 2);
}

/**
 * Function return sum number of fibonacci
 * @param int $number
 * @return int (sum numbers fibonacci)
 */
function getSumNumberFibonacci (int $number = 1) {
    if($number <= 0) {
        throw new Exception("Parameter must be greater than zero");
    }
    $sequenceNumberPrevious = 1;
    $sequenceNumberNext = 1;
    $sumPreviousValues = 0;
    for($i = 3; $i <= $number; $i++){
        $sumPreviousValues = $sequenceNumberPrevious + $sequenceNumberNext;
        $sequenceNumberPrevious = $sequenceNumberNext;
        $sequenceNumberNext = $sumPreviousValues;
    }
    return $sumPreviousValues;
}

/**
 * Function return exponentiation number (with recursion)
 * @param int $x
 * @param int $y
 * @return float|int
 */
function exponentiationWithRecursion(int $x, int $y = 1) {
    // just for example
    if($x === 0){
        throw new Exception('Zero to any power equals 0');
    }
    if($y === 1) {
        return $x;
    }
    return ($x * exponentiationWithRecursion($x, $y - 1));
}

/**
 * Function return exponentiation number
 * @param int $x
 * @param int $y
 * @return int
 */
function exponentiation(int $x, int $y = 1) {
    // just for example
    if($x === 0){
        throw new Exception('Zero to any power equals 0');
    }
    $result = $x;
    for($i = 1; $i < $y; $i++) {
        $result *= $x;
    }
    return $result;
}

try {
    echo 'Фибоначи с использованием рекурсии : ' . getSumNumberFibonacciWithRecursion(23);
} catch (Exception $e) {
    showExceptionMessage(($e->getTrace()[0]["function"]), $e->getMessage(), $e->getFile(), ($e->getTRace()[0]["line"]));
}
try {
    echo 'Фибоначи с использованием цикла : ' . getSumNumberFibonacci(-7);
} catch (Exception $e) {
    showExceptionMessage(($e->getTrace()[0]["function"]), $e->getMessage(), $e->getFile(), ($e->getTRace()[0]["line"]));
}
try {
    print_r(exponentiation(0, 2));
} catch(Exception $e) {
    showExceptionMessage(($e->getTrace()[0]["function"]), $e->getMessage(), $e->getFile(), ($e->getTRace()[0]["line"]));
}
try {
    print_r(exponentiationWithRecursion(0, 2));
} catch(Exception $e) {
    showExceptionMessage(($e->getTrace()[0]["function"]), $e->getMessage(), $e->getFile(), ($e->getTRace()[0]["line"]));
}

/**
 * FUnction convert binary to decimal
 * @param int $binary
 * @param $exponentiation
 * @return number
 */
function convertBinaryToDecimal(int $binary, $exponentiation){
    if(!is_callable($exponentiation, false)){
        throw new Exception("Function " . $exponentiation . "not found");
    }
    if(preg_match("/[2-9]+?/", $binary) > 0){
        throw new Exception($binary . " incorrect parameter");
    }
    $binary = str_split((string)$binary);
    $count = count($binary);
    $bin = null;
    for($i = 0, $j = $count - 1; $i < $count && $j >= 0; $i++, $j--) {
        $tmp = $exponentiation(2, $j);
        if($i === 0) $bin = $binary[$i] * $tmp;
        else $bin += $binary[$i] * $tmp;
    }
    return $bin;
}

/**
 * Function convert Decimal to binary
 * @param int $decimal
 * @return number
 */
function convertDecimalToBinary(int $decimal){
    if($decimal <= 0){
        throw new Exception("Any negative number or equal to zero will always return zero");
    }
    $array = [];
    while ($decimal >= 1){
        array_unshift($array, ($decimal % 2));
        $decimal = floor($decimal - ($decimal % 2));
        $decimal = $decimal / 2;
    }
    return (int) implode('', $array);
}

echo "<br>";
try {
    print_r(convertBinaryToDecimal("11101000", "exponentiation"));
} catch (Exception $e){
    showExceptionMessage(($e->getTrace()[0]["function"]), $e->getMessage(), $e->getFile(), ($e->getTRace()[0]["line"]));
}
echo "<br>";
try {
    print_r(convertDecimalToBinary(-232));
} catch (Exception $e){
    showExceptionMessage(($e->getTrace()[0]["function"]), $e->getMessage(), $e->getFile(), ($e->getTRace()[0]["line"]));
}