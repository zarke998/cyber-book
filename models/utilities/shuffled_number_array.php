<?php 

    function generate_shuffled_number_array($size){
        $array = [];

        $shuffled_array = [];

        for($i = 0; $i < $size; $i++)
            $array[] = $i;

        for($i = 0; $i < $size; $i++){
            $rand_num = rand(0, $size-1);

            while(in_array($rand_num, $shuffled_array)){
                $rand_num = rand(0, $size-1);
            }

            $shuffled_array[] = $rand_num;
        }

        return $shuffled_array;
    }
?>