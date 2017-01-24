<?php

require_once 'vendor/autoload.php';

use App\Analyzer;

$analyzer = new Analyzer();
$analyzer->analyzeAlgorithms();
