<?php



namespace App\DataHandling;


class DataProcessor
{
    protected $registry;
    /**
     * @var array
     */
    public $sorter;

    public function __construct(
        SortRegistry $registry
    )
    {
        $this->registry=$registry;
        $this->sorter=[];
    }

    public function processing ($sortalgorithm, $data)
    {
        //Choose the Sort Algorithm
        $sorterObject=$this->registry->findByName($sortalgorithm);
        $data=$sorterObject->sort($data);

        //Array to String
        $data=trim(implode(" ", $data));

        return $data;
    }

}