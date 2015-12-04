<?php
function getInfos($url){
 $ch = curl_init($url);
 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 curl_setopt($ch, CURLINFO_HEADER_OUT, true);
 curl_setopt($ch, CURLOPT_TIMEOUT, 30);
 curl_exec($ch);
 return curl_getinfo($ch);
 }
?>