<?php
// Credentials

define('FEDEX_ACCOUNT_NUMBER', '');
define('FEDEX_METER_NUMBER', '');
define('FEDEX_KEY', '');
define('FEDEX_PASSWORD', '');


if (!defined('FEDEX_ACCOUNT_NUMBER') || !defined('FEDEX_METER_NUMBER') || !defined('FEDEX_KEY') || !defined('FEDEX_PASSWORD')) {
    die("Las constantes 'FEDEX_ACCOUNT_NUMBER', 'FEDEX_METER_NUMBER', 'FEDEX_KEY', y 'FEDEX_PASSWORD' deben de ser definidas en el archivo: " . realpath(__FILE__));
}