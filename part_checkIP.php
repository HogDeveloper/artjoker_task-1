<?php
require_once "show_exception_function.php";

/**
* Function convert ip(string) to integer
* @param string $ip
* @return int
*/
function convertIPToInteger(string $ip) {
    $decomposedIP = explode('.', $ip);
    $integerIP = 0;
    for($i = 0, $pow = 3; $i < 4; $i++, $pow--){
        if($decomposedIP[$i] > 256){
            throw new Exception($ip . " - incorrect ip address");
        }
        $integerIP += ((int) $decomposedIP[$i] * (256 ** $pow));
    }
    return $integerIP;
}

/**
* Check ip in range
* @param string $needleIP
* @param string $minIPInRange
* @param string $maxIPInRange
* @return bool
*/
function ipInRange(string $needleIP, string $minIPInRange, string $maxIPInRange) {
    if(strlen($needleIP) > 15 || strlen($needleIP) < 7){
        throw new Exception($needleIP . " - incorrect ip address");
    }
    if(strlen($minIPInRange) > 15 || strlen($minIPInRange) < 7){
        throw new Exception($minIPInRange . " - incorrect ip address");
    }
    if(strlen($maxIPInRange) > 15 || strlen($maxIPInRange) < 7){
        throw new Exception($maxIPInRange . " - incorrect ip address");
    }
    $needleIPInteger = convertIPToInteger($needleIP);
    $minIPInteger = convertIPToInteger($minIPInRange);
    $maxIPInteger = convertIPToInteger($maxIPInRange);

    return (($needleIPInteger >= $minIPInteger) && ($needleIPInteger <= $maxIPInteger));
}

/**
* Check ip in range (subnet)
* @param string $ip
* @param string $ipRange
* @return bool
*/
function ipInRangeSubnet(string $ip, string $ipRange) {
    if(strlen($ip) > 15 || strlen($ip) < 7 || strlen($ipRange) > 19 || strlen($ipRange) < 9){
        throw new Exception($ip . " - incorrect ip address");
    }
    $ip = convertIPToInteger($ip);
    $ipRangeDecompressed = explode('/', $ipRange);
    $rangeStart  = convertIPToInteger($ipRangeDecompressed[0]);
    $rangeEnd  = $rangeStart + (2 ** (32 - $ipRangeDecompressed[1] - 1));

    return ($ip >=$rangeStart && $ip <= $rangeEnd);
}

try {
    var_dump(ipInRangeSubnet('93.114.60.40', '93.114.60.0/21'));
} catch(Exception $e) {
    showExceptionMessage(($e->getTrace()[0]["function"]), $e->getMessage(), $e->getFile(), ($e->getTRace()[0]["line"]));
}
echo "<br>";
try {
    var_dump(ipInRangeSubnet('93.114.60.40', '93.114.60.0/21'));
} catch(Exception $e) {
    showExceptionMessage(($e->getTrace()[0]["function"]), $e->getMessage(), $e->getFile(), ($e->getTRace()[0]["line"]));
}
echo "<br>";
try {
    var_dump(ipInRangeSubnet('93.114.79.255', '93.114.60.0/21'));
} catch(Exception $e) {
    showExceptionMessage(($e->getTrace()[0]["function"]), $e->getMessage(), $e->getFile(), ($e->getTRace()[0]["line"]));
}
echo "<br>";
try {
    var_dump(ipInRange('192.168.124.67', '192.168.115.1', '192.168.124.99'));
} catch(Exception $e) {
    showExceptionMessage(($e->getTrace()[0]["function"]), $e->getMessage(), $e->getFile(), ($e->getTRace()[0]["line"]));
}
echo "<br>";
try {
    var_dump(ipInRange('192.168.24.67', '192.168.124.1', '192.168.124.99'));
} catch(Exception $e) {
    showExceptionMessage(($e->getTrace()[0]["function"]), $e->getMessage(), $e->getFile(), ($e->getTRace()[0]["line"]));
}