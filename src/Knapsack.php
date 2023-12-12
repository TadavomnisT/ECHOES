<?php

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