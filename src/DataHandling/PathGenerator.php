<?php

declare(strict_types=1);

namespace App\DataHandling;


class PathGenerator
{
    public static function newPath(string $path,bool $sec)
    {
        if ($sec==false){
            //Create the new path
            $path=explode('/',$path);
            $path[count($path)-1]='sorted.'.$path[count($path)-1];
            $path=implode('/',$path);
            return $path;

        }
        $path=explode('/',$path);
        $filename=$path[count($path)-1];
        $path[count($path)-1]='sorted.'.$filename;
        $path=implode('/',$path);
        $k=2;
        while (file_exists($path)){
            $path=explode('/',$path);
            $path[count($path)-1]='sorted.'.$k.'.'.$filename;
            $path=implode('/',$path);
            $k++;
        }
        return $path;
    }
}