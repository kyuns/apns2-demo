<?php
/*
 * Setup Manual
 * Install
 * ----------------
 * open ssl 1.0.2e
 * curl 7.46(+nghttp2)
 * PHP 5.5.24
 * brew tap homebrew/php
 * brew tap homebrew/homebrew-php
 * brew install openssl
 * brew link openssl --force
 * brew install curl --with-nghttp2 --with-openssl
 * brew link curl --force
 * brew install --with-homebrew-curl --with-homebrew-openssl --without-snmp php56
 * brew install php56-mcrypt
 *
 */

if(!defined('CURL_HTTP_VERSION_2_0')) exit;

$device_token   = 'Your Device Token';
$pem_file       = 'Your Pem File';
//$pem_secret     = 'Password';

//App Bundle Name
$apns_topic     = 'Your App Bundle Name';

$alert = '{"aps":{"alert":"test","sound":"default"}}';

$url = "https://api.push.apple.com/3/device/$device_token";

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_POSTFIELDS, $alert);
curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_2_0);
curl_setopt($ch, CURLOPT_HTTPHEADER, array("apns-topic: $apns_topic"));
curl_setopt($ch, CURLOPT_SSLCERT, $pem_file);
//curl_setopt($ch, CURLOPT_SSLCERTPASSWD, $pem_secret);

$response = curl_exec($ch);
$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

var_dump($response);
var_dump($httpcode);

$info = curl_getinfo($ch);
$errno = curl_errno($ch);
$error = curl_error($ch);

var_dump($info);
var_dump($errno);
var_dump($error);
