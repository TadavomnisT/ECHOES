<?php

/*

ECHOES-Logo:

        c########################.
                ########   .######;.                               xxxxxxx
                .:###=            ,###:.XXXXX..            //.....,xx   xx.
.====.      =###=             .;##XXXXXXXXXXXXc,.         //      .xx   xx.
.######     .###.            =c###XXXXXXXXXXXXXXXX#,.....//        xxxXdxx.
            ####,   .=############XXXXXXXXXXX
        .;c##### ,###############XXXXXXXXXXX.........
        =c###=    .################XXXXXXXXXXXXXXXXXXddX       xxxxxxx.
    ....:###       =################XXXXXXXXXXXXXXXXXXddd......xx   xx.
,######,         c###############XXXXX.                        xxxxxxx.
                    ,#############XXXXXc;;;;;;;;;::::::
    .######,               ########XXXXXXXXXXXXXXXXXXddd........
    .#######               .#######XXXXXXXXXXXX=               \\       xxxxxxx.
                            ,#######XXXXXXXXXXXX:......         \\......xx   xx.
        .=,,,,,,,,,,,,,,,,:########XXXXXXXXXXXXXXXXX#                   xxxxxxx.
        ###########################XXXXXXXXXXXXXXXXXX;;.
 _____ ____ _   _  ___  _____ ____   .XXXXXXXXXXXXXX:;\\
| ____/ ___| | | |/ _ \| ____/ ___|                    \\     xxxxxxx.
|  _|| |   | |_| | | | |  _| \___ \                     \\....xx   xx.
| |__| |___|  _  | |_| | |___ ___) |                          xxxxxxx.
|_____\____|_| |_|\___/|_____|____/

---------------------------------------------------------------------

* Copyright (c) 2023 Behrad.B (behroora@yahoo.com)
AUTHOR :            TadavomnisT (Behrad.B)
Repo :              https://github.com/TadavomnisT/ECHOES
REPORTING BUGS :    https://github.com/TadavomnisT/ECHOES/issues
COPYRIGHT :
    Copyright (c) 2023   License GPLv3+
    This is free software: you are free to change and redistribute it.
    There is NO WARRANTY, to the extent permitted by law.

---------------------------------------------------------------------

*/


require_once "Simulator.php";

$ECHOES = new Simulator();

// // Testing: getMethods() for Simulator
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

// // Testing: getMethods() for Task
// require_once "Simulator.php";
// $Task = new Task(
//         "T1",
//         "Medium",
//         1,
//         200,
//         128,
//         1024,
//         time(),
//         $ECHOES->getTimestampMS(),
//         512,
//         256,
//         3600,
//         "Medium",
//         "synchronous",
//         Null,
//         3600
//     );
// var_dump($Task->getMethods());

// // Testing: getMethods() for Server
// require_once "Server.php";
// $server = new Server(
//         "S1",
//         "Edge",
//         8,
//         16000,
//         32768,
//         28672,
//         1048576,
//         786432,
//         10,
//         10,
//         12,
//         1000,
//         1.5,
//         98,
//         True
//     );
// var_dump($server->getMethods());

// // Testing: getMethods() for Cloud
// require_once "Cloud.php";
// $cloud = new Cloud(
//         "C1",
//         8,
//         16000,
//         32768,
//         28672,
//         1048576,
//         786432,
//         10,
//         10,
//         12,
//         1000,
//         1.5,
//         98,
//         True,
//         "GEOL_356",
//         24.
//     );
// var_dump($cloud->getMethods());

// // Testing: getMethods() for Edge
// require_once "Edge.php";
// $edge = new Edge(
//         "E1",
//         8,
//         16000,
//         32768,
//         28672,
//         1048576,
//         786432,
//         10,
//         10,
//         12,
//         1000,
//         1.5,
//         98,
//         True,
//         "GEOL_356",
//         24
//     );
// var_dump($edge->getMethods());

// // Testing: calculateExecutionTime()
// $ECHOES->generateRandomServers( 20 );
// $ECHOES->generateRandomTasks( 1 );
// foreach ($ECHOES->getTasks() as $task) {
//     foreach ($ECHOES->getAllServers() as $server) {
//         echo $task->getEstimateExecutionTime() . ", " . $server["Type"] . " " . $ECHOES->calculateExecutionTime( $task, $server["Object"] ) . PHP_EOL ;
//     }
// }

// // Testing: getTasksAsJSON()
// $ECHOES->generateRandomTasks( 50 );
// var_dump( $ECHOES->getTasksAsJSON() );
// var_dump( $ECHOES->getTasksAsJSON(true) );
// var_dump( $ECHOES->getTasksAsJSON(false,true) );
// var_dump( $ECHOES->getTasksAsJSON(true,true) );
// var_dump( json_decode($ECHOES->getTasksAsJSON()) );
// var_dump( json_decode($ECHOES->getTasksAsJSON(true)) );
// var_dump( json_decode($ECHOES->getTasksAsJSON(false,true)) );
// var_dump( json_decode($ECHOES->getTasksAsJSON(true,true)) );

// // Testing: getServersAsJSON()
// $ECHOES->generateRandomServers( 50 );
// var_dump( json_decode($ECHOES->getServersAsJSON()) );
// var_dump( json_decode($ECHOES->getServersAsJSON(true)) );
// var_dump( json_decode($ECHOES->getServersAsJSON(false, true)) );
// var_dump( json_decode($ECHOES->getServersAsJSON(true, true)) );
// var_dump( $ECHOES->getServersAsJSON() );
// var_dump( $ECHOES->getServersAsJSON(true) );
// var_dump( $ECHOES->getServersAsJSON(false, true) );
// var_dump( $ECHOES->getServersAsJSON(true, true) );

// // Testing: getServersAsJSON() with active tasks
// $ECHOES->generateRandomServers( 50 );
// $ECHOES->generateRandomTasks( 100 );
// $ECHOES->setAssignMethod( "Knapsack" );
// $ECHOES->assignAllTasks();
// var_dump( json_decode($ECHOES->getServersAsJSON()) );
// var_dump( json_decode($ECHOES->getServersAsJSON(true)) );
// var_dump( json_decode($ECHOES->getServersAsJSON(false, true)) );
// var_dump( json_decode($ECHOES->getServersAsJSON(true, true)) );
// var_dump( $ECHOES->getServersAsJSON() );
// var_dump( $ECHOES->getServersAsJSON(true) );
// var_dump( $ECHOES->getServersAsJSON(false, true) );
// var_dump( $ECHOES->getServersAsJSON(true, true) );

// // Testing: getTasksAsCSV()
// $ECHOES->generateRandomTasks( 50 );
// var_dump( $ECHOES->getTasksAsCSV() );
// var_dump( $ECHOES->getTasksAsCSV(true) );
// var_dump( $ECHOES->getTasksAsCSV(false, true) );
// var_dump( $ECHOES->getTasksAsCSV(true, true) );

// // Testing: getServersAsCSV()
// $ECHOES->generateRandomServers( 50 );
// var_dump( $ECHOES->getServersAsCSV() );
// var_dump( $ECHOES->getServersAsCSV(true) );
// var_dump( $ECHOES->getServersAsCSV(false, true) );
// var_dump( $ECHOES->getServersAsCSV(true, true) );

// // Testing: getServersAsCSV() with active tasks
// $ECHOES->generateRandomServers( 50 );
// $ECHOES->generateRandomTasks( 100 );
// $ECHOES->setAssignMethod( "Knapsack" );
// $ECHOES->assignAllTasks();
// var_dump( $ECHOES->getServersAsCSV() );
// var_dump( $ECHOES->getServersAsCSV(true) );
// var_dump( $ECHOES->getServersAsCSV(false, true) );
// var_dump( $ECHOES->getServersAsCSV(true, true) );

// // Testing: exportTasksAsJSON()
// $ECHOES->generateRandomTasks( 50 );
// var_dump( $ECHOES->exportTasksAsJSON("Tasks.json") );
// var_dump( $ECHOES->exportTasksAsJSON("Tasks.json", true) );
// var_dump( $ECHOES->exportTasksAsJSON("Tasks.json",false,true) );
// var_dump( $ECHOES->exportTasksAsJSON("Tasks.json",true,true) );

// // Testing: exportServersAsJSON()
// $ECHOES->generateRandomServers( 50 );
// var_dump($ECHOES->exportServersAsJSON("Servers.json") );
// var_dump($ECHOES->exportServersAsJSON("Servers.json",true) );
// var_dump($ECHOES->exportServersAsJSON("Servers.json",false, true) );
// var_dump($ECHOES->exportServersAsJSON("Servers.json",true, true) );

// // Testing: exportTasksAsCSV()
// $ECHOES->generateRandomTasks( 50 );
// var_dump( $ECHOES->exportTasksAsCSV("Tasks.csv") );
// var_dump( $ECHOES->exportTasksAsCSV("Tasks.csv", true) );
// var_dump( $ECHOES->exportTasksAsCSV("Tasks.csv", false, true) );
// var_dump( $ECHOES->exportTasksAsCSV("Tasks.csv", true, true) );

// // Testing: exportServersAsCSV()
// $ECHOES->generateRandomServers( 50 );
// var_dump( $ECHOES->exportServersAsCSV("Servers.csv") );
// var_dump( $ECHOES->exportServersAsCSV("Servers.csv", true) );
// var_dump( $ECHOES->exportServersAsCSV("Servers.csv", false, true) );
// var_dump( $ECHOES->exportServersAsCSV("Servers.csv", true, true) );

// // Testing: exportServersAsCSV() with active tasks
// $ECHOES->generateRandomServers( 50 );
// $ECHOES->generateRandomTasks( 100 );
// $ECHOES->setAssignMethod( "Knapsack" );
// $ECHOES->assignAllTasks();
// var_dump( $ECHOES->exportServersAsCSV("Servers.csv") );
// var_dump( $ECHOES->exportServersAsCSV("Servers.csv", true) );
// var_dump( $ECHOES->exportServersAsCSV("Servers.csv", false, true) );
// var_dump( $ECHOES->exportServersAsCSV("Servers.csv", true, true) );

// // Testing: loadTasksFromJSON()
// // $ECHOES->generateRandomTasks( 50 );
// // var_dump( $ECHOES->exportTasksAsJSON("Tasks.json") );
// // var_dump( $ECHOES->getTasks() );
// var_dump( $ECHOES->loadTasksFromJSON( file_get_contents("Tasks.json") ) );
// // var_dump( $ECHOES->getTasks() );

// Testing: loadServersFromJSON()
// $ECHOES->generateRandomServers( 50 );
// $S1 = $ECHOES->createServer(
//         "S1",
//         "Server",
//         8,
//         16000,
//         32768,
//         28672,
//         1048576,
//         786432,
//         10,
//         10,
//         12,
//         1000,
//         1.5,
//         98,
//         True
//     );
// var_dump( $ECHOES->exportServersAsJSON("Servers.json") );
// var_dump($ECHOES->exportServersAsJSON("Servers.json",true) );
// var_dump($ECHOES->exportServersAsJSON("Servers.json",false, true) );
// var_dump($ECHOES->exportServersAsJSON("Servers.json",true, true) );
var_dump( $ECHOES->getAllServers() );
//  ------------- string $jsonServers, $issetServerID = false, $issetParameterNames = false, $applyServerID = false -------------
// var_dump( $ECHOES->loadServersFromJSON( file_get_contents("Servers.json"), true, false ) );
// var_dump( $ECHOES->loadServersFromJSON( file_get_contents("Servers.json"), true, false, true ) );
// var_dump( $ECHOES->loadServersFromJSON( file_get_contents("Servers.json"), false, true ) );
var_dump( $ECHOES->loadServersFromJSON( file_get_contents("Servers.json"), false, true, true ) );
// var_dump( $ECHOES->loadServersFromJSON( file_get_contents("Servers.json"), true, true ) );
// var_dump( $ECHOES->loadServersFromJSON( file_get_contents("Servers.json"), true, true, true ) );
var_dump( $ECHOES->getAllServers() );

// $ECHOES->generateRandomServers( 20 );
// $ECHOES->generateRandomTasks( 200 );
// $ECHOES->setAssignMethod( "Knapsack" );
// $ECHOES->startSimulation( 200 );

// TODO:
// clearSimulator()
// loadServersFromJSON()
// loadTasksFromCSV()
// loadServersFromCSV()


?>