<?php


namespace App\Controller;

use App\Sorter\DataProcessor;
use App\Sorter\Output;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SortController extends AbstractController
{
    /**
    * @param DataProcessor $data
    */
    private $dataprocessor;
    private $projectDir;
    public function __construct(
        DataProcessor $data,
        string $projectDir
    )
    {
        $this->dataprocessor=$data;
        $this->projectDir = $projectDir;
    }

    /**
     * @Route ("/", name="app_homepage")
     * @return Response
     */



    public function homepage()
    {
        $data=' no file uploaded';
        if (!empty($_REQUEST["sort"])) {
            $sort = $_REQUEST["sort"];

            if (!empty($_FILES["fileToUpload"]["tmp_name"])) {

                $data = file_get_contents($_FILES["fileToUpload"]["tmp_name"]);

                //Split the file into an array
                $data=preg_split("/[\s,]+/",$data);

                //Clean up the array
                foreach ($data as &$value) {
                    $value = (filter_var($value, FILTER_SANITIZE_NUMBER_FLOAT));
                }

                //Process the data
                array_unshift($data,$sort);
                $data= $this->dataprocessor->process ($data);

                $data='here is your sorted data: '.$data;

                //Output the data



               # var_dump($projectDir); die();
                #var_dump($_FILES["fileToUpload"]["name"]);

                $path=$this->projectDir. '/public/TestData/'.$_FILES["fileToUpload"]["name"];
                $path=Output::save($data,$path);

            }
        }
        return $this->render('sorter/homepage.twig', ['data' => $data,'sort'=>$sort]);

    }
}