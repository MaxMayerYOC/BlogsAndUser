<?php


namespace App\Sorter;


class MergeSort implements Sorting
{
    public function sort(array $data): array
    {
        if (count($data) <= 1) {
            return $data;
        } else {
            $k = 0;
            $i = 0;
            $j = 0;
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
            $left = $this->sort($left);
            $right = $this->sort($right);
            $data = $this->merge($left, $right, $data);
            return $data;
        }
    }

    private function merge(array $left, array $right, array $data)
    {

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