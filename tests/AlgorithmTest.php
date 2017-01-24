<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use App\Contracts\SortingAlgorithm;

class AlgorithmTest extends TestCase
{
    /**
     * List of algorithms to test
     *
     * @var array
     */
    private $algorithms = [
        \App\Algorithms\BubbleSort::class,
        \App\Algorithms\MergeSort::class,
        \App\Algorithms\SelectionSort::class,
        \App\Algorithms\InsertionSort::class,
    ];

    /**
     * Generate numbers to sort.
     */
    public function __construct() {
        $this->numbers = $this->sorted = range(1, 100);
        shuffle($this->numbers);
    }

    /**
     * Test each algorithm
     */
    public function testAlgorithms()
    {
        foreach ($this->algorithms as $algorithm) {
            $this->assertAlgorithmCanSort(new $algorithm($this->numbers));
        }
    }

    /**
     * Check if given algorithm can sort
     * 
     * @param  SortingAlgorithm $algorithm
     */
    private function assertAlgorithmCanSort(SortingAlgorithm $algorithm)
    {
        $actual = $algorithm->sort();
        $this->assertEquals($this->sorted, $actual);
    }
}