<?php


namespace App\Command;



use App\Controller\BubbleSort;
use App\Controller\DataProvider;
use App\Controller\MergeSort;
use App\Controller\MinSort;
use App\Controller\Output;
use App\Controller\QuickSort;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SortAlgorithms extends Command
{

#Test file:         /sorting/public/array.txt
#Sorted test file:  /sorting/public/sorted.array.txt


    /**
     * @var MergeSort
     */
    private $mergesort;
    /**
     * @var MinSort
     */
    private $minsort;
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
     * @param MinSort $minSort
     * @param QuickSort $quickSort
     * @param MergeSort $mergeSort
     * @param DataProvider $path
     */

    public function __construct(
        BubbleSort $bubbleSort,
        MinSort $minSort,
        QuickSort $quickSort,
        Mergesort $mergeSort,
        DataProvider $path
        )
    {
        $this->bubblesort = $bubbleSort;
        $this->minsort = $minSort;
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
                bub = bubblesort 
                mer = mergeSort 
                min = minSort 
                qui = quickSort'
            )

            ->addOption(
            'terminal_output',
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
                $data= $this->bubblesort->BubbleSort($data);
                break;
            case 'qui':
                $data= $this->quicksort->QuickSort($data);
                break;
            case 'min':
                $data= $this->minsort->MinSort($data);
                break;
            case 'mer':
                $data= $this->mergesort->MergeSort($data);
        }


        //Array to String
        $data=trim(implode(" ", $data));

        //Output
        if ($input->getOption('terminal_output'))
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