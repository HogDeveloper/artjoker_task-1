<?php

namespace A;
require_once "show_exception_function.php";
{

    $matrixA = [
        [1, 2, 3, -34],
        [4, 5, 6, 1],
        [-2, -1, 67, 1],
        [0, -2, 3, 1],
        [-223, -1, 67, 1]
    ];

    $matrixB = [
        [2, 3, 4, 3, 45],
        [0, 2, -46, 4, 8],
        [1, -35, 6, 1, -12],
        [1, 5, 6, 1, -123],
        [1, 5, 6, 1, 3]
    ];

    /**
     * function return array without lines contains zero & sum > 0
     * @param array $matrix
     * @return array
     */
    function filterMatrixForLine(array &$matrix){
        if(count($matrix) === 0){
            throw new \Exception("Matrix is empty");
        }
        $result = [];
        for($i = 0, $count = count($matrix); $i < $count; $i++){
            $sum = 0;
            for($j = 0, $countJ = count($matrix[$i]); $j < $countJ; $j++){
                if($matrix[$i][$j] === 0) break;
                $sum += $matrix[$i][$j];
            }
            if($sum < 0) $result[] = $matrix[$i];
        }
        $matrix = $result;
        return $matrix;
    }

    /**
     * * function return array without columns contains zero & sum > 0
     * @param array $matrix
     * @return array
     */
    function filterMatrixForColumns(array &$matrix){
        if(count($matrix) === 0){
            throw new \Exception("Matrix is empty");
        }
        if(count($matrix) !== count($matrix[0])) {
            throw new \Exception('The number of rows and columns must match');
        }

        $removeColumn = function () use (&$matrix, &$exception, &$countMatrix){
            for($i = 0, $countException = count($exception); $i < $countException; $i++) {
                for($j = 0; $j < $countMatrix; $j++) {
                    unset($matrix[$j][$exception[$i]]);
                }
            }
        };
        $resetIndex = function() use (&$matrix){
            for($i = 0, $count = count($matrix); $i < $count; $i++){
                $matrix[$i] = array_splice($matrix[$i], 0);
            }
        };

        $exception = [];
        $countMatrix = count($matrix);
        for ($i = 0; $i < $countMatrix; $i++){
            $sum = 0;
            for ($j = 0, $countJ = count($matrix[$i]); $j < $countJ; $j++) {
                if(in_array($i, $exception)) continue;
                if($matrix[$j][$i] === 0) array_push($exception, $i);
                $sum += $matrix[$j][$i];
            };
            if($sum > 0 && !in_array($i, $exception)) array_push($exception, $i);
        }

        $removeColumn();
        $resetIndex();
        return $matrix;
    }

    try {
        print_r(filterMatrixForLine($matrixA));
    } catch(\Exception $e) {
        showExceptionMessage(($e->getTrace()[0]["function"]), $e->getMessage(), $e->getFile(), ($e->getTRace()[0]["line"]));
    }
    echo "<br>";
    try {
        print_r(filterMatrixForColumns($matrixB));
    } catch(\Exception $e) {
        showExceptionMessage(($e->getTrace()[0]["function"]), $e->getMessage(), $e->getFile(), ($e->getTRace()[0]["line"]));
    }

}

namespace B;
require_once "show_exception_function.php";
{
    $matrix = [
        [1, 3],
        [4, 5],
    ];

    /**
     * function new transpose matrix
     * @param array $matrix
     * @return array
     */
    function transposeMatrix(array &$matrix) {
        if(count($matrix) === 0){
            throw new \Exception("Matrix is empty");
        }
        $mHeight = count($matrix);
        $mWidth = count($matrix[0]);
        $transposeMatrix = [];
        for ($i = 0; $i < $mWidth; $i++) {
            for ($j = 0; $j < $mHeight; $j++) {
                $transposeMatrix[$mHeight - $i - 1][$j] = $matrix[$mHeight - $j - 1][$i];
            }
        }
        for ($i = 0, $count = count($transposeMatrix); $i < $count; $i++) {
            $transposeMatrix[$i] = array_reverse($transposeMatrix[$i]);
        }

        return $transposeMatrix;
    }

    try {
        print_r(transposeMatrix($matrix));
    } catch(\Exception $e) {
        showExceptionMessage(($e->getTrace()[0]["function"]), $e->getMessage(), $e->getFile(), ($e->getTRace()[0]["line"]));
    }

}

namespace C;
use function B\transposeMatrix;

require_once "show_exception_function.php";
{
    $matrixA = [
            [1, 2, 3],
            [4, 5, 6],
            [4, 5, 6],
        ];
        
    $matrixB = [
            [8, 23, 6],
            [8, 5, 44],
            [8, 5, 44],
        ];

    /**
     * function return new matrix with simple calculate
     * @param array $matrixA
     * @param array $matrixB
     * @return array
     */
    function calculateMatrixSimple(array &$matrixA, array &$matrixB) {
        if(count($matrixA) === 0){
            throw new \Exception("Matrix A is empty");
        }
        if(count($matrixB) === 0){
            throw new \Exception("Matrix B is empty");
        }
        $result = [];
        for($i = 0; $i < count($matrixA); $i++){
            $sum = 0;
            for($j = 0; $j < count($matrixA[$i]); $j++) $sum += $matrixA[$i][$j] + $matrixB[$i][$j];
            $result[] = $sum;
            unset($sum);
        }
        return $result;
    }

    /**
     * function return new matrix with save structure
     * @param array $matrixA
     * @param array $matrixB
     * @return array
     */
    function calculateMatrixWithSaveStructure(array &$matrixA, array &$matrixB) {
        if(count($matrixA) === 0){
            throw new \Exception("Matrix A is empty");
        }
        if(count($matrixB) === 0){
            throw new \Exception("Matrix B is empty");
        }
        $result = [];
        for($i = 0, $countI = count($matrixA); $i < $countI; $i++){
            for($j = 0, $countJ = count($matrixA[$i]); $j < $countJ; $j++) {
                $result[$i][$j] = $matrixA[$i][$j] + $matrixB[$i][$j];
            }
        }
        return $result;
    }

    try {
        print_r(calculateMatrixSimple($matrixA, $matrixB));
    } catch(\Exception $e) {
        showExceptionMessage(($e->getTrace()[0]["function"]), $e->getMessage(), $e->getFile(), ($e->getTRace()[0]["line"]));
    }
    try {
        print_r(calculateMatrixWithSaveStructure($matrixA, $matrixB));
    } catch(\Exception $e) {
        showExceptionMessage(($e->getTrace()[0]["function"]), $e->getMessage(), $e->getFile(), ($e->getTRace()[0]["line"]));
    }
}