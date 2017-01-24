<?php

namespace App\Algorithms;

use App\Sorter;
use App\Contracts\SortingAlgorithm;

class BubbleSort extends Sorter implements SortingAlgorithm
{

    /**
     * Sort the numbers array
     *
     * @return array
     */
    public function sort()
    {
        $size = count($this->numbers);

        for ($i=0; $i<$size; $i++) {
            for ($j=0; $j<$size-1-$i; $j++) {
                if ($this->numbers[$j+1] < $this->numbers[$j]) {
                    $this->iterations++;
                    $this->swap($j, $j+1);
                }
            }
        }

        return $this->numbers;
    }

    /**
     * Swap numbers by index
     *
     * @param  integer $x
     * @param  integer $y
     * @return void
     */
    private function swap($x, $y)
    {
        $tmp               = $this->numbers[$x];
        $this->numbers[$x] = $this->numbers[$y];
        $this->numbers[$y] = $tmp;
    }

}
