<?php


namespace App\Sorter;


use App\DataHandling\SortingInterface;

class SelectionSort implements SortingInterface
{
    #Runtime: n^2
    public static function getName(): string
    {
        return 'sel';
    }

    public function sort(array $data):array
    {
        $count=count($data);
        $k = 0;
        for ($j = 0; $j < $count; $j++) {
            for ($i = 0; $i < $count -$k; $i++) {

                if ($data[$i] == min($data)) {
                    $cache[$k] = $data[$i];
                    $z = $data[0];
                    $data[0] = $data[$i];
                    $data[$i] = $z;
                    array_shift($data);
                    $k++;
                }
            }
        }
        $k = 0;
        foreach ($cache as $value) {
            $data[$k] = $value;
            $k++;
        }
        return $data;
    }
}