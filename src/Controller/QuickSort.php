<?php


namespace App\Controller;


class QuickSort
{
    public function QuickSort($data)
    {
        $GLOBALS["fin"]=$data;
        global $fin;
        function quick(){
            global $fin;
            $left=0;
            //split the data array into two parts
            $right=count($fin)-1;
            qsort($left, $right);

        }


        function qsort($left, $right){
            if ($left < $right){
                $splitter=split($left, $right);
                qsort($left, $splitter-1);
                qsort($splitter+1, $right);
            }
        }



        function split($left, $right){
            global $fin;

            $i=$left;
            //start j left from pivotelement
            $j=$right-1;

            $pivot=$fin[$right];

            while($i<$j){
                while($i<$right and $fin[$i]<$pivot){
                    $i=$i+1;
                }
                while($j>$left and $fin[$j]>=$pivot){
                    $j=$j-1;
                }
                if ($i<$j){
                    $z=$fin[$i];
                    $fin[$i]=$fin[$j];
                    $fin[$j]=$z;
                }
            }
            if ($fin[$i]>$pivot){
                $z=$fin[$i];
                $fin[$i]=$fin[$right];
                $fin[$right]=$z;
            }


            return $i;
        }
        quick();
        return $fin;
    }
}