<?php

require_once "Simulator.php";

$ECHOES = new Simulator();

var_dump($ECHOES->getMethods());
// var_dump($ECHOES->getAssignMethod());
// var_dump($ECHOES->getTimestampMS());
// var_dump($ECHOES->getTimestampMS( time() ));

$T1 = $ECHOES->createTask(
    "T1",
    "Medium",
    1,
    200,
    128,
    1024,
    time(),
    $ECHOES->getTimestampMS(),
    512,
    256,
    3600,
    "Medium",
    "synchronous"
);
var_dump( $ECHOES->getTaskDetails($T1) );



?>