<?php


namespace App\Sorter;


class BubbleSort implements Sorting
{
    #Runtime: n^2
    public function sort(array $data):array
    {

        $count = count($data);
        for ($i = 0; $i < $count; $i++) {
            for ($j = 0; $j < $count - 1; $j++) {
                if ($data[$j] > $data[$j + 1]) {
                    $y = $data[$j];
                    $data[$j] = $data[$j + 1];
                    $data[$j + 1] = $y;
                }
            }
        }
        return $data;
    }
}
