<?php

namespace App;

use App\Contracts\SortingAlgorithm;

class Analyzer
{
    /**
     * List of algorithms to test
     *
     * @var array
     */
    private $algorithms = [
        Algorithms\BubbleSort::class,
    ];

    /**
     * Generate an array of numbers to sort.
     *
     * @param integer $numbers [amount of numbers to sort]
     */
    public function __construct($numbers=100)
    {
        $this->numbers = range(1, $numbers);
        shuffle($this->numbers);
    }

    /**
     * Iterate over every algorithm and analyze their performance
     * 
     * @return void
     */
    public function analyzeAlgorithms()
    {
        foreach ($this->algorithms as $algorithm) {
            $this->analyze(new $algorithm($this->numbers));
        }
    }

    /**
     * Analyze performance of the given algorithm
     * 
     * @param  SortingAlgorithm $algorithm
     * @return void
     */
    private function analyze(SortingAlgorithm $algorithm)
    {
        $algorithm->sort();
    }
}
