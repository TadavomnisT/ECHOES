<?php


require_once "Server.php";
require_once "Cloud.php";
require_once "Edge.php";
require_once "Task.php";

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
defined("MAX_TASK_ESTIMATE_EXECUTION_TIME_1") or define("MAX_TASK_ESTIMATE_EXECUTION_TIME_1", 18000);
defined("MAX_TASK_ESTIMATE_EXECUTION_TIME_2") or define("MAX_TASK_ESTIMATE_EXECUTION_TIME_2", 86400);
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

class Simulator
{

    // List of simulator's entities
    private $allServers;
    private $servers;
    private $cloudServers;
    private $edgeServers;
    private $tasks;

    private $assignMethod;

    // Constructor
    public function __construct( $assignMethod = "Default" ) {

        $this->allServers    = [];
        $this->servers          = [];
        $this->cloudServers     = [];
        $this->edgeServers      = [];
        $this->tasks            = [];

        $this->setAssignMethod( $assignMethod );

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

    // Get simulator tasks at the moment
    public function getTasks()
    {
        return $this->tasks;
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

    // Get details of a Task
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

    // Get Server status
    public function getServerStatus( $server )
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
        if(
            $assignMethod !== "Default"     &&
            $assignMethod !== "Random"      && 
            $assignMethod !== "Knapsack"    &&
            $assignMethod !== "EdgeFirst"   &&
            $assignMethod !== "CloudFirst"
        )
        {
            throw new Exception("Invalid type for assignMethod \"" . $assignMethod . "\".", 1);
            return false;
        }
        $this->assignMethod = $assignMethod;
        return true;
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
    
    // Min-Max normalization (Rescaling) in range [0,1]
    public function min_max_0_1( $x, $min_x, $max_x )
    {
        return ($x - $min_x) / ($max_x - $min_x);
    }

    // Printing logs
    public function printLog( string $message )
    {
        echo "[Log] " . $message . PHP_EOL;
    }

    // Assign a Task to a Server
    public function assignTask( $taskID, $serverType, $serverID, $returnError = False )
    {
        if ($serverType != "Edge" && $serverType != "Cloud" && $serverType != "Server") {
            throw new Exception("Invalid server-type : \"" . $serverType . "\"." , 1);
            return false;
        }
        if (empty($this->getTasks()[$taskID])) {
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
        $task = $this->getTasks()[$taskID];

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
    public function assignAllTasks( $deleteTasksAfterAssigning = true )
    {
        $tasks = $this->getTasks();
        $servers = $this->getAllServers();
        $assignedTasks = [];
        $remainingTasks = array_keys( $tasks );
        switch ( $this->getAssignMethod() ) {
            case "Default":
                // Tasks are assigned on a "First-come, First-served" basis
                foreach ($tasks as $taskID => $task) { 
                    $this->UpdateServers();
                    foreach ($servers as $server) {
                        if ( $this->assignTask( $taskID, $server["Type"], $server["ID"] ) === true ) {
                            unset( $remainingTasks[$taskID] );
                            $assignedTasks[] = $taskID;
                            break;
                        }
                    }
                }
                break;
            case "Random":
                # code...
                break;

            case "Knapsack":
                # code...
                break;

            case "EdgeFirst":
                # code...
                break;

            case "CloudFirst":
                # code...
                break;
            
            default:
                return false;
                break;
        }

        // Delete assigned tasks
        if( $deleteTasksAfterAssigning )
        {
            foreach ($assignedTasks as $taskID) {
                $this->deleteTask( $taskID );
            }
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
                $TD = $this->getTaskDetails($taskID);

                //Terminate if Deadline has passed
                if( $TD["Deadline"] < time() )
                {
                    $server["Object"]->terminateTask( $taskID );
                }

                //Terminate if Task is done
                if( $TD["ExecutionTime"] + $TD["Timestamp"] < time() )
                {
                    $server["Object"]->terminateTask( $taskID );
                }
            }
        }
    }

    // Simulation starter: $simulationTime => in seconds
    public function startSimulation( $simulationTime = 30 )
    {
        $this->printLog( "Simulation started at " . date(DATE_RFC2822) . " (" . time() . ") for " . $simulationTime . " seconds."  );
        $startTime = time();
        $endTime = $startTime + $simulationTime;

        while (time() < $endTime) {

            // Update servers, assign tasks, etc.
            
            $this->UpdateServers();
            $result = $this->assignAllTasks();
            var_dump( $result );die;
            
        
            

            usleep(100000); // Sleep for 100 milliseconds
        }
    }
}


?>