<?php

require_once 'vendor/autoload.php';

use App\Analyzer;

$analyzer = new Analyzer(500);
$analyzer->analyzeAlgorithms();
$analyzer->createReport('results/data-500.html');