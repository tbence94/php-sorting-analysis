<?php

require_once 'vendor/autoload.php';

use App\Analyzer;

$analyzer = new Analyzer(100);
$analyzer->analyzeAlgorithms();
$analyzer->createReport('results/data-100.html');
