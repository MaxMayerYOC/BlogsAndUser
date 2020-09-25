<?php


namespace App\Sorter;


class QuickSort
{
    public function sort(array $data):array
    {
        $left=0;
        //split the data array into two parts
        $right=count($data)-1;
        $data=$this->splitter($left, $right, $data);
        return $data;
    }



    private function splitter (int $left,int $right,array $data){
        if ($left < $right){
            $data=$this->sorter($left, $right, $data);
            $splitpoint=array_shift($data);
                $data=$this->splitter($left, $splitpoint-1, $data);
                $data=$this->splitter($splitpoint+1, $right, $data);
        }
        return $data;
    }




    private function sorter(int $left,int $right,array $data){
        $splitpoint=$left;
        //start j left from pivotelement
        $j=$right-1;
        $pivot=$data[$right];
        while($splitpoint<$j){
            while($splitpoint<$right and $data[$splitpoint]<$pivot){
                $splitpoint=$splitpoint+1;
            }
            while($j>$left and $data[$j]>=$pivot){
                $j=$j-1;
            }
            if ($splitpoint<$j){
                $z=$data[$splitpoint];
                $data[$splitpoint]=$data[$j];
                $data[$j]=$z;
            }
        }

        if ($data[$splitpoint]>$pivot){
            $z=$data[$splitpoint];
            $data[$splitpoint]=$data[$right];
            $data[$right]=$z;
        }
        array_unshift($data,$splitpoint);
        return $data;
    }
}