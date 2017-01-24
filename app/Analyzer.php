<?php

namespace App;

use ReflectionClass;
use App\Contracts\SortingAlgorithm;
use App\Contracts\ProvidesFeedback;

class Analyzer
{
    /**
     * List of algorithms to test
     *
     * @var array
     */
    private $algorithms = [
        Algorithms\BubbleSort::class,
        Algorithms\MergeSort::class,
        Algorithms\SelectionSort::class,
        Algorithms\InsertionSort::class,
    ];

    /**
     * Iteration results of algorithms
     * 
     * @var array
     */
    private $results = [];

    /**
     * Store amount of numbers
     *
     * @var integer
     */
    private $amount;

    /**
     * Generate an array of numbers to sort.
     *
     * @param integer $amount [amount of numbers to sort]
     */
    public function __construct($amount=100)
    {
        $this->amount  = $amount;
        $this->numbers = range(1, $amount);

        shuffle($this->numbers);
    }

    /**
     * Iterate over every algorithm and analyze their performance
     *
     * @return void
     */
    public function analyzeAlgorithms()
    {
        // Analyze each algorithm
        foreach ($this->algorithms as $algorithm) {
            $this->analyze(new $algorithm($this->numbers));
        }

        // Add common complexity iteration values to the results array
        $this->computeComplexities();

        // Show [ complexity/algorithm - iteration value ] results
        $this->displayResults();
    }

    /**
     * Analyze performance of the given algorithm
     *
     * @param  SortingAlgorithm $algorithm
     * @return void
     */
    private function analyze(SortingAlgorithm $algorithm)
    {

        // Run sorting
        $sortedNumbers = $algorithm->sort();

        // Save results
        $name = (new ReflectionClass($algorithm))->getShortName();
        $this->results[$name] = $this->getIterations($algorithm);

    }

    /**
     * Get iterations of the given algorithm
     *
     * @param  ProvidesFeedback $algorithm
     * @return integer
     */
    private function getIterations(ProvidesFeedback $algorithm)
    {
        return $algorithm->getIterations();
    }

    /**
     * Add common Ordo values to the results
     * 
     * @return void
     */
    private function computeComplexities()
    {
        $n = $this->amount;

        // Calculate common Ordo ("Big O Notation") values
        $complexities = [
            'n'        => $n,
            'n*2'      => $n * 2,
            'n^2'      => pow($n, 2),
            'n^3'      => pow($n, 3),
            'n*log(n)' => intval( $n * log($n) ),
        ];

        $this->results = array_merge($complexities, $this->results);
    }

    /**
     * Display complexity analysis in a table
     *
     * @return void
     */
    private function displayResults()
    {

        asort($this->results);

        $mask = " | %-25s | %-30s | \n";

        echo ' --------------------------------------------------------------'.PHP_EOL;
        printf($mask, 'Complexity / Algorithm', 'Iterations');
        echo ' --------------------------------------------------------------'.PHP_EOL;
        foreach ($this->results as $complexity => $iterations) {
            printf($mask, $complexity, $iterations);
        }
        echo ' --------------------------------------------------------------'.PHP_EOL;

    }


}
