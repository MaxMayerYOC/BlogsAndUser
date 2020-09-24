<?php


namespace App\Controller;


class MergeSort
{
    public function mergesort($data)
    {

        function merges($mergelist){
            if(count($mergelist)<=1){
                return $mergelist;
            }else{
                $k=0;
                $i=0;
                $j=0;
                foreach($mergelist as $value){
                    if($k<=round(count($mergelist)/2-1)){
                        $linkeliste[$i]=$value;
                        $i++;
                    }else{
                        $rechteliste[$j]=$value;
                        $j++;
                    }
                    $k++;
                }
                $linkeliste=merges($linkeliste);
                $rechteliste=merges($rechteliste);
                $mergelist=merge($linkeliste, $rechteliste);
                return $mergelist;
            }
        }

        function merge($linkeliste, $rechteliste){
            global $data, $z;
            $k=0;
            while (!(empty($linkeliste) or empty($rechteliste))){

                if($linkeliste[0]<=$rechteliste[0]){
                    $mergelist[$k]=array_shift($linkeliste);
                }else{
                    $mergelist[$k]=array_shift($rechteliste);
                }
                $k++;
            }
            while(!empty($linkeliste)){
                $mergelist[$k]=array_shift($linkeliste);
                $k++;
            }
            while(!empty($rechteliste)){
                $mergelist[$k]=array_shift($rechteliste);
                $k++;
            }

            return $mergelist;
        }
        return $data=merges($data);
    }
}