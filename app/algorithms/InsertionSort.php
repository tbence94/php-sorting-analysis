<?php

namespace App\Algorithms;

use App\Sorter;
use App\Contracts\SortingAlgorithm;

class InsertionSort extends Sorter implements SortingAlgorithm
{
    /**
     * Sort numbers with insertion sort algorithm
     *
     * @return array
     */
    public function sort()
    {
        $size=count($this->numbers);

        for ($i = 1; $i < $size; $i++) {
            $number = $this->numbers[$i];
            $j = $i;

            while ($j > 0 && $this->numbers[$j-1] > $number) {
                $this->numbers[$j] = $this->numbers[$j-1];
                $j = $j-1;
            }

            $this->numbers[$j] = $number;
        }

        return $this->numbers;
    }
}
