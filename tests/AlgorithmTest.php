<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use App\Contracts\SortingAlgorithm;
use App\Contracts\ProvidesFeedback;

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
        \App\Algorithms\QuickSort::class,
    ];

    /**
     * Generate numbers to sort.
     */
    public function __construct()
    {
        $this->numbers = $this->sorted = range(1, 100);
        shuffle($this->numbers);
    }

    /**
     * Test each algorithm
     */
    public function testAlgorithms()
    {
        foreach ($this->algorithms as $algorithm) {
            $sorter = new $algorithm($this->numbers);

            // Assert it can really sort
            $this->assertAlgorithmCanSort($sorter);

            // The original still must be shufled!
            $this->assertNotEquals($this->numbers, $this->sorted);

            // Check if it can provide feedback
            $this->assertInstanceOf(\App\Contracts\ProvidesFeedback::class, $sorter);
            $this->assertInternalType("int", $sorter->getIterations());
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
