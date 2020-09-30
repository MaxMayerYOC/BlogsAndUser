<?php



namespace App\Sorter;

use App\Sorter\BubbleSort;
use App\Sorter\MergeSort;
use App\Sorter\SelectionSort;
use App\Sorter\QuickSort;



class DataProcessor
{
    /**
     * @param BubbleSort $bubbleSort
     * @param SelectionSort $selSort
     * @param QuickSort $quickSort
     * @param MergeSort $mergeSort
     * @var MergeSort
     * @var SelectionSort
     * @var QuickSort
     * @var BubbleSort
     */
    private $bubblesort;
    private $quicksort;
    private $selsort;
    private $mergesort;

    public function __construct(
        BubbleSort $bubbleSort,
        SelectionSort $selSort,
        QuickSort $quickSort,
        Mergesort $mergeSort
    )
    {
        $this->bubblesort = $bubbleSort;
        $this->selsort = $selSort;
        $this->quicksort=$quickSort;
        $this->mergesort=$mergeSort;
    }

    public function process ($sort_data)
    {
        #$data=DataProcessor::process($data,$sortalgorithm);
        //Choose the Sort Algorithm
        $sortalgorithm=array_shift($sort_data);
        $data=$sort_data;

        switch ($sortalgorithm) {
            case 'bub':
                $data= $this->bubblesort->sort($data);
                break;
            case 'qui':
                $data= $this->quicksort->sort($data);
                break;
            case 'sel':
                $data= $this->selsort->sort($data);
                break;
            case 'mer':
                $data= $this->mergesort->sort($data);
        }

        //Array to String
        $data=trim(implode(" ", $data));

        return $data;
    }
}