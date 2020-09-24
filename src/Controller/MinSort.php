<?php


namespace App\Controller;


class MinSort
{
    public function MinSort($data)
    {
        $anz=count($data);
        $k=0;
        for($j=0;$j<$anz-1;$j++){
            for($i=0;$i<$anz-$k;$i++){

                if ($data[$i] == min($data)){
                    $erg[$k]=$data[$i];
                    $y=$data[0];
                    $data[0]=$data[$i];
                    $data[$i]=$y;
                    array_shift($data);
                    $k++;
                }
            }
        }
        $k=0;
        foreach($erg as $value){
            $data[$k]=$value;
            $k++;
        }
        return $data;
    }
}