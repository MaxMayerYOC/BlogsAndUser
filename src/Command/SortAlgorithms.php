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
#Test File: /sorting/public/array.txt


    /**
     * @var BubbleSort
     * @var MinSort
     * @var QuickSort
     * @var MergeSort
     * @var DataProvider
     */

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
            ->setDescription('Sort a List in a File')

            ->addArgument(
                'path',
                InputArgument::REQUIRED,
                'Path to the file.'
            )

            ->addArgument(
                'sortalgorithm',
                InputArgument::REQUIRED,
                'Choose a sortalgorithm: bub = bubblesort mer = mergeSort min = minSort qui = quickSort.'
            )
            ->addOption(
            'terminal_output',
            't'
            );

    }


    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $path=$input->getArgument('path');
        $sort=$input->getArgument('sortalgorithm');

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

        $data=implode(", ", array_filter($data));

        //Output

        if ($input->getOption('terminal_output'))
        {
            $output->writeln(
                'The sorted Array: '.
                $data
            );
        } else
        {
            Output::Output($data,$path);
        }

        return Command::SUCCESS;
    }
}