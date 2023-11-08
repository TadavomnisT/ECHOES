<?php


class Knapsack
{
    function one_dimensional_integer_knapsack( $objects, $w )
    {
        $n = count( $objects );
        $m = [ 0 ];
        for ($j=1; $j <= $n ; $j++) { 
            for ($y=1; $y <= $w ; $y++) { 
                if ( $objects[ $j ]["weight"] > $y ) {
                    $m[$j][$y] = $m[$j-1][$y];
                }
                else {
                    $m[$j][$y] = max(
                        $m[$j-1][$y],
                        $objects[ $j ]["value"] + $m[$j-1][$w-$objects[$j]["weight"]]
                    );
                }
            }
        }
        return $m[$n][$w];
    }
}


?>