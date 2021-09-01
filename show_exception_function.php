<?php

function showExceptionMessage($functionName, $message, $file, $line): void{
    echo "Function: " . $functionName . " generate exception with message: \"" . $message . "\". File: " . $file . ", in line: " . $line, "<br>";
}