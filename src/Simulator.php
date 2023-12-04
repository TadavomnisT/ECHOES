<?php



require_once "Server.php";
require_once "Cloud.php";
require_once "Edge.php";
require_once "Task.php";

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

        $this->getAllServers    = [];
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
        $ExecutionTime
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
            $ExecutionTime
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
                "ExecutionTime"         => $task->getExecutionTime() 
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
            "ExecutionTime"         => $this->tasks[ $task ]->getExecutionTime() 
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
            $requiredCores = mt_rand(1, 8);
            $requiredMIPSPerCore = mt_rand(200, 800);
            $requiredRAM = mt_rand(128, 1024);
            $requiredStorage = mt_rand(256, 2048);
            $timestamp = time();
            $timestampMS = $this->getTimestampMS();
            $requiredDataDownload = mt_rand(128, 512);
            $requiredDataUpload = mt_rand(64, 256);
            $deadline = $timestamp + mt_rand(3600, 86400); // 1 to 24 hours
            $securityLevel = $securityLevels[array_rand($securityLevels)];
            $communicationType = $communicationTypes[array_rand($communicationTypes)];
            // $ExecutionTime = (mt_rand(0,9)>6) ? mt_rand(5, 86400) : mt_rand(5, 18000);
            $ExecutionTime = NULL;

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
                $ExecutionTime
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
            $cores = mt_rand(4, 16);
            $mips = mt_rand(8000, 32000);
            $ram = mt_rand(8194, 65536); // 8GB to 64GB
            $availableRam = $ram - mt_rand(1024, 4096); // Random available RAM within the range
            $storage = mt_rand(524288, 2097152); // 512GB to 2TB
            $availableStorage = $storage - mt_rand(131072, 524288); // Random available storage within the range
            $storageSpeed = mt_rand(5, 15); // Assume storage speed in ms
            $averageAccessTime = ($serverType === "Edge") ? mt_rand(5, 30) : mt_rand(200, 1500);
            $latency = ($serverType === "Edge") ? $averageAccessTime + mt_rand(-5, 5) : $averageAccessTime + mt_rand(-100, 100);
            $networkBandwidth = mt_rand(500, 2000); // Bandwidth in Mbps
            $energyEfficiency = 1.5; // Assuming a constant value for energy efficiency
            $redundancyLevel = mt_rand(1, 3); // Assuming redundancy levels 1, 2, 3
            $availability = true; // Servers are assumed to be available initially

            $location = $locations[array_rand($locations)];
            $temperature = mt_rand(20, 30);

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
        $taskParameters = $this->getTaskDetails($task);
        $serverParameters = $this->getServerStatus($server);
        if ($server instanceof Server) {
            // Handle Server type
        } elseif ($server instanceof Edge) {
            // Handle Edge type
        } elseif ($server instanceof Cloud) {
            // Handle Cloud type
        } else {
            throw new Exception("Invalid server type : \"" . gettype( $server ) . "\"." , 1);
        }
        var_dump( $taskParameters, $serverParameters );die;
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

        # Need to set E-time
        $this->calculateExecutionTime( $task, $server );

        $server->addTask( $taskID, $task );
        return true;
    }

    // Assign all Tasks using assignMethod
    public function assignAllTasks()
    {
        switch ( $this->getAssignMethod() ) {
            case "Default":
                // Tasks are assigned on a "First-come, First-served" basis
                foreach ($this->getTasks() as $key => $task) { 
                    $this->UpdateServers();
                }
                # code...
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
        return true;
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
            
            foreach ($this->getTasks() as $key => $task) {
                $result = $this->assignTask( $key, "Edge", 0 , true );
                if($result !== True)
                {
                    var_dump( $task , $this->getEdgeServers()[0] );
                    var_dump( $result );
                    die;
                } 
                else var_dump( $result );
            }
            

            usleep(100000); // Sleep for 100 milliseconds
        }
    }
}


?>