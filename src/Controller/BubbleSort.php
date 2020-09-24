<?php


namespace App\Controller;


class BubbleSort
{
    public function BubbleSort($data)
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