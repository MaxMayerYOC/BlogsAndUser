<?php


namespace App\Sorter;


use App\DataHandling\SortingInterface;

class BubbleSort implements SortingInterface
{
    public static function getName(): string
    {
        return 'bub';
        // TODO: Implement getName() method.
    }
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
