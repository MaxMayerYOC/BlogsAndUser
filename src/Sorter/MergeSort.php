<?php


namespace App\Sorter;


use App\DataHandling\SortingInterface;

class MergeSort implements SortingInterface
{
    public static function getName(): string
    {
        return 'mer';
        // TODO: Implement getName() method.
    }
    #Runtime: n log n
    public function sort(array $data): array
    {
        if (count($data) <= 1) {
            return $data;
        } else {
            $k = 0;
            $i = 0;
            $j = 0;
            //Split the array
            foreach ($data as $value) {
                if ($k <= round(count($data) / 2 - 1)) {
                    $left[$i] = $value;
                    $i++;
                } else {
                    $right[$j] = $value;
                    $j++;
                }
                $k++;
            }
            //Recursive split until they are arrays of 1-2 values
            $left = $this->sort($left);
            $right = $this->sort($right);
            //Combine two arrays
            $data = $this->merge($left, $right);
            return $data;
        }
    }

    private function merge(array $left, array $right)
    {
        //Combine two arrays of size 1-2, by comparing them
        $k = 0;
        while (!(empty($left) or empty($right))) {

            if ($left[0] <= $right[0]) {
                $data[$k] = array_shift($left);
            } else {
                $data[$k] = array_shift($right);
            }
            $k++;
        }
        while (!empty($left)) {
            $data[$k] = array_shift($left);
            $k++;
        }
        while (!empty($right)) {
            $data[$k] = array_shift($right);
            $k++;
        }
        return $data;
    }
}