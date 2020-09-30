<?php


namespace App\Command;


use App\Sorter\FileDataProvider;
use App\Sorter\DataProcessor;
use App\Sorter\Output;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SortCommand extends Command
{
#v.1.6
#Test file:         /sorting/public/TestData/array.txt
#Sorted test file:  /sorting/public/TestData/sorted.array.txt


    /**
     * @param FileDataProvider $path
     * @param DataProcessor $data
     * @var FileDataProvider
     * @var DataProcessor
     */


    private $filedataprovider;
    private $dataprocessor;
    private $projectDir;


    public function __construct(
        FileDataProvider $path,
        DataProcessor $data,
        string $projectDir
        )
    {
        $this->filedataprovider=$path;
        $this->dataprocessor=$data;
        $this->projectDir = $projectDir;
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
        $path= $input->getArgument('path');
        #$this->projectDir.

        $sortalgorithm=$input->getArgument('algorithm');
        $data = $this->filedataprovider->provide($path);

        array_unshift($data,$sortalgorithm);
        $data= $this->dataprocessor->process ($data);

        //Output
        if ($input->getOption('terminal-output'))
        {
            $output->writeln('The sorted Array: '.$data);
        } else
        {
            $path=Output::save($data,$path);
            $output->writeln('Sorted array saved into: ..'.$path);
        }

        return Command::SUCCESS;
    }
}