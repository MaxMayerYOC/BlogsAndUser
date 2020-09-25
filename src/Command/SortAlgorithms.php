<?php


namespace App\Command;



use App\Sorter\BubbleSort;
use App\Sorter\DataProvider;
use App\Sorter\MergeSort;
use App\Sorter\SelectionSort;
use App\Sorter\Output;
use App\Sorter\QuickSort;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SortAlgorithms extends Command
{
#v.1.5
#Test file:         /sorting/public/TestData/array.txt
#Sorted test file:  /sorting/public/TestData/sorted.array.txt


    /**
     * @var MergeSort
     */
    private $mergesort;
    /**
     * @var SelectionSort
     */
    private $selsort;
    /**
     * @var QuickSort
     */
    private $quicksort;
    /**
     * @var BubbleSort
     */
    private $bubblesort;
    /**
     * @var DataProvider
     */
    private $dataprovider;

    /**
     * SortAlgorithms constructor.
     * @param BubbleSort $bubbleSort
     * @param SelectionSort $selSort
     * @param QuickSort $quickSort
     * @param MergeSort $mergeSort
     * @param DataProvider $path
     */

    public function __construct(
        BubbleSort $bubbleSort,
        SelectionSort $selSort,
        QuickSort $quickSort,
        Mergesort $mergeSort,
        DataProvider $path
        )
    {
        $this->bubblesort = $bubbleSort;
        $this->selsort = $selSort;
        $this->quicksort=$quickSort;
        $this->mergesort=$mergeSort;
        $this->dataprovider=$path;
        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setName('sorter')
            ->setDescription('Sort a array of numbers  from a file
  and save it in a new file
  or output it in the Terminal.')

            ->addArgument(
                'path',
                InputArgument::REQUIRED,
                'Path to the file.'
            )

            ->addArgument(
                'algorithm',
                InputArgument::REQUIRED,
                'Choose a algorithm:
                bub = Bubblesort 
                mer = Mergesort 
                sel = SelectionSort 
                qui = Quicksort'
            )

            ->addOption(
            'terminal-output',
            't'
            );
    }


    protected function execute(InputInterface $input, OutputInterface $output)
    {
        //Get the inputs and data
        $path=$input->getArgument('path');
        $sort=$input->getArgument('algorithm');
        $data = $this->dataprovider->DataProvider($path);


        //Choose the Sort Algorithm
        switch ($sort) {
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

        //Output
        if ($input->getOption('terminal-output'))
        {
            $output->writeln('The sorted Array: '.$data);
        } else
        {
            $path=Output::Output($data,$path);
            $output->writeln('Sorted array saved into: ..'.$path);
        }

        return Command::SUCCESS;
    }
}