<?php

/*
Example:

$item_values=[78, 35, 89, 36, 94, 75, 74, 100, 80, 16];
$item_weights=[18, 9, 23, 20, 59, 61, 70, 75, 76, 30];
$knapsacks=[90, 100];
*/

class Knapsack
{

    // Constructor
    public function __construct() {
        // Nth yet
    }

    // Solve Multiple-Knapsack-Problem(MKP)
    public function MKP( array $knapsacks, array $item_values, array $item_weights )
    {
        return json_decode(shell_exec("python Knapsack.py " . json_encode( [ $item_values, $item_weights, $knapsacks ] ))) ;
    }

    // Get methods of this class 
    public function getMethods()
    {
        return get_class_methods( get_class( $this ) ) ;
    }

}

?>