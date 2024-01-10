<?php


require_once "Server.php";
require_once "Cloud.php";
require_once "Edge.php";
require_once "Task.php";
require_once "Knapsack.php";

// Constants for TASK
defined("MAX_TASK_REQUIRED_CORE") or define("MAX_TASK_REQUIRED_CORE", 8);
defined("MIN_TASK_REQUIRED_CORE") or define("MIN_TASK_REQUIRED_CORE", 1);
defined("MAX_TASK_REQUIRED_MIPS") or define("MAX_TASK_REQUIRED_MIPS", 800);
defined("MIN_TASK_REQUIRED_MIPS") or define("MIN_TASK_REQUIRED_MIPS", 200);
defined("MAX_TASK_REQUIRED_RAM") or define("MAX_TASK_REQUIRED_RAM", 1024);
defined("MIN_TASK_REQUIRED_RAM") or define("MIN_TASK_REQUIRED_RAM", 128);
defined("MAX_TASK_REQUIRED_STORAGE") or define("MAX_TASK_REQUIRED_STORAGE", 2048);
defined("MIN_TASK_REQUIRED_STORAGE") or define("MIN_TASK_REQUIRED_STORAGE", 256);
defined("MAX_TASK_REQUIRED_DOWNLOAD") or define("MAX_TASK_REQUIRED_DOWNLOAD", 512);
defined("MIN_TASK_REQUIRED_DOWNLOAD") or define("MIN_TASK_REQUIRED_DOWNLOAD", 128);
defined("MAX_TASK_REQUIRED_UPLOAD") or define("MAX_TASK_REQUIRED_UPLOAD", 256);
defined("MIN_TASK_REQUIRED_UPLOAD") or define("MIN_TASK_REQUIRED_UPLOAD", 64);
defined("MAX_TASK_DEADLINE") or define("MAX_TASK_DEADLINE", 86400); // 1 hour
defined("MIN_TASK_DEADLINE") or define("MIN_TASK_DEADLINE", 3600); // 24 hours
// defined("MAX_TASK_ESTIMATE_EXECUTION_TIME_1") or define("MAX_TASK_ESTIMATE_EXECUTION_TIME_1", 18000);
// defined("MAX_TASK_ESTIMATE_EXECUTION_TIME_2") or define("MAX_TASK_ESTIMATE_EXECUTION_TIME_2", 86400);
defined("MAX_TASK_ESTIMATE_EXECUTION_TIME_1") or define("MAX_TASK_ESTIMATE_EXECUTION_TIME_1", 120);
defined("MAX_TASK_ESTIMATE_EXECUTION_TIME_2") or define("MAX_TASK_ESTIMATE_EXECUTION_TIME_2", 18000);
defined("MIN_TASK_ESTIMATE_EXECUTION_TIME") or define("MIN_TASK_ESTIMATE_EXECUTION_TIME", 5);

// Constants for SERVER
defined("MAX_SERVER_CORES") or define("MAX_SERVER_CORES", 32);
defined("MIN_SERVER_CORES") or define("MIN_SERVER_CORES", 4);
defined("MAX_SERVER_MIPS") or define("MAX_SERVER_MIPS", 32000);
defined("MIN_SERVER_MIPS") or define("MIN_SERVER_MIPS", 8000);
defined("MAX_SERVER_RAM") or define("MAX_SERVER_RAM", 131072); // 128GB
defined("MIN_SERVER_RAM") or define("MIN_SERVER_RAM", 8194); // 8GB
defined("MAX_SERVER_RAM_NOT_AVAILABLE_RANGE") or define("MAX_SERVER_RAM_NOT_AVAILABLE_RANGE", 4096);
defined("MIN_SERVER_RAM_NOT_AVAILABLE_RANGE") or define("MIN_SERVER_RAM_NOT_AVAILABLE_RANGE", 1024);
defined("MAX_SERVER_STORAGE") or define("MAX_SERVER_STORAGE", 4194304); // 4TB
defined("MIN_SERVER_STORAGE") or define("MIN_SERVER_STORAGE", 524288); // 512GB
defined("MAX_SERVER_STORAGE_NOT_AVAILABLE_RANGE") or define("MAX_SERVER_STORAGE_NOT_AVAILABLE_RANGE", 524288);
defined("MIN_SERVER_STORAGE_NOT_AVAILABLE_RANGE") or define("MIN_SERVER_STORAGE_NOT_AVAILABLE_RANGE", 131072);
defined("MAX_SERVER_STORAGE_SPEED") or define("MAX_SERVER_STORAGE_SPEED", 160);
defined("MIN_SERVER_STORAGE_SPEED") or define("MIN_SERVER_STORAGE_SPEED", 60);
defined("MAX_SERVER_AVERAGE_ACCESS_TIME_EDGE") or define("MAX_SERVER_AVERAGE_ACCESS_TIME_EDGE", 30);
defined("MIN_SERVER_AVERAGE_ACCESS_TIME_EDGE") or define("MIN_SERVER_AVERAGE_ACCESS_TIME_EDGE", 5);
defined("MAX_SERVER_AVERAGE_ACCESS_TIME_CLOUD") or define("MAX_SERVER_AVERAGE_ACCESS_TIME_CLOUD", 1500);
defined("MIN_SERVER_AVERAGE_ACCESS_TIME_CLOUD") or define("MIN_SERVER_AVERAGE_ACCESS_TIME_CLOUD", 200);
defined("MAX_SERVER_BANDWIDTH") or define("MAX_SERVER_BANDWIDTH", 2000);
defined("MIN_SERVER_BANDWIDTH") or define("MIN_SERVER_BANDWIDTH", 500);
defined("MAX_SERVER_TEMPERATURE") or define("MAX_SERVER_TEMPERATURE", 30);
defined("MIN_SERVER_TEMPERATURE") or define("MIN_SERVER_TEMPERATURE", 20);

// Constants for calculateExecutionTime()
defined("MAX_CT_FACTOR_1") or define("MAX_CT_FACTOR_1", MAX_SERVER_CORES/MIN_TASK_REQUIRED_CORE);
defined("MIN_CT_FACTOR_1") or define("MIN_CT_FACTOR_1", ((MIN_SERVER_CORES/MAX_TASK_REQUIRED_CORE)<1)?1:(MIN_SERVER_CORES/MAX_TASK_REQUIRED_CORE));
defined("MAX_CT_FACTOR_2") or define("MAX_CT_FACTOR_2", MAX_SERVER_MIPS/MIN_TASK_REQUIRED_MIPS);
defined("MIN_CT_FACTOR_2") or define("MIN_CT_FACTOR_2", ((MIN_SERVER_MIPS/MAX_TASK_REQUIRED_MIPS)<1)?1:(MIN_SERVER_MIPS/MAX_TASK_REQUIRED_MIPS));
defined("MAX_CT_FACTOR_3") or define("MAX_CT_FACTOR_3", (MAX_SERVER_RAM-MIN_SERVER_RAM_NOT_AVAILABLE_RANGE)/MIN_TASK_REQUIRED_RAM);
defined("MIN_CT_FACTOR_3") or define("MIN_CT_FACTOR_3", ((MIN_SERVER_RAM-MAX_SERVER_RAM_NOT_AVAILABLE_RANGE)/MAX_TASK_REQUIRED_RAM));
defined("MAX_CT_FACTOR_4") or define("MAX_CT_FACTOR_4", (MAX_SERVER_STORAGE-MIN_SERVER_STORAGE_NOT_AVAILABLE_RANGE)/MIN_TASK_REQUIRED_STORAGE);
defined("MIN_CT_FACTOR_4") or define("MIN_CT_FACTOR_4", ((MIN_SERVER_STORAGE-MAX_SERVER_STORAGE_NOT_AVAILABLE_RANGE)/MAX_TASK_REQUIRED_STORAGE));
defined("MAX_CT_FACTOR_5") or define("MAX_CT_FACTOR_5", (MAX_TASK_REQUIRED_DOWNLOAD+MAX_TASK_REQUIRED_UPLOAD)/MIN_SERVER_BANDWIDTH);
defined("MIN_CT_FACTOR_5") or define("MIN_CT_FACTOR_5", ((MIN_TASK_REQUIRED_DOWNLOAD+MIN_TASK_REQUIRED_UPLOAD)/MAX_SERVER_BANDWIDTH));
defined("MAX_CT_FACTOR_6") or define("MAX_CT_FACTOR_6", MAX_SERVER_STORAGE_SPEED);
defined("MIN_CT_FACTOR_6") or define("MIN_CT_FACTOR_6", MIN_SERVER_STORAGE_SPEED);
defined("MAX_CT_FACTOR_7") or define("MAX_CT_FACTOR_7", MAX_SERVER_RAM/MIN_TASK_REQUIRED_RAM);
defined("MIN_CT_FACTOR_7") or define("MIN_CT_FACTOR_7", 0);
defined("MAX_CT_FACTOR_8") or define("MAX_CT_FACTOR_8", max([ MAX_SERVER_AVERAGE_ACCESS_TIME_EDGE, MAX_SERVER_AVERAGE_ACCESS_TIME_CLOUD ]));
defined("MIN_CT_FACTOR_8") or define("MIN_CT_FACTOR_8", 0);

// Constants for Dimensionality-Reduction
defined("MAX_AVAILABLE_RAM") or define("MAX_AVAILABLE_RAM", MAX_SERVER_RAM-MIN_SERVER_RAM_NOT_AVAILABLE_RANGE );
defined("MIN_AVAILABLE_RAM") or define("MIN_AVAILABLE_RAM", MIN_SERVER_RAM-MAX_SERVER_RAM_NOT_AVAILABLE_RANGE );
defined("MAX_AVAILABLE_STORAGE") or define("MAX_AVAILABLE_STORAGE", MAX_SERVER_STORAGE-MIN_SERVER_STORAGE_NOT_AVAILABLE_RANGE );
defined("MIN_AVAILABLE_STORAGE") or define("MIN_AVAILABLE_STORAGE", MIN_SERVER_STORAGE-MAX_SERVER_STORAGE_NOT_AVAILABLE_RANGE );
defined("MAX_ACTIVE_TASKS") or define("MAX_ACTIVE_TASKS", MAX_SERVER_RAM/MIN_TASK_REQUIRED_RAM );
defined("MIN_ACTIVE_TASKS") or define("MIN_ACTIVE_TASKS",0 );
defined("MAX_ACTIVE_LATENCY") or define("MAX_ACTIVE_LATENCY", max([ MAX_SERVER_AVERAGE_ACCESS_TIME_EDGE, MAX_SERVER_AVERAGE_ACCESS_TIME_CLOUD ]) );
defined("MIN_ACTIVE_LATENCY") or define("MIN_ACTIVE_LATENCY", 0 );

class Simulator
{

    // List of simulator's entities
    private $allServers;
    private $servers;
    private $cloudServers;
    private $edgeServers;
    private $tasks;
    private $runningTasks;

    private $totalTerminatedTasks;

    private $assignMethods;
    private $assignMethod;

    private $knapsack;

    // Constructor
    public function __construct( $assignMethod = "Default" ) {

        $this->allServers       = [];
        $this->servers          = [];
        $this->cloudServers     = [];
        $this->edgeServers      = [];
        $this->tasks            = [];
        $this->runningTasks     = [];

        $this->totalTerminatedTasks = 0;


        $this->assignMethods = [
            "Default",
            "Random",
            "Knapsack",
            "EdgeFirst",
            "CloudFirst",
            "ServerFirst",
            "EdgeCloudServer",
            "EdgeServerCloud",
            "CloudEdgeServer",
            "CloudServerEdge",
            "ServerEdgeCloud",
            "ServerCloudEdge"
        ];
        $this->setAssignMethod( $assignMethod );
        
        $this->knapsack = new Knapsack;
    }

    // Get all kind of servers in current simulation
    public function getAllServers()
    {
        return $this->allServers;
    }

    // Get simulator servers at the moment
    public function getServers()
    {
        return $this->servers;
    }

    // Get simulator cloud-servers at the moment
    public function getCloudServers()
    {
        return $this->cloudServers;
    }

    // Get simulator edge-servers at the moment
    public function getEdgeServers()
    {
        return $this->edgeServers;
    }

    // Get simulator waiting-tasks at the moment
    public function getTasks()
    {
        return $this->tasks;
    }

    // Get a waiting-tasks by ID
    public function getTask( int $taskID )
    {
        if( isset($this->tasks[ $taskID ]) )
            return $this->tasks[ $taskID ];
        return false;
    }

    // Get simulator running-tasks at the moment
    public function getRunningTasks()
    {
        return $this->runningTasks;
    }

    // Get a running-tasks by ID
    public function getRunningTask(  int $taskID )
    {
        if( isset($this->runningTasks[ $taskID ]) )
            return $this->runningTasks[ $taskID ];
        return false;
    }

    // Add a running-task
    public function addRunningTask( Task $task, int $taskID )
    {
        $this->runningTasks[ $taskID ] = $task;
        return true;
    }

    // Delete a running-task
    public function deleteRunningTask( int $taskID )
    {
        unset($this->runningTasks[ $taskID ]);
        return true;
    }

    // Increment the number of terminated tasks
    public function incrementTotalTerminatedTasks()
    {
        $this->totalTerminatedTasks++;
    }

    // Get the number of terminated tasks
    public function getTotalTerminatedTasks()
    {
        return $this->totalTerminatedTasks;
    }

    // Creates a new task and returns its ID
    public function createTask(
        $Name,
        $Priority,
        $RequiredCores,
        $RequiredMIPSPerCore,
        $RequiredRAM,
        $RequiredStorage,
        $Timestamp,
        $TimestampMS,
        $RequiredDataDownload,
        $RequiredDataUpload,
        $Deadline,
        $SecurityLevel,
        $CommunicationType,
        $ExecutionTime,
        $EstimateExecutionTime
    )
    {
        $this->tasks[] = new Task(
            $Name,
            $Priority,
            $RequiredCores,
            $RequiredMIPSPerCore,
            $RequiredRAM,
            $RequiredStorage,
            $Timestamp,
            $TimestampMS,
            $RequiredDataDownload,
            $RequiredDataUpload,
            $Deadline,
            $SecurityLevel,
            $CommunicationType,
            $ExecutionTime,
            $EstimateExecutionTime
        );
        end($this->tasks);
        return key($this->tasks); 
    }

    // Delete a Task
    public function deleteTask( $ID )
    {
        unset($this->tasks[ $ID ]);
        return true;
    }

    // Create a new server and returns its ID
    public function createServer(
        $Name,
        $Type,
        $Cores,
        $MIPS,
        $RAM,
        $AvailableRAM,
        $Storage,
        $AvailableStorage,
        $StorageSpeed,
        $AverageAccessTime,
        $Latency,
        $NetworkBandwidth,
        $EnergyEfficiency,
        $RedundancyLevel,
        $Availability
    )
    {
        $this->servers[] = new Server(
            $Name,
            $Type,
            $Cores,
            $MIPS,
            $RAM,
            $AvailableRAM,
            $Storage,
            $AvailableStorage,
            $StorageSpeed,
            $AverageAccessTime,
            $Latency,
            $NetworkBandwidth,
            $EnergyEfficiency,
            $RedundancyLevel,
            $Availability
        );
        end($this->servers);
        $ID = key($this->servers);
        $this->allServers[] = [
            "Type"      => "Server",
            "ID"        => $ID,
            "Object"    => $this->servers[ $ID ]
        ];
        return $ID; 
    }

    // Delete a Server
    public function deleteServer( $ID )
    {
        unset($this->servers[ $ID ]);
        foreach ($this->allServers as $key => $server) {
            if ( $server["Type"] === "Server" && $server["ID"] === $ID ) {
                unset($this->allServers[ $key ]);
            }
        }
        return true;
    }

    // Create a new edge-server and returns its ID
    public function createEdgeServer(
        $Name,
        $Cores,
        $MIPS,
        $RAM,
        $AvailableRAM,
        $Storage,
        $AvailableStorage,
        $StorageSpeed,
        $AverageAccessTime,
        $Latency,
        $NetworkBandwidth,
        $EnergyEfficiency,
        $RedundancyLevel,
        $Availability,
        $Location,
        $Temperature
    )
    {
        $this->edgeServers[] = new Edge(
            $Name,
            $Cores,
            $MIPS,
            $RAM,
            $AvailableRAM,
            $Storage,
            $AvailableStorage,
            $StorageSpeed,
            $AverageAccessTime,
            $Latency,
            $NetworkBandwidth,
            $EnergyEfficiency,
            $RedundancyLevel,
            $Availability,
            $Location,
            $Temperature
        );
        end($this->edgeServers);
        $ID = key($this->edgeServers);
        $this->allServers[] = [
            "Type"      => "Edge",
            "ID"        => $ID,
            "Object"    => $this->edgeServers[ $ID ]
        ];
        return $ID; 
    }

    // Delete an Edge-Server
    public function deleteEdgeServer( $ID )
    {
        unset($this->edgeServers[ $ID ]);
        foreach ($this->allServers as $key => $server) {
            if ( $server["Type"] === "Edge" && $server["ID"] === $ID ) {
                unset($this->allServers[ $key ]);
            }
        }
        return true;
    }

    // Create a new cloud-server and returns its ID
    public function createCloudServer(
        $Name,
        $Cores,
        $MIPS,
        $RAM,
        $AvailableRAM,
        $Storage,
        $AvailableStorage,
        $StorageSpeed,
        $AverageAccessTime,
        $Latency,
        $NetworkBandwidth,
        $EnergyEfficiency,
        $RedundancyLevel,
        $Availability,
        $Location,
        $Temperature
    )
    {
        $this->cloudServers[] = new Cloud(
            $Name,
            $Cores,
            $MIPS,
            $RAM,
            $AvailableRAM,
            $Storage,
            $AvailableStorage,
            $StorageSpeed,
            $AverageAccessTime,
            $Latency,
            $NetworkBandwidth,
            $EnergyEfficiency,
            $RedundancyLevel,
            $Availability,
            $Location,
            $Temperature
        );
        end($this->cloudServers);
        $ID = key($this->cloudServers);
        $this->allServers[] = [
            "Type"      => "Cloud",
            "ID"        => $ID,
            "Object"    => $this->cloudServers[ $ID ]
        ];
        return $ID; 
    }

    // Delete a Cloud-Server
    public function deleteCloudServer( $ID )
    {
        unset( $this->cloudServers[ $ID ] );
        foreach ($this->allServers as $key => $server) {
            if ( $server["Type"] === "Cloud" && $server["ID"] === $ID ) {
                unset($this->allServers[ $key ]);
            }
        }
        return true;
    }

    // Get details of a Waiting-Task
    public function getTaskDetails( $task )
    {
        if ( $task instanceof Task )
            return [
                "Name"                  => $task->getName() ,
                "Priority"              => $task->getPriority() ,
                "RequiredCores"         => $task->getRequiredCores() ,
                "RequiredMIPSPerCore"   => $task->getRequiredMIPSPerCore() ,
                "RequiredRAM"           => $task->getRequiredRAM() ,
                "RequiredStorage"       => $task->getRequiredStorage() ,
                "Timestamp"             => $task->getTimestamp() ,
                "TimestampMS"           => $task->getTimestampMS() ,
                "RequiredDataDownload"  => $task->getRequiredDataDownload() ,
                "RequiredDataUpload"    => $task->getRequiredDataUpload() ,
                "Deadline"              => $task->getDeadline() ,
                "SecurityLevel"         => $task->getSecurityLevel() ,
                "CommunicationType"     => $task->getCommunicationType(),
                "ExecutionTime"         => $task->getExecutionTime(),
                "EstimateExecutionTime" => $task->getEstimateExecutionTime()
            ];
        return [
            "Name"                  => $this->tasks[ $task ]->getName() ,
            "Priority"              => $this->tasks[ $task ]->getPriority() ,
            "RequiredCores"         => $this->tasks[ $task ]->getRequiredCores() ,
            "RequiredMIPSPerCore"   => $this->tasks[ $task ]->getRequiredMIPSPerCore() ,
            "RequiredRAM"           => $this->tasks[ $task ]->getRequiredRAM() ,
            "RequiredStorage"       => $this->tasks[ $task ]->getRequiredStorage() ,
            "Timestamp"             => $this->tasks[ $task ]->getTimestamp() ,
            "TimestampMS"           => $this->tasks[ $task ]->getTimestampMS() ,
            "RequiredDataDownload"  => $this->tasks[ $task ]->getRequiredDataDownload() ,
            "RequiredDataUpload"    => $this->tasks[ $task ]->getRequiredDataUpload() ,
            "Deadline"              => $this->tasks[ $task ]->getDeadline() ,
            "SecurityLevel"         => $this->tasks[ $task ]->getSecurityLevel() ,
            "CommunicationType"     => $this->tasks[ $task ]->getCommunicationType(),
            "ExecutionTime"         => $this->tasks[ $task ]->getExecutionTime(),
            "EstimateExecutionTime" => $this->tasks[ $task ]->getEstimateExecutionTime()
        ];
    }

    // Get details of a Running-Task
    public function getRunningTaskDetails( $task )
    {
        if ( $task instanceof Task )
            return [
                "Name"                  => $task->getName() ,
                "Priority"              => $task->getPriority() ,
                "RequiredCores"         => $task->getRequiredCores() ,
                "RequiredMIPSPerCore"   => $task->getRequiredMIPSPerCore() ,
                "RequiredRAM"           => $task->getRequiredRAM() ,
                "RequiredStorage"       => $task->getRequiredStorage() ,
                "Timestamp"             => $task->getTimestamp() ,
                "TimestampMS"           => $task->getTimestampMS() ,
                "RequiredDataDownload"  => $task->getRequiredDataDownload() ,
                "RequiredDataUpload"    => $task->getRequiredDataUpload() ,
                "Deadline"              => $task->getDeadline() ,
                "SecurityLevel"         => $task->getSecurityLevel() ,
                "CommunicationType"     => $task->getCommunicationType(),
                "ExecutionTime"         => $task->getExecutionTime(),
                "EstimateExecutionTime" => $task->getEstimateExecutionTime()
            ];
        return [
            "Name"                  => $this->runningTasks[ $task ]->getName() ,
            "Priority"              => $this->runningTasks[ $task ]->getPriority() ,
            "RequiredCores"         => $this->runningTasks[ $task ]->getRequiredCores() ,
            "RequiredMIPSPerCore"   => $this->runningTasks[ $task ]->getRequiredMIPSPerCore() ,
            "RequiredRAM"           => $this->runningTasks[ $task ]->getRequiredRAM() ,
            "RequiredStorage"       => $this->runningTasks[ $task ]->getRequiredStorage() ,
            "Timestamp"             => $this->runningTasks[ $task ]->getTimestamp() ,
            "TimestampMS"           => $this->runningTasks[ $task ]->getTimestampMS() ,
            "RequiredDataDownload"  => $this->runningTasks[ $task ]->getRequiredDataDownload() ,
            "RequiredDataUpload"    => $this->runningTasks[ $task ]->getRequiredDataUpload() ,
            "Deadline"              => $this->runningTasks[ $task ]->getDeadline() ,
            "SecurityLevel"         => $this->runningTasks[ $task ]->getSecurityLevel() ,
            "CommunicationType"     => $this->runningTasks[ $task ]->getCommunicationType(),
            "ExecutionTime"         => $this->runningTasks[ $task ]->getExecutionTime(),
            "EstimateExecutionTime" => $this->runningTasks[ $task ]->getEstimateExecutionTime()
        ];
    }

    // Get Edge-server status
    public function getEdgeServerStatus( $server )
    {
        if ( $server instanceof Edge )
            return [
                "Name"              => $server->getName(),
                "Type"              => $server->getType(),
                "Cores"             => $server->getCores(),
                "MIPS"              => $server->getMIPS(),
                "RAM"               => $server->getRAM(),
                "AvailableRAM"      => $server->getAvailableRAM(),
                "Storage"           => $server->getStorage(),
                "AvailableStorage"  => $server->getAvailableStorage(),
                "StorageSpeed"      => $server->getStorageSpeed(),
                "AverageAccessTime" => $server->getAverageAccessTime(),
                "Latency"           => $server->getLatency(),
                "NetworkBandwidth"  => $server->getNetworkBandwidth(),
                "EnergyEfficiency"  => $server->getEnergyEfficiency(),
                "RedundancyLevel"   => $server->getRedundancyLevel(),
                "Availability"      => $server->getAvailability(),
                "ActiveTasks"       => $server->getActiveTasks(),
                "Location"          => $server->getLocation(),
                "Temperature"       => $server->getTemperature()
            ];
        return [
            "Name"              => $this->edgeServers[ $server ]->getName(),
            "Type"              => $this->edgeServers[ $server ]->getType(),
            "Cores"             => $this->edgeServers[ $server ]->getCores(),
            "MIPS"              => $this->edgeServers[ $server ]->getMIPS(),
            "RAM"               => $this->edgeServers[ $server ]->getRAM(),
            "AvailableRAM"      => $this->edgeServers[ $server ]->getAvailableRAM(),
            "Storage"           => $this->edgeServers[ $server ]->getStorage(),
            "AvailableStorage"  => $this->edgeServers[ $server ]->getAvailableStorage(),
            "StorageSpeed"      => $this->edgeServers[ $server ]->getStorageSpeed(),
            "AverageAccessTime" => $this->edgeServers[ $server ]->getAverageAccessTime(),
            "Latency"           => $this->edgeServers[ $server ]->getLatency(),
            "NetworkBandwidth"  => $this->edgeServers[ $server ]->getNetworkBandwidth(),
            "EnergyEfficiency"  => $this->edgeServers[ $server ]->getEnergyEfficiency(),
            "RedundancyLevel"   => $this->edgeServers[ $server ]->getRedundancyLevel(),
            "Availability"      => $this->edgeServers[ $server ]->getAvailability(),
            "ActiveTasks"       => $this->edgeServers[ $server ]->getActiveTasks(),
            "Location"          => $this->edgeServers[ $server ]->getLocation(),
            "Temperature"       => $this->edgeServers[ $server ]->getTemperature()
        ];
    }

    // Get Cloud-server status
    public function getCloudServerStatus( $server )
    {
        if ( $server instanceof Cloud )
            return [
                "Name"              => $server->getName(),
                "Type"              => $server->getType(),
                "Cores"             => $server->getCores(),
                "MIPS"              => $server->getMIPS(),
                "RAM"               => $server->getRAM(),
                "AvailableRAM"      => $server->getAvailableRAM(),
                "Storage"           => $server->getStorage(),
                "AvailableStorage"  => $server->getAvailableStorage(),
                "StorageSpeed"      => $server->getStorageSpeed(),
                "AverageAccessTime" => $server->getAverageAccessTime(),
                "Latency"           => $server->getLatency(),
                "NetworkBandwidth"  => $server->getNetworkBandwidth(),
                "EnergyEfficiency"  => $server->getEnergyEfficiency(),
                "RedundancyLevel"   => $server->getRedundancyLevel(),
                "Availability"      => $server->getAvailability(),
                "ActiveTasks"       => $server->getActiveTasks(),
                "Location"          => $server->getLocation(),
                "Temperature"       => $server->getTemperature()
            ];
        return [
            "Name"              => $this->cloudServers[ $server ]->getName(),
            "Type"              => $this->cloudServers[ $server ]->getType(),
            "Cores"             => $this->cloudServers[ $server ]->getCores(),
            "MIPS"              => $this->cloudServers[ $server ]->getMIPS(),
            "RAM"               => $this->cloudServers[ $server ]->getRAM(),
            "AvailableRAM"      => $this->cloudServers[ $server ]->getAvailableRAM(),
            "Storage"           => $this->cloudServers[ $server ]->getStorage(),
            "AvailableStorage"  => $this->cloudServers[ $server ]->getAvailableStorage(),
            "StorageSpeed"      => $this->cloudServers[ $server ]->getStorageSpeed(),
            "AverageAccessTime" => $this->cloudServers[ $server ]->getAverageAccessTime(),
            "Latency"           => $this->cloudServers[ $server ]->getLatency(),
            "NetworkBandwidth"  => $this->cloudServers[ $server ]->getNetworkBandwidth(),
            "EnergyEfficiency"  => $this->cloudServers[ $server ]->getEnergyEfficiency(),
            "RedundancyLevel"   => $this->cloudServers[ $server ]->getRedundancyLevel(),
            "Availability"      => $this->cloudServers[ $server ]->getAvailability(),
            "ActiveTasks"       => $this->cloudServers[ $server ]->getActiveTasks(),
            "Location"          => $this->cloudServers[ $server ]->getLocation(),
            "Temperature"       => $this->cloudServers[ $server ]->getTemperature()
        ];
    }

    // Get Normal-server status
    public function getNormalServerStatus( $server )
    {
        if ( $server instanceof Server )
            return [
                "Name"              => $server->getName(),
                "Type"              => $server->getType(),
                "Cores"             => $server->getCores(),
                "MIPS"              => $server->getMIPS(),
                "RAM"               => $server->getRAM(),
                "AvailableRAM"      => $server->getAvailableRAM(),
                "Storage"           => $server->getStorage(),
                "AvailableStorage"  => $server->getAvailableStorage(),
                "StorageSpeed"      => $server->getStorageSpeed(),
                "AverageAccessTime" => $server->getAverageAccessTime(),
                "Latency"           => $server->getLatency(),
                "NetworkBandwidth"  => $server->getNetworkBandwidth(),
                "EnergyEfficiency"  => $server->getEnergyEfficiency(),
                "RedundancyLevel"   => $server->getRedundancyLevel(),
                "Availability"      => $server->getAvailability(),
                "ActiveTasks"       => $server->getActiveTasks()
            ];
        return [
            "Name"              => $this->servers[ $server ]->getName(),
            "Type"              => $this->servers[ $server ]->getType(),
            "Cores"             => $this->servers[ $server ]->getCores(),
            "MIPS"              => $this->servers[ $server ]->getMIPS(),
            "RAM"               => $this->servers[ $server ]->getRAM(),
            "AvailableRAM"      => $this->servers[ $server ]->getAvailableRAM(),
            "Storage"           => $this->servers[ $server ]->getStorage(),
            "AvailableStorage"  => $this->servers[ $server ]->getAvailableStorage(),
            "StorageSpeed"      => $this->servers[ $server ]->getStorageSpeed(),
            "AverageAccessTime" => $this->servers[ $server ]->getAverageAccessTime(),
            "Latency"           => $this->servers[ $server ]->getLatency(),
            "NetworkBandwidth"  => $this->servers[ $server ]->getNetworkBandwidth(),
            "EnergyEfficiency"  => $this->servers[ $server ]->getEnergyEfficiency(),
            "RedundancyLevel"   => $this->servers[ $server ]->getRedundancyLevel(),
            "Availability"      => $this->servers[ $server ]->getAvailability(),
            "ActiveTasks"       => $this->servers[ $server ]->getActiveTasks()
        ];
    }

    // Get Any Server status
    public function getServerStatus( $server )
    {
        if ( $server instanceof Server )
            return $this->getNormalServerStatus($server);
        else if ( $server instanceof Cloud )
            return $this->getCloudServerStatus($server);
        else if ( $server instanceof Edge )
            return $this->getEdgeServerStatus($server);
        else{
            throw new Exception("getServerStatus()only works with Object, not IDs.", 1);
            return false;
        }
    }

    // Export tasks as JSON file
    public function exportTasksAsJSON( string $fileName, $getTaskID = false, $getParameterNames = false )
    {
        if ( file_exists($fileName) ) {
            throw new Exception("File \"" . $fileName . "\" already exists.", 1);
            return false;
        }
        if(file_put_contents( $fileName, $this->getTasksAsJSON( $getTaskID, $getParameterNames ) ) < 1)
            throw new Exception("Could not write to the file \"" . $fileName . "\".", 1);
        return true;
    }

    // Export servers as JSON file
    public function exportServersAsJSON( string $fileName, $getServerID = false, $getParameterNames = false  )
    {
        if ( file_exists($fileName) ) {
            throw new Exception("File \"" . $fileName . "\" already exists.", 1);
            return false;
        }
        if(file_put_contents( $fileName, $this->getServersAsJSON( $getServerID, $getParameterNames ) ) < 1)
            throw new Exception("Could not write to the file \"" . $fileName . "\".", 1);
        return true;
    }

    // Export tasks as CSV file
    public function exportTasksAsCSV( string $fileName, $getTaskID = false, $getParameterNames = false )
    {
        if ( file_exists($fileName) ) {
            throw new Exception("File \"" . $fileName . "\" already exists.", 1);
            return false;
        }
        if(file_put_contents( $fileName, $this->getTasksAsCSV( $getTaskID, $getParameterNames ) ) < 1)
            throw new Exception("Could not write to the file \"" . $fileName . "\".", 1);
        return true;
    }

    // Export servers as CSV file
    public function exportServersAsCSV( string $fileName, $getServerID = false, $getParameterNames = false )
    {
        if ( file_exists($fileName) ) {
            throw new Exception("File \"" . $fileName . "\" already exists.", 1);
            return false;
        }
        if(file_put_contents( $fileName, $this->getServersAsCSV( $getServerID, $getParameterNames ) ) < 1)
            throw new Exception("Could not write to the file \"" . $fileName . "\".", 1);
        return true;
    }

    // Get tasks as JSON data
    public function getTasksAsJSON( $getTaskID = false, $getParameterNames = false )
    {
        $jsonTasks = [];
        foreach ($this->getTasks() as $taskID => $task) {
            if( $getTaskID )
                $jsonTasks[] = ($getParameterNames)? array_merge(["ID"=>$taskID], $this->getTaskDetails($task)) : array_values(array_merge([$taskID],$this->getTaskDetails($task)));
            else $jsonTasks[] = ($getParameterNames)? $this->getTaskDetails($task) : array_values($this->getTaskDetails($task));
        } 
        return json_encode($jsonTasks);
    }

    // Get servers as JSON data
    public function getServersAsJSON( $getServerID = false, $getParameterNames = false )
    {
        $jsonServers = [];
        foreach ($this->getAllServers() as $server) {
            if( $getServerID )
                $jsonServers[] = ($getParameterNames)? array_merge(["ID"=>$server["ID"]], $this->getServerStatus($server["Object"])) : array_values(array_merge([$server["ID"]],$this->getServerStatus($server["Object"])));
            else $jsonServers[] = ($getParameterNames)? $this->getServerStatus($server["Object"]) : array_values($this->getServerStatus($server["Object"]));
        }
        return json_encode($jsonServers);
    }

    // Get tasks as CSV data
    public function getTasksAsCSV( $getTaskID = false, $getParameterNames = false )
    {
        $tasks = $this->getTasks();
        if( count($tasks) == 0 ) return false;
        $csvTasks = "";
        if($getParameterNames)
        {
            if( $getTaskID )
                $taskArray = array_values( array_merge( ["ID"], array_keys($this->getTaskDetails($tasks[0])) ) );
            else $taskArray = array_keys($this->getTaskDetails($tasks[0]));
            $csvTasks .= $this->csvstr($taskArray) .PHP_EOL;
        }
        foreach ($tasks as $taskID => $task) {
            if( $getTaskID )
                $taskArray = array_values(array_merge([$taskID], $this->getTaskDetails($task)));
            else $taskArray = array_values($this->getTaskDetails($task));
            $csvTasks .= $this->csvstr($taskArray) .PHP_EOL;
        } 
        return trim($csvTasks);
    }

    // Get servers as CSV data
    public function getServersAsCSV( $getServerID = false, $getParameterNames = false )
    {
        $servers = $this->getAllServers();
        if( count($servers) == 0 ) return false;
        $csvServers = "";
        if($getParameterNames)
        {
            if( $getServerID )
                $serverArray = array_values( array_merge( ["ID"], array_keys($this->getServerStatus($servers[0]["Object"])) ) );
            else $serverArray = array_keys($this->getServerStatus($servers[0]["Object"]));
            $csvServers .= $this->csvstr($serverArray) .PHP_EOL;
        }
        foreach ($servers as $server) {
            $serverArray = $this->getServerStatus($server["Object"]);
            $serverArray["ActiveTasks"] = json_encode($serverArray["ActiveTasks"]);
            if( $getServerID )
                $serverArray = array_values(array_merge([ $server["ID"] ], $serverArray ));
            else $serverArray = array_values($serverArray);
            $csvServers .= $this->csvstr($serverArray) .PHP_EOL;
        } 
        return trim($csvServers);
    }

    // Convert a line of array to csv-string : derived from: https://www.php.net/manual/en/function.fputcsv.php
    public function csvstr(array $fields) : string
    {
        $f = fopen('php://memory', 'r+');
        if (fputcsv($f, $fields) === false) {
            return false;
        }
        rewind($f);
        $csv_line = stream_get_contents($f);
        return rtrim($csv_line);
    }

    // Import tasks from JSON file
    public function importTasksFromJSON( string $fileName, $issetTaskID = false, $issetParameterNames = false, $applyTaskID = false )
    {
        if ( !file_exists($fileName) ) {
            throw new Exception("File \"" . $fileName . "\" does not exists.", 1);
            return false;
        }
        $result = file_get_contents( $fileName );
        if( !$result )
            throw new Exception("Could not read to the file \"" . $fileName . "\".", 1);
        $this->loadTasksFromJSON( $result, $issetTaskID, $issetParameterNames, $applyTaskID );
        return true;
    }

    // Import server from JSON file
    public function importServersFromJSON( string $fileName, $issetServerID = false, $issetParameterNames = false, $applyServerID = false )
    {
        if ( !file_exists($fileName) ) {
            throw new Exception("File \"" . $fileName . "\" does not exists.", 1);
            return false;
        }
        $result = file_get_contents( $fileName );
        if( !$result )
            throw new Exception("Could not read to the file \"" . $fileName . "\".", 1);
        $this->loadServersFromJSON( $result, $issetServerID, $issetParameterNames, $applyServerID );
        return true;
    }

    // Import tasks from CSV file
    public function importTasksFromCSV( string $fileName, $issetTaskID = false, $issetParameterNames = false, $applyTaskID = false )
    {
        if ( !file_exists($fileName) ) {
            throw new Exception("File \"" . $fileName . "\" does not exists.", 1);
            return false;
        }
        $result = file_get_contents( $fileName );
        if( !$result )
            throw new Exception("Could not read to the file \"" . $fileName . "\".", 1);
        $this->loadTasksFromCSV( $result, $issetTaskID, $issetParameterNames, $applyTaskID );
        return true;
    }

    // Import server from CSV file
    public function importServersFromCSV( string $fileName, $issetServerID = false, $issetParameterNames = false, $applyServerID = false )
    {
        if ( !file_exists($fileName) ) {
            throw new Exception("File \"" . $fileName . "\" does not exists.", 1);
            return false;
        }
        $result = file_get_contents( $fileName );
        if( !$result )
            throw new Exception("Could not read to the file \"" . $fileName . "\".", 1);
        $this->loadServersFromCSV( $result, $issetServerID, $issetParameterNames, $applyServerID );
        return true;
    }

    // Load tasks from JSON data
    public function loadTasksFromJSON( string $jsonTasks, $issetTaskID = false, $issetParameterNames = false, $applyTaskID = false )
    {
        $tasks = json_decode( $jsonTasks, true );
        if ( $tasks == false || empty( $tasks ) )
        {
            throw new Exception("Could not decode JSON data.", 1);
            return false;
        }
        foreach ($tasks as $key => $task) {
            if ( $issetParameterNames ) {
                if( $issetTaskID )
                {
                    if( $applyTaskID )
                    {
                        if ( array_key_exists( $task["ID"] , $this->tasks ) || array_key_exists( $task["ID"] , $this->runningTasks ) )
                        {
                            throw new Exception("A task with ID \"" . $task["ID"] . "\" already exists.", 1);
                            return false;
                        }
                        $this->tasks[ $task["ID"] ] = new Task(
                            $task["Name"],
                            $task["Priority"],
                            $task["RequiredCores"],
                            $task["RequiredMIPSPerCore"],
                            $task["RequiredRAM"],
                            $task["RequiredStorage"],
                            $task["Timestamp"],
                            $task["TimestampMS"],
                            $task["RequiredDataDownload"],
                            $task["RequiredDataUpload"],
                            $task["Deadline"],
                            $task["SecurityLevel"],
                            $task["CommunicationType"],
                            $task["ExecutionTime"],
                            $task["EstimateExecutionTime"]
                        );
                    }
                    else
                    {
                        $this->createTask(
                            $task["Name"],
                            $task["Priority"],
                            $task["RequiredCores"],
                            $task["RequiredMIPSPerCore"],
                            $task["RequiredRAM"],
                            $task["RequiredStorage"],
                            $task["Timestamp"],
                            $task["TimestampMS"],
                            $task["RequiredDataDownload"],
                            $task["RequiredDataUpload"],
                            $task["Deadline"],
                            $task["SecurityLevel"],
                            $task["CommunicationType"],
                            $task["ExecutionTime"],
                            $task["EstimateExecutionTime"]
                        );
                    }
                }
                else
                {
                    $this->createTask(
                        $task["Name"],
                        $task["Priority"],
                        $task["RequiredCores"],
                        $task["RequiredMIPSPerCore"],
                        $task["RequiredRAM"],
                        $task["RequiredStorage"],
                        $task["Timestamp"],
                        $task["TimestampMS"],
                        $task["RequiredDataDownload"],
                        $task["RequiredDataUpload"],
                        $task["Deadline"],
                        $task["SecurityLevel"],
                        $task["CommunicationType"],
                        $task["ExecutionTime"],
                        $task["EstimateExecutionTime"]
                    );
                }
            }
            else
            {
                if( $issetTaskID || $applyTaskID )
                {
                    if ( array_key_exists( $task[0] , $this->tasks ) || array_key_exists( $task[0] , $this->runningTasks ) )
                    {
                        throw new Exception("A task with ID \"" . $task[0] . "\" already exists.", 1);
                        return false;
                    }
                    $this->tasks[ $task[0] ] = new Task(
                        $task[1],
                        $task[2],
                        $task[3],
                        $task[4],
                        $task[5],
                        $task[6],
                        $task[7],
                        $task[8],
                        $task[9],
                        $task[10],
                        $task[11],
                        $task[12],
                        $task[13],
                        $task[14],
                        $task[15]
                    );
                }
                else
                {
                    $this->createTask(
                        $task[0],
                        $task[1],
                        $task[2],
                        $task[3],
                        $task[4],
                        $task[5],
                        $task[6],
                        $task[7],
                        $task[8],
                        $task[9],
                        $task[10],
                        $task[11],
                        $task[12],
                        $task[13],
                        $task[14]
                    );
                }
            }
        }
        return true;
    }

    // Load server from JSON data
    public function loadServersFromJSON( string $jsonServers, $issetServerID = false, $issetParameterNames = false, $applyServerID = false )
    {
        $servers = json_decode( $jsonServers, true );
        if ( $servers == false || empty( $servers ) )
        {
            throw new Exception("Could not decode JSON data.", 1);
            return false;
        }
        var_dump($servers);die;
        // var_dump( $this->allServers );die;
        
        foreach ($servers as $key => $server) {
            if ( $issetParameterNames ) {
                if( $issetServerID && $applyServerID )
                {
                    switch ($server["Type"]) {
                        case "Edge":
                            $keyExists = array_key_exists( $server["ID"] , $this->edgeServers );
                            if ( $keyExists )
                            {
                                throw new Exception("A(n) " . $server["Type"] . "-server with ID \"" . $server["ID"] . "\" already exists.", 1);
                                return false;
                            }
                            $this->edgeServers[$server["ID"]] = new Edge(
                                $server["Name"],
                                $server["Cores"],
                                $server["MIPS"],
                                $server["RAM"],
                                $server["AvailableRAM"],
                                $server["Storage"],
                                $server["AvailableStorage"],
                                $server["StorageSpeed"],
                                $server["AverageAccessTime"],
                                $server["Latency"],
                                $server["NetworkBandwidth"],
                                $server["EnergyEfficiency"],
                                $server["RedundancyLevel"],
                                $server["Availability"],
                                $server["Location"],
                                $server["Temperature"]
                            );
                            break;
                        case "Cloud":
                            $keyExists = array_key_exists( $server["ID"] , $this->cloudServers );
                            if ( $keyExists )
                            {
                                throw new Exception("A(n) " . $server["Type"] . "-server with ID \"" . $server["ID"] . "\" already exists.", 1);
                                return false;
                            }
                            $this->cloudServers[$server["ID"]] = new Cloud(
                                $server["Name"],
                                $server["Cores"],
                                $server["MIPS"],
                                $server["RAM"],
                                $server["AvailableRAM"],
                                $server["Storage"],
                                $server["AvailableStorage"],
                                $server["StorageSpeed"],
                                $server["AverageAccessTime"],
                                $server["Latency"],
                                $server["NetworkBandwidth"],
                                $server["EnergyEfficiency"],
                                $server["RedundancyLevel"],
                                $server["Availability"],
                                $server["Location"],
                                $server["Temperature"]
                            );
                            break;
                        case "Server":
                            $keyExists = array_key_exists( $server["ID"] , $this->servers );
                            if ( $keyExists )
                            {
                                throw new Exception("A(n) " . $server["Type"] . "-server with ID \"" . $server["ID"] . "\" already exists.", 1);
                                return false;
                            }
                            $this->servers[$server["ID"]] = new Server(
                                $server["Name"],
                                $server["Type"],
                                $server["Cores"],
                                $server["MIPS"],
                                $server["RAM"],
                                $server["AvailableRAM"],
                                $server["Storage"],
                                $server["AvailableStorage"],
                                $server["StorageSpeed"],
                                $server["AverageAccessTime"],
                                $server["Latency"],
                                $server["NetworkBandwidth"],
                                $server["EnergyEfficiency"],
                                $server["RedundancyLevel"],
                                $server["Availability"]
                            );
                            break;
                        default:
                            return false;
                            break;
                    }
                }
                else
                {
                    switch ($variable) {
                        case "Edge":
                            $this->createEdgeServer(
                                $server["Name"],
                                $server["Cores"],
                                $server["MIPS"],
                                $server["RAM"],
                                $server["AvailableRAM"],
                                $server["Storage"],
                                $server["AvailableStorage"],
                                $server["StorageSpeed"],
                                $server["AverageAccessTime"],
                                $server["Latency"],
                                $server["NetworkBandwidth"],
                                $server["EnergyEfficiency"],
                                $server["RedundancyLevel"],
                                $server["Availability"],
                                $server["Location"],
                                $server["Temperature"]
                            );
                            break;
                        case "Cloud":
                            $this->createCloudServer(
                                $server["Name"],
                                $server["Cores"],
                                $server["MIPS"],
                                $server["RAM"],
                                $server["AvailableRAM"],
                                $server["Storage"],
                                $server["AvailableStorage"],
                                $server["StorageSpeed"],
                                $server["AverageAccessTime"],
                                $server["Latency"],
                                $server["NetworkBandwidth"],
                                $server["EnergyEfficiency"],
                                $server["RedundancyLevel"],
                                $server["Availability"],
                                $server["Location"],
                                $server["Temperature"]
                            );
                            break;
                        case "Server":
                            $this->createServer(
                                $server["Name"],
                                $server["Type"],
                                $server["Cores"],
                                $server["MIPS"],
                                $server["RAM"],
                                $server["AvailableRAM"],
                                $server["Storage"],
                                $server["AvailableStorage"],
                                $server["StorageSpeed"],
                                $server["AverageAccessTime"],
                                $server["Latency"],
                                $server["NetworkBandwidth"],
                                $server["EnergyEfficiency"],
                                $server["RedundancyLevel"],
                                $server["Availability"]
                            );
                            break;
                        default:
                            return false;
                            break;
                    }
                }
            }
            else
            {
                if( $issetServerID && $applyServerID )
                {
                    switch ($server[2]) {
                        case "Edge":
                            $keyExists = array_key_exists( $server[0] , $this->edgeServers );
                            break;
                        case "Cloud":
                            $keyExists = array_key_exists( $server[0] , $this->cloudServers );
                            break;
                        case "Server":
                            $keyExists = array_key_exists( $server[0] , $this->servers );
                            break;
                        default:
                            return false;
                            break;
                    }
                    if ( $keyExists )
                    {
                        throw new Exception("A(n) " . $server[1] . "-server with ID \"" . $server[2] . "\" already exists.", 1);
                        return false;
                    }
                    switch ($server[2]) {
                        case "Edge":
                            $keyExists = array_key_exists( $server[0] , $this->edgeServers );
                            $this->edgeServers[ $server[0] ] = [
                                "Type" => $server[2],
                                "ID" => $server[0],
                                "Object" => new Server(
                                    $server[1],
                                    $server[2],
                                    $server[3],
                                    $server[4],
                                    $server[5],
                                    $server[6],
                                    $server[7],
                                    $server[8],
                                    $server[9],
                                    $server[10],
                                    $server[11],
                                    $server[12],
                                    $server[13],
                                    $server[14],
                                    $server[15],
                                    $server[16]
                                )
                            ];
                            break;
                        case "Cloud":
                            $keyExists = array_key_exists( $server[0] , $this->cloudServers );
                            $this->cloudServers[ $server[0] ] = [
                                "Type" => $server[2],
                                "ID" => $server[0],
                                "Object" => new Server(
                                    $server[1],
                                    $server[2],
                                    $server[3],
                                    $server[4],
                                    $server[5],
                                    $server[6],
                                    $server[7],
                                    $server[8],
                                    $server[9],
                                    $server[10],
                                    $server[11],
                                    $server[12],
                                    $server[13],
                                    $server[14],
                                    $server[15],
                                    $server[16]
                                )
                            ];
                            break;
                        case "Server":
                            $keyExists = array_key_exists( $server[0] , $this->servers );
                            $this->servers[ $server[0] ] = [
                                "Type" => $server[2],
                                "ID" => $server[0],
                                "Object" => new Server(
                                    $server[1],
                                    $server[2],
                                    $server[3],
                                    $server[4],
                                    $server[5],
                                    $server[6],
                                    $server[7],
                                    $server[8],
                                    $server[9],
                                    $server[10],
                                    $server[11],
                                    $server[12],
                                    $server[13],
                                    $server[14],
                                    $server[15],
                                    $server[16]
                                )
                            ];
                            break;
                        default:
                            return false;
                            break;
                    }
                }
                else
                {
                    
                }
            }
        }
        return true;
    }

    // Load tasks from CSV data
    public function loadTasksFromCSV( string $csvTasks, $issetTaskID = false, $issetParameterNames = false, $applyTaskID = false )
    {
        # code...
    }

    // Load server from CSV data
    public function loadServersFromCSV( string $csvServers, $issetServerID = false, $issetParameterNames = false, $applyServerID = false )
    {
        # code...
    }

    // Get methods of this class 
    public function getMethods()
    {
        return get_class_methods( get_class( $this ) ) ;
    }

    // Get a TimeStamp in milliseconds
    public function getTimestampMS( $time = NULL )
    {
        if( $time === NULL )
            return floor(microtime(true) * 1000);
        return floor( $time  * 1000);
    }

    // Getter and Setter for assignMethod
    public function getAssignMethod()
    {
        return $this->assignMethod;
    }
    public function setAssignMethod( $assignMethod = "Default" )
    {
        if( !in_array($assignMethod, $this->getAssignMethods()) )
        {
            throw new Exception("Invalid type for assignMethod \"" . $assignMethod . "\".", 1);
            return false;
        }
        $this->assignMethod = $assignMethod;
        return true;
    }

    // Get all avaiable Assign-Methods
    public function getAssignMethods()
    {
        return $this->assignMethods;
    }

    // Sort all servers based on EdgeFirst
    public function sortServers_EdgeFirst(array $servers)
    {
        $edges = [];
        $else = [];
        foreach ($servers as $server) {
            if ( $server["Type"] == "Edge" )
                $edges[] = $server;
            else $else[] = $server;
        }
        return array_merge( $edges, $else );
    }

    // Sort all servers based on CloudFirst
    public function sortServers_CloudFirst(array $servers)
    {
        $clouds = [];
        $else = [];
        foreach ($servers as $server) {
            if ( $server["Type"] == "Cloud" )
                $clouds[] = $server;
            else $else[] = $server;
        }
        return array_merge( $clouds, $else );
    }

    // Sort all servers based on ServerFirst
    public function sortServers_ServerFirst(array $servers)
    {
        $servers_type = [];
        $else = [];
        foreach ($servers as $server) {
            if ( $server["Type"] == "Server" )
                $servers_type[] = $server;
            else $else[] = $server;
        }
        return array_merge( $servers_type, $else );
    }

    // Sort all servers based on EdgeCloudServer
    public function sortServers_EdgeCloudServer(array $servers)
    {
        $edges = [];
        $clouds = [];
        $servers_type = [];
        foreach ($servers as $server) {
            if ( $server["Type"] == "Edge" )
                $edges[] = $server;
            if ( $server["Type"] == "Cloud" )
                $clouds[] = $server;
            else $servers_type[] = $server;
        }
        return array_merge( $edges, $clouds, $servers_type );
    }

    // Sort all servers based on EdgeServerCloud
    public function sortServers_EdgeServerCloud(array $servers)
    {
        $edges = [];
        $clouds = [];
        $servers_type = [];
        foreach ($servers as $server) {
            if ( $server["Type"] == "Edge" )
                $edges[] = $server;
            if ( $server["Type"] == "Cloud" )
                $clouds[] = $server;
            else $servers_type[] = $server;
        }
        return array_merge( $edges, $servers_type, $clouds );
    }

    // Sort all servers based on CloudEdgeServer
    public function sortServers_CloudEdgeServer(array $servers)
    {
        $edges = [];
        $clouds = [];
        $servers_type = [];
        foreach ($servers as $server) {
            if ( $server["Type"] == "Edge" )
                $edges[] = $server;
            if ( $server["Type"] == "Cloud" )
                $clouds[] = $server;
            else $servers_type[] = $server;
        }
        return array_merge( $clouds, $edges, $servers_type );
    }

    // Sort all servers based on CloudServerEdge
    public function sortServers_CloudServerEdge(array $servers)
    {
        $edges = [];
        $clouds = [];
        $servers_type = [];
        foreach ($servers as $server) {
            if ( $server["Type"] == "Edge" )
                $edges[] = $server;
            if ( $server["Type"] == "Cloud" )
                $clouds[] = $server;
            else $servers_type[] = $server;
        }
        return array_merge( $clouds, $servers_type, $edges );
    }

    // Sort all servers based on ServerEdgeCloud
    public function sortServers_ServerEdgeCloud(array $servers)
    {
        $edges = [];
        $clouds = [];
        $servers_type = [];
        foreach ($servers as $server) {
            if ( $server["Type"] == "Edge" )
                $edges[] = $server;
            if ( $server["Type"] == "Cloud" )
                $clouds[] = $server;
            else $servers_type[] = $server;
        }
        return array_merge( $servers_type, $edges, $clouds );
    }

    // Sort all servers based on ServerCloudEdge
    public function sortServers_ServerCloudEdge(array $servers)
    {
        $edges = [];
        $clouds = [];
        $servers_type = [];
        foreach ($servers as $server) {
            if ( $server["Type"] == "Edge" )
                $edges[] = $server;
            if ( $server["Type"] == "Cloud" )
                $clouds[] = $server;
            else $servers_type[] = $server;
        }
        return array_merge( $servers_type, $clouds, $edges  );
    }

    // Generate random tasks
    public function generateRandomTasks(int $taskNumbers)
    {
        $IDs = [];
        $taskCategories = ["Health", "Navigation", "Communication", "Entertainment", "Productivity"];
        $priorities = ["Low", "Medium", "High"];
        $securityLevels = ["Low", "Medium", "High"];
        $communicationTypes = ["synchronous", "asynchronous"];

        for ($i = 0; $i < $taskNumbers; $i++) {
            $category = $taskCategories[array_rand($taskCategories)];
            $actionVerbs = ["Monitor", "Track", "Analyze", "Calculate", "Record"];
            $action = $actionVerbs[array_rand($actionVerbs)];
            $name = $category . " " . $action;
            $priority = $priorities[array_rand($priorities)];
            $requiredCores = mt_rand(MIN_TASK_REQUIRED_CORE, MAX_TASK_REQUIRED_CORE);
            $requiredMIPSPerCore = mt_rand(MIN_TASK_REQUIRED_MIPS, MAX_TASK_REQUIRED_MIPS);
            $requiredRAM = mt_rand(MIN_TASK_REQUIRED_RAM, MAX_TASK_REQUIRED_RAM);
            $requiredStorage = mt_rand(MIN_TASK_REQUIRED_STORAGE, MAX_TASK_REQUIRED_STORAGE);
            $timestamp = time();
            $timestampMS = $this->getTimestampMS();
            $requiredDataDownload = mt_rand(MIN_TASK_REQUIRED_DOWNLOAD, MAX_TASK_REQUIRED_DOWNLOAD);
            $requiredDataUpload = mt_rand(MIN_TASK_REQUIRED_UPLOAD, MAX_TASK_REQUIRED_UPLOAD);
            $deadline = $timestamp + mt_rand(MIN_TASK_DEADLINE, MAX_TASK_DEADLINE); // 1 to 24 hours
            $securityLevel = $securityLevels[array_rand($securityLevels)];
            $communicationType = $communicationTypes[array_rand($communicationTypes)];
            $ExecutionTime = NULL;
            $EstimateExecutionTime = (mt_rand(0,9)>6) ? mt_rand(MIN_TASK_ESTIMATE_EXECUTION_TIME, MAX_TASK_ESTIMATE_EXECUTION_TIME_1) : mt_rand(MIN_TASK_ESTIMATE_EXECUTION_TIME, MAX_TASK_ESTIMATE_EXECUTION_TIME_2);

            $IDs[] = $this->createTask(
                $name,
                $priority,
                $requiredCores,
                $requiredMIPSPerCore,
                $requiredRAM,
                $requiredStorage,
                $timestamp,
                $timestampMS,
                $requiredDataDownload,
                $requiredDataUpload,
                $deadline,
                $securityLevel,
                $communicationType,
                $ExecutionTime,
                $EstimateExecutionTime
            );
        }
        return $IDs;
    }

    // Generate random edge/cloud servers
    public function generateRandomServers(int $serverNumbers)
    {
        $serverTypes = ["Edge", "Cloud"];
        $locations = ["LocationA", "LocationB", "LocationC"];

        $serverIDs = [];

        for ($i = 0; $i < $serverNumbers; $i++) {
            $serverType = $serverTypes[array_rand($serverTypes)];
            $namePrefix = ($serverType === "Edge") ? "E" : "C";
            $name = $namePrefix . ($i + 1); // Assuming a simple numbering scheme
            $cores = mt_rand(MIN_SERVER_CORES, MAX_SERVER_CORES);
            $mips = mt_rand(MIN_SERVER_MIPS, MAX_SERVER_MIPS);
            $ram = mt_rand(MIN_SERVER_RAM, MAX_SERVER_RAM);
            $availableRam = $ram - mt_rand(MIN_SERVER_RAM_NOT_AVAILABLE_RANGE, MAX_SERVER_RAM_NOT_AVAILABLE_RANGE); // Random available RAM within the range
            $storage = mt_rand(MIN_SERVER_STORAGE, MAX_SERVER_STORAGE);
            $availableStorage = $storage - mt_rand(MIN_SERVER_STORAGE_NOT_AVAILABLE_RANGE, MAX_SERVER_STORAGE_NOT_AVAILABLE_RANGE); // Random available storage within the range
            $storageSpeed = mt_rand(MIN_SERVER_STORAGE_SPEED, MAX_SERVER_STORAGE_SPEED); // Storage speed in MBps
            $averageAccessTime = ($serverType === "Edge") ? mt_rand(MIN_SERVER_AVERAGE_ACCESS_TIME_EDGE, MAX_SERVER_AVERAGE_ACCESS_TIME_EDGE) : mt_rand(MIN_SERVER_AVERAGE_ACCESS_TIME_CLOUD, MAX_SERVER_AVERAGE_ACCESS_TIME_CLOUD);
            $latency = ($serverType === "Edge") ? $averageAccessTime + mt_rand(-1 * MIN_SERVER_AVERAGE_ACCESS_TIME_EDGE, MIN_SERVER_AVERAGE_ACCESS_TIME_EDGE) : $averageAccessTime + mt_rand(-1 * (MIN_SERVER_AVERAGE_ACCESS_TIME_CLOUD/2), (MIN_SERVER_AVERAGE_ACCESS_TIME_CLOUD/2));
            $networkBandwidth = mt_rand(MIN_SERVER_BANDWIDTH, MAX_SERVER_BANDWIDTH); // Bandwidth in Mbps
            $energyEfficiency = 1.5; // Assuming a constant value for energy efficiency
            $redundancyLevel = mt_rand(1, 3); // Assuming redundancy levels 1, 2, 3
            $availability = true; // Servers are assumed to be available initially
            $location = $locations[array_rand($locations)];
            $temperature = mt_rand(MIN_SERVER_TEMPERATURE, MAX_SERVER_TEMPERATURE);


            if ($serverType === "Edge") {
                $serverID = $this->createEdgeServer(
                    $name,
                    $cores,
                    $mips,
                    $ram,
                    $availableRam,
                    $storage,
                    $availableStorage,
                    $storageSpeed,
                    $averageAccessTime,
                    $latency,
                    $networkBandwidth,
                    $energyEfficiency,
                    $redundancyLevel,
                    $availability,
                    $location,
                    $temperature
                );
            } else {
                $serverID = $this->createCloudServer(
                    $name,
                    $cores,
                    $mips,
                    $ram,
                    $availableRam,
                    $storage,
                    $availableStorage,
                    $storageSpeed,
                    $averageAccessTime,
                    $latency,
                    $networkBandwidth,
                    $energyEfficiency,
                    $redundancyLevel,
                    $availability,
                    $location,
                    $temperature
                );
            }
            $serverIDs[] = $serverID;
        }

        return $serverIDs;
    }

    // Calculate the execution time for a task based on the server which the task is offloaded to
    public function calculateExecutionTime(Task $task, $server) {
        
        // Ensure valid server type
        if (!($server instanceof Server || $server instanceof Edge || $server instanceof Cloud)) {
            throw new Exception("Invalid server type: \"" . gettype($server) . "\".", 1);
        }
        
        $taskParameters = $this->getTaskDetails($task);
        $serverParameters = $this->getServerStatus($server);

        $ExecutionTime = $taskParameters["EstimateExecutionTime"];
    
        $factor_1 = $serverParameters["Cores"] / $taskParameters["RequiredCores"];
        $factor_2 = $serverParameters["MIPS"] / $taskParameters["RequiredMIPSPerCore"];
        $factor_3 = $serverParameters["AvailableRAM"] / $taskParameters["RequiredRAM"];
        $factor_4 = $serverParameters["AvailableStorage"] / $taskParameters["RequiredStorage"];
        $factor_5 = ($taskParameters["RequiredDataDownload"] + $taskParameters["RequiredDataUpload"]) / $serverParameters["NetworkBandwidth"];
        $factor_6 = $serverParameters["StorageSpeed"];
        $factor_7 = count($serverParameters["ActiveTasks"]);
        $factor_8 = $serverParameters["Latency"];
        

        // Normalization of Factors
        $factor_1 = $this->min_max_0_1($factor_1, MIN_CT_FACTOR_1, MAX_CT_FACTOR_1);
        $factor_2 = $this->min_max_0_1($factor_2, MIN_CT_FACTOR_2, MAX_CT_FACTOR_2);
        $factor_3 = $this->min_max_0_1($factor_3, MIN_CT_FACTOR_3, MAX_CT_FACTOR_3);
        $factor_4 = $this->min_max_0_1($factor_4, MIN_CT_FACTOR_4, MAX_CT_FACTOR_4);
        $factor_5 = $this->min_max_0_1($factor_5, MIN_CT_FACTOR_5, MAX_CT_FACTOR_5);
        $factor_6 = $this->min_max_0_1($factor_6, MIN_CT_FACTOR_6, MAX_CT_FACTOR_6);
        $factor_7 = $this->min_max_0_1($factor_7, MIN_CT_FACTOR_7, MAX_CT_FACTOR_7);
        $factor_8 = $this->min_max_0_1($factor_8, MIN_CT_FACTOR_8, MAX_CT_FACTOR_8);


        // Assign a weight to each factor
        $factor_1 = 1 - ($factor_1 * 0.05);
        $factor_2 = 1 - ($factor_2 * 0.2);
        $factor_3 = 1 - ($factor_3 * 0.1);
        $factor_4 = 1 - ($factor_4 * 0.05);
        $factor_5 = 1 - ($factor_5 * 0.2);
        $factor_6 = 1 - ($factor_6 * 0.1);
        $factor_7 = 1 - ((1 - $factor_7) * 0.2);
        $factor_8 = 1 - ($factor_8 * 0.1);

        // Apply factors to final ExecutionTime
        $ExecutionTime *= $factor_1;
        $ExecutionTime *= $factor_2;
        $ExecutionTime *= $factor_3;
        $ExecutionTime *= $factor_4;
        $ExecutionTime *= $factor_5;
        $ExecutionTime *= $factor_6;
        $ExecutionTime *= $factor_7;
        $ExecutionTime *= $factor_8;

        // Apply Edge factor
        $ExecutionTime *= ($server instanceof Edge)? 0.7 : 1;

        return $ExecutionTime;
    }

    // Reduce Task Dimensionality
    public function reduceTaskDimensionality( $task, $roundupRange = 1000000000 ) {
        $weight = 0;
        $task = $this->getTaskDetails( $task );

        $weight += 0.15  *   $this->min_max_0_1($task["RequiredRAM"], MIN_TASK_REQUIRED_RAM, MAX_TASK_REQUIRED_RAM); 
        $weight += 0.15  *   $this->min_max_0_1($task["RequiredStorage"], MIN_TASK_REQUIRED_STORAGE, MAX_TASK_REQUIRED_STORAGE); 
        $weight += 0.15  *   $this->min_max_0_1($task["RequiredMIPSPerCore"], MIN_TASK_REQUIRED_MIPS, MAX_TASK_REQUIRED_MIPS); 
        $weight += 0.1   *   $this->min_max_0_1($task["RequiredCores"], MIN_TASK_REQUIRED_CORE, MAX_TASK_REQUIRED_CORE); 
        $weight += 0.1   *   $this->min_max_0_1($task["RequiredDataDownload"], MIN_TASK_REQUIRED_DOWNLOAD, MAX_TASK_REQUIRED_DOWNLOAD); 
        $weight += 0.1   *   $this->min_max_0_1($task["RequiredDataUpload"], MIN_TASK_REQUIRED_UPLOAD, MAX_TASK_REQUIRED_UPLOAD); 
        $weight += 0.15  *   $this->min_max_0_1($task["EstimateExecutionTime"], MIN_TASK_ESTIMATE_EXECUTION_TIME, MAX_TASK_ESTIMATE_EXECUTION_TIME_2); 

        // Normalize range of weight in a decent range suitable for knapsack's capacity
        $weight = $this->min_max_0_1( $weight, 0, (MAX_ACTIVE_TASKS/2) );

        $value = 0.8 * max(0, $task["Deadline"] - time())
        + 0.2 * ($task["Priority"] === "High" ? 1 : 0)
        + 0.2 * ($task["Priority"] === "Medium" ? 1 : 0);

        return [ (int)$value, (int)($roundupRange*$weight) ];
    }

    // Reduce Server Dimensionality
    public function reduceServerDimensionality( $server,  $roundupRange = 1000000000 ) {

        $server = $this->getServerStatus( $server );
        $capacity = 0;
    
        $capacity += 0.2    * $this->min_max_0_1($server["Cores"], MIN_SERVER_CORES , MAX_SERVER_CORES);
        $capacity += 0.2    * $this->min_max_0_1($server["AvailableRAM"], MIN_AVAILABLE_RAM , MAX_AVAILABLE_RAM);
        $capacity += 0.2    * (1 - $this->min_max_0_1(count($server["ActiveTasks"]), MIN_ACTIVE_TASKS , MAX_ACTIVE_TASKS));
        $capacity += 0.15   * $this->min_max_0_1($server["MIPS"], MIN_SERVER_MIPS , MAX_SERVER_MIPS);
        $capacity += 0.1    * $this->min_max_0_1($server["AvailableStorage"], MIN_AVAILABLE_STORAGE , MAX_AVAILABLE_STORAGE);
        $capacity += 0.1    * $this->min_max_0_1($server["Latency"], MIN_ACTIVE_LATENCY , MAX_ACTIVE_LATENCY);
        $capacity += 0.05   * $this->min_max_0_1($server["NetworkBandwidth"], MIN_SERVER_BANDWIDTH , MAX_SERVER_BANDWIDTH);
    
        return (int)($roundupRange*$capacity);
    }
    
    // Min-Max normalization (Rescaling) in range [0,1]
    public function min_max_0_1( $x, $min_x, $max_x )
    {
        return ($x - $min_x) / ($max_x - $min_x);
    }

    // Prints logs
    public function printLog( string $message )
    {
        $logSgn = (PHP_OS === "Linux") ? "[\033[1;32mLog\033[0m] " : "[Log] ";
        echo $logSgn . $message . PHP_EOL;
    }

    // Prints errors
    public function printError( string $error )
    {
        $errorSgn = (PHP_OS === "Linux") ? "[\033[1;31mError\033[0m] " : "[Error] ";
        echo $errorSgn . $error . PHP_EOL;
    }

    // Prints ECHOES logo
    public function printLogo()
    {
        $logo = (PHP_OS === "Linux")?("\033[1;34mc########################."
            . "\n                ########   .######;.                               xxxxxxx"
            . "\n                .:###=            ,###:.XXXXX..            //.....,xx   xx."
            . "\n.====.      =###=             .;##XXXXXXXXXXXXc,.         //      .xx   xx."
            . "\n.######     .###.            =c###XXXXXXXXXXXXXXXX#,.....//        xxxXdxx."
            . "\n            ####,   .=############XXXXXXXXXXX"
            . "\n        .;c##### ,###############XXXXXXXXXXX........."
            . "\n        =c###=    .################XXXXXXXXXXXXXXXXXXddX       xxxxxxx."
            . "\n    ....:###       =################XXXXXXXXXXXXXXXXXXddd......xx   xx."
            . "\n,######,         c###############XXXXX.                        xxxxxxx."
            . "\n                    ,#############XXXXXc;;;;;;;;;::::::"
            . "\n    .######,               ########XXXXXXXXXXXXXXXXXXddd........"
            . "\n    .#######               .#######XXXXXXXXXXXX=               \\\\       xxxxxxx."
            . "\n                            ,#######XXXXXXXXXXXX:......         \\\\......xx   xx."
            . "\n        .=,,,,,,,,,,,,,,,,:########XXXXXXXXXXXXXXXXX#                   xxxxxxx."
            . "\n        ###########################XXXXXXXXXXXXXXXXXX;;."
            . "\n\033[1;35m _____ ____ _   _  ___  _____ ____\033[0m\033[1;34m   .XXXXXXXXXXXXXX:;\\\\\033[0m"
            . "\n\033[1;35m| ____/ ___| | | |/ _ \\| ____/ ___|\033[0m\033[1;34m                    \\\\     xxxxxxx.\033[0m"
            . "\n\033[1;35m|  _|| |   | |_| | | | |  _| \\___ \\\033[0m\033[1;34m                     \\\\....xx   xx.\033[0m"
            . "\n\033[1;35m| |__| |___|  _  | |_| | |___ ___) |\033[0m\033[1;34m                          xxxxxxx.\033[0m"
            . "\n\033[1;35m|_____\\____|_| |_|\\___/|_____|____/\033[0m\033[0m"
            . "\n\033[1;33mECHOES: Edge and Cloud Hybrid Optimization Environment Simulator\033[0m"):
            ("c########################."
            . "\n                ########   .######;.                               xxxxxxx"
            . "\n                .:###=            ,###:.XXXXX..            //.....,xx   xx."
            . "\n.====.      =###=             .;##XXXXXXXXXXXXc,.         //      .xx   xx."
            . "\n.######     .###.            =c###XXXXXXXXXXXXXXXX#,.....//        xxxXdxx."
            . "\n            ####,   .=############XXXXXXXXXXX"
            . "\n        .;c##### ,###############XXXXXXXXXXX........."
            . "\n        =c###=    .################XXXXXXXXXXXXXXXXXXddX       xxxxxxx."
            . "\n    ....:###       =################XXXXXXXXXXXXXXXXXXddd......xx   xx."
            . "\n,######,         c###############XXXXX.                        xxxxxxx."
            . "\n                    ,#############XXXXXc;;;;;;;;;::::::"
            . "\n    .######,               ########XXXXXXXXXXXXXXXXXXddd........"
            . "\n    .#######               .#######XXXXXXXXXXXX=               \\\\       xxxxxxx."
            . "\n                            ,#######XXXXXXXXXXXX:......         \\\\......xx   xx."
            . "\n        .=,,,,,,,,,,,,,,,,:########XXXXXXXXXXXXXXXXX#                   xxxxxxx."
            . "\n        ###########################XXXXXXXXXXXXXXXXXX;;."
            . "\n _____ ____ _   _  ___  _____ ____   .XXXXXXXXXXXXXX:;\\\\"
            . "\n| ____/ ___| | | |/ _ \\| ____/ ___|                    \\\\     xxxxxxx."
            . "\n|  _|| |   | |_| | | | |  _| \\___ \\                     \\\\....xx   xx."
            . "\n| |__| |___|  _  | |_| | |___ ___) |                          xxxxxxx."
            . "\n|_____\\____|_| |_|\\___/|_____|____/"
            . "\nECHOES: Edge and Cloud Hybrid Optimization Environment Simulator");
        echo $logo . PHP_EOL;
    }

    // Prints Seperator
    public function printSeperator()
    {
        $sep = (PHP_OS === "Linux")?
        "\033[1;31m---------------------------------------------------------------------\033[0m " :
        "---------------------------------------------------------------------";
        echo $sep . PHP_EOL;
    }

    // Prints Info
    public function printInfo()
    {
        $info = "* Copyright (c) 2023 Behrad.B (behroora@yahoo.com)"
        . "\nAUTHOR :           TadavomnisT (Behrad.B)"
        . "\nRepo :             https://github.com/TadavomnisT/ECHOES"
        . "\nREPORTING BUGS :   https://github.com/TadavomnisT/ECHOES/issues"
        . "\nCOPYRIGHT :"
        . "\n\tCopyright (c) 2023   License GPLv3+"
        . "\n\tThis is free software: you are free to change and redistribute it."
        . "\n\tThere is NO WARRANTY, to the extent permitted by law.";

        echo $info . PHP_EOL;
    }

    // Assign a Task to a Server
    public function assignTask( $taskID, $serverType, $serverID, $returnError = False )
    {
        if ($serverType != "Edge" && $serverType != "Cloud" && $serverType != "Server") {
            throw new Exception("Invalid server-type : \"" . $serverType . "\"." , 1);
            return false;
        }
        if ( $this->getTask( $taskID ) === false ) {
            throw new Exception("Invalid task-ID : \"" . $taskID . "\"." , 1);
            return false;
        }
        switch ($serverType) {
            case "Edge":
                if (empty($this->getEdgeServers()[$serverID])) {
                    throw new Exception("Invalid edge-server-ID : \"" . $serverID . "\"." , 1);
                    return false;
                }
                $server = $this->getEdgeServers()[$serverID];
                break;
            case "Cloud":
                if (empty($this->getCloudServers()[$serverID])) {
                    throw new Exception("Invalid cloud-server-ID : \"" . $serverID . "\"." , 1);
                    return false;
                }
                $server = $this->getCloudServers()[$serverID];
                break;
            case "Server":
                if (empty($this->getServers()[$serverID])) {
                    throw new Exception("Invalid server-ID : \"" . $serverID . "\"." , 1);
                    return false;
                }
                $server = $this->getServers()[$serverID];
                break;
            default:
                throw new Exception("Invalid server-type : \"" . $serverType . "\"." , 1);
                return false;
                break;
        }

        $this->UpdateServers();
        $task = $this->getTask( $taskID );

        if ( $task->getRequiredCores() > $server->getCores() ) {
            return ( $returnError ) ? [ False, "Server's cores are less than task's required cores." ] : False ;
        }
        if ( $task->getRequiredMIPSPerCore() > $server->getMIPS() ) {
            return ( $returnError ) ? [ False, "Server's MIPS is less than task's required MIPS." ] : False ;
        }
        if ( $task->getRequiredRAM() > $server->getAvailableRAM() ) {
            return ( $returnError ) ? [ False, "Server's avaiable RAM is less than task's required RAM." ] : False ;
        }
        if ( $task->getRequiredStorage() > $server->getAvailableStorage() ) {
            return ( $returnError ) ? [ False, "Server's avaiable Storage is less than task's required Storage." ] : False ;
        }
        if ( $task->getTimestamp() + $task->getDeadline() <= time() ) {
            return ( $returnError ) ? [ False, "Task is expired." ] : False ;
        }
        if ( !$server->getAvailability() ) {
            return ( $returnError ) ? [ False, "Server is not Available." ] : False ;
        }

        // Calculate and set real ExecutionTime based on server
        $task->setExecutionTime( $this->calculateExecutionTime( $task, $server ) );

        $server->addTask( $taskID, $task );
        return true;
    }

    // Assign all Tasks using assignMethod
    public function assignAllTasks()
    {
        $tasks = $this->getTasks();
        $assignedTasks = [];
        $remainingTasks = array_keys( $tasks );
        switch ( $this->getAssignMethod() ) {
            case "Default":
                // Tasks are assigned on a "First-come, First-served" basis
                // Servers are choosed by "Default" order
                $servers = $this->getAllServers();
                foreach ($tasks as $taskID => $task) { 
                    $this->UpdateServers();
                    foreach ($servers as $server) {
                        if ( $this->assignTask( $taskID, $server["Type"], $server["ID"] ) === true ) {
                            unset( $remainingTasks[$taskID] );
                            $assignedTasks[] = $taskID;

                            // Delete assigned tasks from tasks[] and set them to runningTasks[]
                            $this->addRunningTask( $this->getTask( $taskID), $taskID );
                            $this->deleteTask( $taskID );

                            break;
                        }
                    }
                }
                break;
            case "Random":
                // Tasks are assigned on a "First-come, First-served" basis
                // Servers are choosed Randomly
                $servers = $this->getAllServers();
                shuffle( $servers );
                foreach ($tasks as $taskID => $task) { 
                    $this->UpdateServers();
                    foreach ($servers as $server) {
                        if ( $this->assignTask( $taskID, $server["Type"], $server["ID"] ) === true ) {
                            unset( $remainingTasks[$taskID] );
                            $assignedTasks[] = $taskID;

                            // Delete assigned tasks from tasks[] and set them to runningTasks[]
                            $this->addRunningTask( $this->getTask( $taskID), $taskID );
                            $this->deleteTask( $taskID );

                            break;
                        }
                    }
                }
                break;

            case "Knapsack":
                // Solve Multiple-Knapsack-Problem(MKP) as if the Servers are knapsacks with limited capacity, and the Tasks are items
                $this->UpdateServers();
                $servers = $this->getAllServers();
                $knapsacks = [];
                $items = [];
                $taskIDs = [];

                // Part_1: Dimensionality Reduction!
                foreach ($servers as $server) {
                    $knapsacks[] = $this->reduceServerDimensionality( $server["Object"] );
                }
                foreach ($tasks as $taskID => $task) {
                    // $items[] = $this->reduceTaskDimensionality( $task );
                    list($item_values[],$item_weights[]) = $this->reduceTaskDimensionality( $task );
                    $taskIDs[] = $taskID;
                }
                
                // Part_2: Solve MKP
                $MKP_Result = $this->knapsack->MKP( $knapsacks, $item_values, $item_weights );
                foreach ($MKP_Result as $key => $serverID_plus_1) {
                    $taskID = $taskIDs[$key];
                    if ( $this->assignTask( $taskID, $servers[$serverID_plus_1-1]["Type"], $servers[$serverID_plus_1-1]["ID"] ) === true ) {
                        unset( $remainingTasks[$taskID] );
                        $assignedTasks[] = $taskID;

                        // Delete assigned tasks from tasks[] and set them to runningTasks[]
                        $this->addRunningTask( $this->getTask( $taskID), $taskID );
                        $this->deleteTask( $taskID );
                    }
                }

                break;

            case "EdgeFirst":
                // Tasks are assigned on a "First-come, First-served" basis
                // Edge-Servers are choosed first
                $servers = $this->getAllServers();
                $servers = $this->sortServers_EdgeFirst( $servers );
                foreach ($tasks as $taskID => $task) { 
                    $this->UpdateServers();
                    foreach ($servers as $server) {
                        if ( $this->assignTask( $taskID, $server["Type"], $server["ID"] ) === true ) {
                            unset( $remainingTasks[$taskID] );
                            $assignedTasks[] = $taskID;

                            // Delete assigned tasks from tasks[] and set them to runningTasks[]
                            $this->addRunningTask( $this->getTask( $taskID), $taskID );
                            $this->deleteTask( $taskID );

                            break;
                        }
                    }
                }
                break;

            case "CloudFirst":
                // Tasks are assigned on a "First-come, First-served" basis
                // Cloud-Servers are choosed first
                $servers = $this->getAllServers();
                $servers = $this->sortServers_CloudFirst( $servers );
                foreach ($tasks as $taskID => $task) { 
                    $this->UpdateServers();
                    foreach ($servers as $server) {
                        if ( $this->assignTask( $taskID, $server["Type"], $server["ID"] ) === true ) {
                            unset( $remainingTasks[$taskID] );
                            $assignedTasks[] = $taskID;

                            // Delete assigned tasks from tasks[] and set them to runningTasks[]
                            $this->addRunningTask( $this->getTask( $taskID), $taskID );
                            $this->deleteTask( $taskID );

                            break;
                        }
                    }
                }
                break;

            case "ServerFirst":
                // Tasks are assigned on a "First-come, First-served" basis
                // Servers with type of "Server" are choosed first
                $servers = $this->getAllServers();
                $servers = $this->sortServers_ServerFirst( $servers );
                foreach ($tasks as $taskID => $task) { 
                    $this->UpdateServers();
                    foreach ($servers as $server) {
                        if ( $this->assignTask( $taskID, $server["Type"], $server["ID"] ) === true ) {
                            unset( $remainingTasks[$taskID] );
                            $assignedTasks[] = $taskID;

                            // Delete assigned tasks from tasks[] and set them to runningTasks[]
                            $this->addRunningTask( $this->getTask( $taskID), $taskID );
                            $this->deleteTask( $taskID );

                            break;
                        }
                    }
                }
                break;
            
            case "EdgeCloudServer":
                // Tasks are assigned on a "First-come, First-served" basis
                // First Edge-servers then Cloud-servers then typical-servers
                $servers = $this->getAllServers();
                $servers = $this->sortServers_EdgeCloudServer( $servers );
                foreach ($tasks as $taskID => $task) { 
                    $this->UpdateServers();
                    foreach ($servers as $server) {
                        if ( $this->assignTask( $taskID, $server["Type"], $server["ID"] ) === true ) {
                            unset( $remainingTasks[$taskID] );
                            $assignedTasks[] = $taskID;

                            // Delete assigned tasks from tasks[] and set them to runningTasks[]
                            $this->addRunningTask( $this->getTask( $taskID), $taskID );
                            $this->deleteTask( $taskID );

                            break;
                        }
                    }
                }
                break;

            case "EdgeServerCloud":
                // Tasks are assigned on a "First-come, First-served" basis
                // First Edge-servers then typical-servers then Cloud-servers
                $servers = $this->getAllServers();
                $servers = $this->sortServers_EdgeServerCloud( $servers );
                foreach ($tasks as $taskID => $task) { 
                    $this->UpdateServers();
                    foreach ($servers as $server) {
                        if ( $this->assignTask( $taskID, $server["Type"], $server["ID"] ) === true ) {
                            unset( $remainingTasks[$taskID] );
                            $assignedTasks[] = $taskID;

                            // Delete assigned tasks from tasks[] and set them to runningTasks[]
                            $this->addRunningTask( $this->getTask( $taskID), $taskID );
                            $this->deleteTask( $taskID );

                            break;
                        }
                    }
                }
                break;

            case "CloudEdgeServer":
                // Tasks are assigned on a "First-come, First-served" basis
                // First Cloud-servers then Edge-servers then typical-servers 
                $servers = $this->getAllServers();
                $servers = $this->sortServers_CloudEdgeServer( $servers );
                foreach ($tasks as $taskID => $task) { 
                    $this->UpdateServers();
                    foreach ($servers as $server) {
                        if ( $this->assignTask( $taskID, $server["Type"], $server["ID"] ) === true ) {
                            unset( $remainingTasks[$taskID] );
                            $assignedTasks[] = $taskID;

                            // Delete assigned tasks from tasks[] and set them to runningTasks[]
                            $this->addRunningTask( $this->getTask( $taskID), $taskID );
                            $this->deleteTask( $taskID );

                            break;
                        }
                    }
                }
                break;

            case "CloudServerEdge":
                // Tasks are assigned on a "First-come, First-served" basis
                // First Cloud-servers then typical-servers then Edge-servers
                $servers = $this->getAllServers();
                $servers = $this->sortServers_CloudServerEdge( $servers );
                foreach ($tasks as $taskID => $task) { 
                    $this->UpdateServers();
                    foreach ($servers as $server) {
                        if ( $this->assignTask( $taskID, $server["Type"], $server["ID"] ) === true ) {
                            unset( $remainingTasks[$taskID] );
                            $assignedTasks[] = $taskID;

                            // Delete assigned tasks from tasks[] and set them to runningTasks[]
                            $this->addRunningTask( $this->getTask( $taskID), $taskID );
                            $this->deleteTask( $taskID );

                            break;
                        }
                    }
                }
                break;

            case "ServerEdgeCloud":
                // Tasks are assigned on a "First-come, First-served" basis
                // First typical-servers then Edge-servers then Cloud-servers
                $servers = $this->getAllServers();
                $servers = $this->sortServers_ServerEdgeCloud( $servers );
                foreach ($tasks as $taskID => $task) { 
                    $this->UpdateServers();
                    foreach ($servers as $server) {
                        if ( $this->assignTask( $taskID, $server["Type"], $server["ID"] ) === true ) {
                            unset( $remainingTasks[$taskID] );
                            $assignedTasks[] = $taskID;

                            // Delete assigned tasks from tasks[] and set them to runningTasks[]
                            $this->addRunningTask( $this->getTask( $taskID), $taskID );
                            $this->deleteTask( $taskID );

                            break;
                        }
                    }
                }
                break;

            case "ServerCloudEdge":
                // Tasks are assigned on a "First-come, First-served" basis
                // First typical-servers then Cloud-servers then Edge-servers
                $servers = $this->getAllServers();
                $servers = $this->sortServers_ServerCloudEdge( $servers );
                foreach ($tasks as $taskID => $task) { 
                    $this->UpdateServers();
                    foreach ($servers as $server) {
                        if ( $this->assignTask( $taskID, $server["Type"], $server["ID"] ) === true ) {
                            unset( $remainingTasks[$taskID] );
                            $assignedTasks[] = $taskID;

                            // Delete assigned tasks from tasks[] and set them to runningTasks[]
                            $this->addRunningTask( $this->getTask( $taskID), $taskID );
                            $this->deleteTask( $taskID );

                            break;
                        }
                    }
                }
                break;

            default:
                return false;
                break;
        }

        return [
            "assignedTasks" => $assignedTasks,
            "remainingTasks" => $remainingTasks
        ];
    }

    // Update servers by Terminating executed tasks
    public function UpdateServers()
    {
        foreach ($this->getAllServers() as $server) {
            foreach ($server["Object"]->getActiveTasks() as $taskID) {
                $TD = $this->getRunningTaskDetails($taskID);

                //Terminate if Deadline has passed || Terminate if Task is done
                if( ($TD["Deadline"] < time()) || ($TD["ExecutionTime"] + $TD["Timestamp"] < time()) )
                {
                    $server["Object"]->terminateTask( $taskID, $this->getRunningTask($taskID) );
                    $this->deleteRunningTask( $taskID );
                    $this->incrementTotalTerminatedTasks();
                }
            }
        }
    }

    // Simulation starter: $simulationTime => in seconds
    public function startSimulation(
            $simulationTime = 30,
            $initialTasks = true,
            $autoGenerateTasks = true,
            $randomNumberOfTasks = true,
            $constantNumberOfTasks = 0,
            $minTaskGenration = 1,
            $maxTaskGenration = 50,
            $possibilityOfGeneration = 50
        )
    {
        $this->printLogo();
        $this->printSeperator();
        $this->printInfo();
        $this->printSeperator();

        $flag = false;
        $running = 0;
        $this->printLog( "Simulation started at " . date(DATE_RFC2822) . " (" . time() . ") for " . $simulationTime . " seconds."  );
        $startTime = time();
        $endTime = $startTime + $simulationTime;

        $this->printLog( "Assign method is : " . $this->getAssignMethod() );

        while (time() < $endTime) {

            // Update servers, assign tasks, etc.
            
            $this->UpdateServers();

            // Generate initial Tasks if $initialTasks is true
            if ( $initialTasks ) {
                $this->generateRandomTasks( ($randomNumberOfTasks) ? mt_rand( $minTaskGenration, $maxTaskGenration ) : $constantNumberOfTasks );
            }

            // Generate random Task during simulatin if $autoGenerateTasks is true
            if ( $autoGenerateTasks && $flag ) {
                if ( mt_rand(0,99) >= $possibilityOfGeneration ) {
                    $this->generateRandomTasks( ($randomNumberOfTasks) ? mt_rand( $minTaskGenration, $maxTaskGenration ) : $constantNumberOfTasks );
                }
            }
            $flag = true;

            $result = $this->assignAllTasks();
            $running += count( $result["assignedTasks"] );

            $this->printLog( "At " . date(DATE_RFC2822) . " (" . time() . ") " . time() - $startTime . " seconds passed, \"" .
                            $this->getTotalTerminatedTasks() . "\" Total terminated Task(s) so far, \"" .
                            $running . "\" Task(s) running at this point, \"" . count( $result["remainingTasks"] ) .
                            "\" Task(s) still waiting."   
            );

            usleep(100000); // Sleep for 100 milliseconds
        }
    }
}


?>