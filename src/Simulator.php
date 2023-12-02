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
    public function getTaskDetails( $ID )
    {
        return [
            "Name"                  => $this->tasks[ $ID ]->getName() ,
            "Priority"              => $this->tasks[ $ID ]->getPriority() ,
            "RequiredCores"         => $this->tasks[ $ID ]->getRequiredCores() ,
            "RequiredMIPSPerCore"   => $this->tasks[ $ID ]->getRequiredMIPSPerCore() ,
            "RequiredRAM"           => $this->tasks[ $ID ]->getRequiredRAM() ,
            "RequiredStorage"       => $this->tasks[ $ID ]->getRequiredStorage() ,
            "Timestamp"             => $this->tasks[ $ID ]->getTimestamp() ,
            "TimestampMS"           => $this->tasks[ $ID ]->getTimestampMS() ,
            "RequiredDataDownload"  => $this->tasks[ $ID ]->getRequiredDataDownload() ,
            "RequiredDataUpload"    => $this->tasks[ $ID ]->getRequiredDataUpload() ,
            "Deadline"              => $this->tasks[ $ID ]->getDeadline() ,
            "SecurityLevel"         => $this->tasks[ $ID ]->getSecurityLevel() ,
            "CommunicationType"     => $this->tasks[ $ID ]->getCommunicationType(),
            "ExecutionTime"         => $this->tasks[ $ID ]->getExecutionTime() 
        ];
    }

    // Get Edge-server status
    public function getEdgeServerStatus( $ID )
    {
        return [
            "Name"              => $this->edgeServers[ $ID ]->getName(),
            "Type"              => $this->edgeServers[ $ID ]->getType(),
            "Cores"             => $this->edgeServers[ $ID ]->getCores(),
            "MIPS"              => $this->edgeServers[ $ID ]->getMIPS(),
            "RAM"               => $this->edgeServers[ $ID ]->getRAM(),
            "AvailableRAM"      => $this->edgeServers[ $ID ]->getAvailableRAM(),
            "Storage"           => $this->edgeServers[ $ID ]->getStorage(),
            "AvailableStorage"  => $this->edgeServers[ $ID ]->getAvailableStorage(),
            "StorageSpeed"      => $this->edgeServers[ $ID ]->getStorageSpeed(),
            "AverageAccessTime" => $this->edgeServers[ $ID ]->getAverageAccessTime(),
            "Latency"           => $this->edgeServers[ $ID ]->getLatency(),
            "NetworkBandwidth"  => $this->edgeServers[ $ID ]->getNetworkBandwidth(),
            "EnergyEfficiency"  => $this->edgeServers[ $ID ]->getEnergyEfficiency(),
            "RedundancyLevel"   => $this->edgeServers[ $ID ]->getRedundancyLevel(),
            "Availability"      => $this->edgeServers[ $ID ]->getAvailability(),
            "ActiveTasks"       => $this->edgeServers[ $ID ]->getActiveTasks(),
            "Location"          => $this->edgeServers[ $ID ]->getLocation(),
            "Temperature"       => $this->edgeServers[ $ID ]->getTemperature()
        ];
    }

    // Get Cloud-server status
    public function getCloudServerStatus( $ID )
    {
        return [
            "Name"              => $this->cloudServers[ $ID ]->getName(),
            "Type"              => $this->cloudServers[ $ID ]->getType(),
            "Cores"             => $this->cloudServers[ $ID ]->getCores(),
            "MIPS"              => $this->cloudServers[ $ID ]->getMIPS(),
            "RAM"               => $this->cloudServers[ $ID ]->getRAM(),
            "AvailableRAM"      => $this->cloudServers[ $ID ]->getAvailableRAM(),
            "Storage"           => $this->cloudServers[ $ID ]->getStorage(),
            "AvailableStorage"  => $this->cloudServers[ $ID ]->getAvailableStorage(),
            "StorageSpeed"      => $this->cloudServers[ $ID ]->getStorageSpeed(),
            "AverageAccessTime" => $this->cloudServers[ $ID ]->getAverageAccessTime(),
            "Latency"           => $this->cloudServers[ $ID ]->getLatency(),
            "NetworkBandwidth"  => $this->cloudServers[ $ID ]->getNetworkBandwidth(),
            "EnergyEfficiency"  => $this->cloudServers[ $ID ]->getEnergyEfficiency(),
            "RedundancyLevel"   => $this->cloudServers[ $ID ]->getRedundancyLevel(),
            "Availability"      => $this->cloudServers[ $ID ]->getAvailability(),
            "ActiveTasks"       => $this->cloudServers[ $ID ]->getActiveTasks(),
            "Location"          => $this->cloudServers[ $ID ]->getLocation(),
            "Temperature"       => $this->cloudServers[ $ID ]->getTemperature()
        ];
    }

    // Get Server status
    public function getServerStatus( $ID )
    {
        return [
            "Name"              => $this->servers[ $ID ]->getName(),
            "Type"              => $this->servers[ $ID ]->getType(),
            "Cores"             => $this->servers[ $ID ]->getCores(),
            "MIPS"              => $this->servers[ $ID ]->getMIPS(),
            "RAM"               => $this->servers[ $ID ]->getRAM(),
            "AvailableRAM"      => $this->servers[ $ID ]->getAvailableRAM(),
            "Storage"           => $this->servers[ $ID ]->getStorage(),
            "AvailableStorage"  => $this->servers[ $ID ]->getAvailableStorage(),
            "StorageSpeed"      => $this->servers[ $ID ]->getStorageSpeed(),
            "AverageAccessTime" => $this->servers[ $ID ]->getAverageAccessTime(),
            "Latency"           => $this->servers[ $ID ]->getLatency(),
            "NetworkBandwidth"  => $this->servers[ $ID ]->getNetworkBandwidth(),
            "EnergyEfficiency"  => $this->servers[ $ID ]->getEnergyEfficiency(),
            "RedundancyLevel"   => $this->servers[ $ID ]->getRedundancyLevel(),
            "Availability"      => $this->servers[ $ID ]->getAvailability(),
            "ActiveTasks"       => $this->servers[ $ID ]->getActiveTasks()
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
            $ExecutionTime = (mt_rand(0,9)>6) ? mt_rand(5, 86400) : mt_rand(5, 18000);

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


        $server->addTask( $taskID );
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

    // Update servers "ActiveTasks"
    public function UpdateServers()
    {
        # code...
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
                if(!$result)
                {
                    var_dump( $task , $this->getEdgeServers( 0 ) );
                } 
                var_dump( $result );
            }
            

            usleep(100000); // Sleep for 100 milliseconds
        }
    }
}


?>