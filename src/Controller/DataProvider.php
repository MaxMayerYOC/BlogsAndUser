<?php


namespace App\Controller;


class DataProvider
{
#Test File: /sorting/public/array.txt

    public function DataProvider($path)
    {
        //Scrap the data from the file in $path
        $data = file_get_contents('..'.$path);

        //Split the file into an array
        $data=preg_split("/[\s,]+/",$data);

        //Clean up the array
        foreach ($data as &$value)
        {

                $value = (filter_var($value, FILTER_SANITIZE_NUMBER_FLOAT));
        }
        return $data;
    }

}