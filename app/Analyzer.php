<?php

namespace App;

use ReflectionClass;
use App\Export;
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
        Algorithms\QuickSort::class,
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
     * Save the maximum amount of number to sort
     *
     * @param integer $amount [maximum amount of numbers to sort]
     */
    public function __construct(int $amount = 100)
    {
        $this->amount = $amount;
    }

    /**
     * Iterate over every algorithm and analyze their performance
     *
     * @return void
     */
    public function analyzeAlgorithms()
    {
        foreach (range(1, $this->amount) as $n) {
            $this->numbers = range(1, $n);
            shuffle($this->numbers);

            // Analyze each algorithm
            foreach ($this->algorithms as $algorithm) {
                $this->analyze(new $algorithm($this->numbers), $n);
            }

            // Add common complexity iteration values to the results array
            $this->computeComplexities($n);

            // Show [ complexity/algorithm - iteration value ] results
            $this->displayResults($n);
        }
    }

    /**
     * Analyze performance of the given algorithm
     *
     * @param  SortingAlgorithm $algorithm
     * @param  integer $n
     * @return void
     */
    private function analyze(SortingAlgorithm $algorithm, int $n)
    {

        // Run sorting
        $sortedNumbers = $algorithm->sort();

        // Save results
        $name = (new ReflectionClass($algorithm))->getShortName();
        $this->results[$n][$name] = $this->getIterations($algorithm);
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
     * @param  integer $n
     * @return void
     */
    private function computeComplexities(int $n)
    {
        // Calculate common Ordo ("Big O Notation") values
        $complexities = [
            'n'        => $n,
            'n*2'      => $n * 2,
            'n*log(n)' => $n * log($n),
            'n^2'      => pow($n, 2),
        ];

        $this->results[$n] = array_merge($complexities, $this->results[$n]);
    }

    /**
     * Display complexity analysis in a table
     *
     * @param  integer $n
     * @return void
     */
    private function displayResults(int $n)
    {
        $results = $this->results[$n];
        asort($results);

        $mask = " | %-25s | %-30s | \n";

        echo ' --------------------------------------------------------------'.PHP_EOL;
        printf($mask, 'Complexity / Algorithm', 'Iterations');
        echo ' --------------------------------------------------------------'.PHP_EOL;
        foreach ($results as $complexity => $iterations) {
            printf($mask, $complexity, $iterations);
        }
        echo ' --------------------------------------------------------------'.PHP_EOL;
    }

    /**
     * Create report and save to file
     *
     * @param  string $file
     * @return void
     */
    public function createReport(string $file)
    {
        $report = new Export($this->results);
        $report->saveTo($file);
    }
}
