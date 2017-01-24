<?php

namespace App;

use App\Contracts\ProvidesFeedback;

abstract class Sorter implements ProvidesFeedback
{
    
    /**
     * Internal iterations counter
     *
     * @var int
     */
    protected $iterations = 0;

    /**
     * Array of numbers to sort
     *
     * @var array
     */
    protected $numbers;

    /**
     * Accepts an array of numbers to sort
     *
     * @param array $numbers
     */
    public function __construct($numbers)
    {
        $this->numbers    = $numbers;
    }

    /**
     * Get iteration counter
     *
     * @return integer
     */
    public function getIterations()
    {
        return $this->iterations;
    }
}
