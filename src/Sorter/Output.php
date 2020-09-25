<?php


namespace App\Sorter;



class Output
{
    public static function Output($data,$path)
    {
        //Create the new path
        $path=explode('/',$path);
        $path[count($path)-1]='sorted.'.$path[count($path)-1];
        $path=implode('/',$path);

        //Save the file
        file_put_contents("..".$path, $data);

        return $path;
    }
}