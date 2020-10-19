<?php


namespace App\DataHandling;

interface SortRegistry
{
    /**
     * @param string $name
     * @return SortingInterface
     *@throws \Exception
     */
    public function findByName(string $name):SortingInterface;
}