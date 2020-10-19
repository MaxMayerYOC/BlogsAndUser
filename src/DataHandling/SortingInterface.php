<?php


namespace App\DataHandling;


interface SortingInterface
{
    public function sort(array $data):array;
    public static function getName():string;
}