<?php


namespace App\Controller;


class Output
{
    public static function Output($data,$path)
    {
        $path=explode('/',$path);
        $path[count($path)-1]='sorted.'.$path[count($path)-1];
        $path=implode('/',$path);

        file_put_contents("..".$path, $data);
    }
}