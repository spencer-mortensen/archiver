<?php

namespace SpencerMortensen\Archiver;

use Exception;

require __DIR__ . '/autoload.php';

$archiver = new Archiver();

$value = new Exception('Message', 1);
$archive = $archiver->archive($value);

echo var_export($archive), "\n";
