<?php


namespace App\Sorter;



class Output
{
    public static function save($data, $path)
    {
        //Create the new path
        $path=explode('/',$path);
        $path[count($path)-1]='sorted.'.$path[count($path)-1];
        $path=implode('/',$path);
#var_dump($path); die();

        #var_dump(is_writable($path)); die();
        //Save the file
        file_put_contents($path, $data);

        return $path;
    }
}