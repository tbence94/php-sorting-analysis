<?php

namespace App\Algorithms;

use App\Sorter;
use App\Contracts\SortingAlgorithm;

class QuickSort extends Sorter implements SortingAlgorithm
{
    /**
     * Call quicksort's recursive method
     *
     * @return array
     */
    public function sort()
    {
        return $this->quickSort($this->numbers);
    }

    /**
     * An implementation of the quick sort algorithm
     * 
     * @param  array $numbers
     * @return array
     */
    public function quickSort(array &$numbers)
    {
        if (count($numbers) < 2) {
            return $numbers;
        }

        $left  = [];
        $right = [];

        $pivot_key = key($numbers);
        $pivot     = array_shift($numbers);

        foreach ($numbers as $k => $v) {
            $this->iterations++;
            
            if ($v < $pivot) {
                $left[$k] = $v;
            } else {
                $right[$k] = $v;
            }
        }

        $left  = $this->quickSort($left);
        $right = $this->quickSort($right);

        return array_merge($left, [$pivot_key => $pivot], $right);
    }
}
