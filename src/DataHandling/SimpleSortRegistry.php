<?php


namespace App\DataHandling;


class SimpleSortRegistry implements SortRegistry
{
    /**
     * @var array
     */
    public $sorters;

    public function __construct()
    {
        $this->sorters=[];
    }

    public function findByName(string $name):SortingInterface
    {
        foreach ($this->sorters as $id) {
            if ($id->getName()==$name)
                return $id;
        }
        throw new \Exception('No supported sorting algorithm found!');
    }

    public function addSorter(SortingInterface $sorting)
    {
        $this->sorters[]=$sorting;
    }
}
