<?php


namespace App\Sorter;


class BubbleSort implements Sorting
{
    public function sort(array $data):array
    {

        $anz = count($data);
        for ($i = 0; $i < $anz; $i++) {
            for ($j = 0; $j < $anz - 1; $j++) {
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
