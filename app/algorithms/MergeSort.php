<?php

namespace App\Algorithms;

use App\Sorter;
use App\Contracts\SortingAlgorithm;

class MergeSort extends Sorter implements SortingAlgorithm
{

    /**
     * Call the recursive sorting method with the initial numbers
     *
     * @return array
     */
    public function sort()
    {
        return $this->sortNumbers($this->numbers);
    }

    /**
     * Sort numbers with merge sort.
     * This is separate sorting method because this has to have
     * a parameter in order to work recursively.
     *
     * @param  array  &$numbers
     * @return array
     */
    private function sortNumbers(array &$numbers)
    {
        // If $numbers has only a single number return early
        if (count($numbers) <= 1) {
            return $numbers;
        }

        // Cut into halves
        list($left, $right) = array_chunk($numbers, ceil(count($numbers)/2));

        // Sort them recursively
        $left  = $this->sortNumbers($left);
        $right = $this->sortNumbers($right);

        // Merge sorted halves
        return $this->merge($left, $right);
    }

    /**
     * Merge ordered arrays and return
     *
     * @param  array  &$left
     * @param  array  &$right
     * @return array [this is still ordered!]
     */
    private function merge(array &$left, array &$right)
    {
        $result = [];

        while (count($left) || count($right)) {
            $this->iterations++;
            if (!isset($right[0]) || (isset($left[0]) && $left[0] <= $right[0])) {
                $result[] = array_shift($left);
            } else {
                $result[] = array_shift($right);
            }
        }

        return $result;
    }
}
