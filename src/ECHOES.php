<?php

require_once "Simulator.php";

$ECHOES = new Simulator();

// // Testing: getMethods()
// var_dump($ECHOES->getMethods());

// // Testing: getAssignMethod()
// var_dump($ECHOES->getAssignMethod());

// // Testing: getTimestampMS()
// var_dump($ECHOES->getTimestampMS());

// // Testing: getTimestampMS( time() )
// var_dump($ECHOES->getTimestampMS( time() ));

// // Testing: createTask()
// $T1 = $ECHOES->createTask(
//     "T1",
//     "Medium",
//     1,
//     200,
//     128,
//     1024,
//     time(),
//     $ECHOES->getTimestampMS(),
//     512,
//     256,
//     3600,
//     "Medium",
//     "synchronous",
//     Null,
//     3600
// );
// // Testing: getTaskDetails()
// var_dump( $ECHOES->getTaskDetails($T1) );

// // Testing: createServer()
// $S1 = $ECHOES->createServer(
//     "S1",
//     "Edge",
//     8,
//     16000,
//     32768,
//     28672,
//     1048576,
//     786432,
//     10,
//     10,
//     12,
//     1000,
//     1.5,
//     98,
//     True
// );
// // Testing: getServerStatus()
// var_dump( $ECHOES->getServerStatus($S1) );

// // Testing: createEdgeServer()
// $E1 = $ECHOES->createEdgeServer(
//     "E1",
//     8,
//     16000,
//     32768,
//     28672,
//     1048576,
//     786432,
//     10,
//     10,
//     12,
//     1000,
//     1.5,
//     98,
//     True,
//     "GEOL_356",
//     24
// );
// // Testing: getEdgeServerStatus()
// var_dump( $ECHOES->getEdgeServerStatus($E1) );

// // Testing: createCloudServer()
// $C1 = $ECHOES->createCloudServer(
//     "C1",
//     8,
//     16000,
//     32768,
//     28672,
//     1048576,
//     786432,
//     10,
//     10,
//     12,
//     1000,
//     1.5,
//     98,
//     True,
//     "GEOL_356",
//     24.
// );
// // Testing: getCloudServerStatus()
// var_dump( $ECHOES->getCloudServerStatus($E1) );

// // Testing: getServers()
// var_dump( $ECHOES->getServers() );

// // Testing: getCloudServers()
// var_dump( $ECHOES->getCloudServers() );

// // Testing: getEdgeServers()
// var_dump( $ECHOES->getEdgeServers() );

// // Testing: getTasks()
// var_dump( $ECHOES->getTasks() );

// // Testing: deleteTask()
// var_dump( $ECHOES->deleteTask( $T1 ) );
// var_dump( $ECHOES->getTasks() );

// // Testing: deleteServer()
// var_dump( $ECHOES->deleteServer( $S1 ) );
// var_dump( $ECHOES->getServers() );

// // Testing: deleteEdgeServer()
// var_dump( $ECHOES->deleteEdgeServer( $E1 ) );
// var_dump( $ECHOES->getEdgeServers() );

// // Testing: deleteCloudServer()
// var_dump( $ECHOES->deleteCloudServer( $C1 ) );
// var_dump( $ECHOES->getCloudServers() );

// // Testing: setAssignMethod()
// var_dump( $ECHOES->setAssignMethod( "Random" ) );
// var_dump( $ECHOES->getAssignMethod() );

// // Testing: generateRandomTasks()
// var_dump( $ECHOES->generateRandomTasks( 50 ) );
// var_dump( $ECHOES->getTasks() );

// // Testing: generateRandomServers()
// var_dump( $ECHOES->generateRandomServers( 20 ) );
// var_dump( $ECHOES->getServers() );
// var_dump( $ECHOES->getEdgeServers() );
// var_dump( $ECHOES->getCloudServers() );

// // Testing: getAllServers()
// var_dump( $ECHOES->getAllServers() );

$ECHOES->generateRandomServers( 20 );
$ECHOES->generateRandomTasks( 200 );
$ECHOES->startSimulation();


// TODO:
// calculateExecutionTime()
// assignTask()
// assignAllTasks()
// startSimulation()


?>