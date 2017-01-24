<?php

namespace App\Contracts;

interface SortingAlgorithm
{
    /**
     * SortingAlgorithms must provide a public constructor where
     * they can accept the input array of numbers to sort
     *
     * @param array $numbers [an array of integers to sort]
     */
    public function __construct($numbers);

    /**
     * SortingAlgorithms must provide a public sort function
     *
     * @return array [sorted array of numbers]
     */
    public function sort();
}
