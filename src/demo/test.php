<?php

require_once "cloud_server.php";
require_once "edge_server.php";
require_once "knapsack.php";
require_once "task.php";

$VM_1 = new Cloud( 8 , 4000 , 8000 , 200000 , 3000 );
$VM_2 = new Cloud( 4 , 4000 , 4000 , 200000 , 2500 );
$VM_3 = new Cloud( 4 , 4000 , 12000 , 200000 , 3000 );
$VM_4 = new Cloud( 8 , 4000 , 8000 , 200000 , 5000 );

$VM_5 = new Edge( 8 , 4000 , 8000 , 200000 , 200 );
$VM_6 = new Edge( 8 , 4000 , 8000 , 200000 , 250 );
$VM_7 = new Edge( 4 , 4000 , 12000 , 200000 , 500 );
$VM_8 = new Edge( 8 , 4000 , 8000 , 200000 , 500 );

$T1 = new Task( 80 , 1000 , 2000 , 1000 , microtime( TRUE ) );
$T2 = new Task( 80 , 1000 , 2000 , 1000 , microtime( TRUE ) );
$T3 = new Task( 80 , 1000 , 2000 , 1000 , microtime( TRUE ) );
$T4 = new Task( 80 , 1000 , 2000 , 1000 , microtime( TRUE ) );

$KS = new Knapsack();

$objects = [ 
    [ "value" => 90, "weight" => 17 ],
    [ "value" => 45, "weight" => 10 ],
    [ "value" => 50, "weight" => 15 ]
];
$w = 25;
var_dump( $KS->one_dimensional_integer_knapsack( $objects, $w ) );


?>