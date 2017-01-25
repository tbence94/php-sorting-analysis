<?php

namespace App\Algorithms;

use App\Sorter;
use App\Contracts\SortingAlgorithm;

class SelectionSort extends Sorter implements SortingAlgorithm
{

    /**
     * Sort numbers using the selection sort algorithm
     *
     * @return array
     */
    public function sort()
    {
        $size = count($this->numbers);
        
        for ($i = 0; $i < $size; $i++) {
            $min    = null;
            $minKey = null;

            for ($j = $i; $j < $size; $j++) {
                $this->iterations++;
                if (null === $min || $this->numbers[$j] < $min) {
                    $minKey = $j;
                    $min    = $this->numbers[$j];
                }
            }

            $this->numbers[$minKey] = $this->numbers[$i];
            $this->numbers[$i]      = $min;
        }

        return $this->numbers;
    }
}
