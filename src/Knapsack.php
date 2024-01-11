<?php

/*
Example:

$MKP = new Knapsack;

$item_values=[78, 35, 89, 36, 94, 75, 74, 100, 80, 16];
$item_weights=[18, 9, 23, 20, 59, 61, 70, 75, 76, 30];

$knapsacks=[90, 100];
var_dump( $MKP->MKP_server($knapsacks,$item_values,$item_weights) );

*/

class Knapsack
{

    // Constructor
    public function __construct() {
        // Nth yet
    }

    // Solve Multiple-Knapsack-Problem(MKP)
    // I should add MTM/MTHM option later
    public function MKP_sell( array $knapsacks, array $item_values, array $item_weights )
    {
        return json_decode(shell_exec("python Knapsack.py " . json_encode( [ $item_values, $item_weights, $knapsacks ] ))) ;
    }

    public function MKP( array $knapsacks, array $item_values, array $item_weights )
    {
        $url = 'http://localhost:5000/solve_knapsack';
        $data = array('item_values' => $item_values, 'item_weights' => $item_weights, 'knapsacks' => $knapsacks);
        $options = array(
            'http' => array(
                'header'  => "Content-type: application/json\r\n",
                'method'  => 'POST',
                'content' => json_encode($data)
            )
        );
        $context  = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        // var_dump(json_decode($result, true));die;
        return json_decode($result, true);
    }

    // Get methods of this class 
    public function getMethods()
    {
        return get_class_methods( get_class( $this ) ) ;
    }

}

?>