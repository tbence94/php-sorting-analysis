<?php

require_once 'vendor/autoload.php';

use App\Analyzer;

foreach ([10, 100, 1000] as $amount) {
    $analyzer = new Analyzer($amount);
    $analyzer->analyzeAlgorithms();
}
