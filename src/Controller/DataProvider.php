<?php


namespace App\Controller;


class DataProvider
{
#Test File: /sorting/public/array.txt

    public function DataProvider($path)
    {
        $data = file_get_contents('..'.$path);

        $data=explode(',',$data);

        foreach ($data as &$value)
        {
                $value = (filter_var($value, FILTER_SANITIZE_NUMBER_INT));
        }

        return $data;
    }

}