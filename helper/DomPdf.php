<?php

// reference the Dompdf namespace
include_once ("./third-party/dompdf/autoload.inc.php");
use Dompdf\Dompdf;

// instantiate and use the dompdf class
$dompdf = new Dompdf();


function file_get_contents_curl($url) {
    $crl = curl_init();
    $timeout = 5;
    curl_setopt($crl, CURLOPT_URL, $url);
    curl_setopt($crl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($crl, CURLOPT_CONNECTTIMEOUT, $timeout);
    $ret = curl_exec($crl);
    curl_close($crl);
    return $ret;
}