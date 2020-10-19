<?php


namespace App\DataHandling;

use App\DataHandling\PathGenerator;

class Output
{
    public static function save($data, $path, $sec)
    {
        //Create the new path
       $path=PathGenerator::newPath($path,$sec);
        //Save the file
        file_put_contents($path, $data);

        return $path;
    }
}