<?php



require_once "Server.php";
require_once "Cloud.php";
require_once "Edge.php";
require_once "Task.php";

class Simulator
{

    // List of simulator's entities
    private $servers;
    private $cloudServers;
    private $edgeServers;
    private $tasks;

    private $assignMethod;

    // Constructor
    public function __construct( $assignMethod = "Default" ) {

        $this->servers        = [];
        $this->cloudServers   = [];
        $this->edgeServers    = [];
        $this->tasks          = [];

        $this->setAssignMethod( $assignMethod );

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
        $CommunicationType
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
            $CommunicationType
        );
        end($this->tasks);
        return key($this->tasks); 
    }

    // Deletes a Task
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
        return key($this->servers); 
    }

    // Deletes a Server
    public function deleteServer( $ID )
    {
        unset($this->servers[ $ID ]);
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
        return key($this->edgeServers); 
    }

    // Deletes an Edge-Server
    public function deleteEdgeServer( $ID )
    {
        unset($this->edgeServers[ $ID ]);
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
        return key($this->cloudServers); 
    }

    public function deleteCloudServer( $ID )
    {
        unset( $this->cloudServers[ $ID ] );
        return true;
    }

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
            "CommunicationType"     => $this->tasks[ $ID ]->getCommunicationType() 
        ];
    }

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

    // Get this classes methods
    public function getMethods()
    {
        return get_class_methods( get_class( $this ) ) ;
    }

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
        if( $assignMethod !== "Default" && $assignMethod !== "Random" && $assignMethod !== "Knapsack" )
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
                $communicationType
            );
        }
        return $IDs;
    }

    // Generate random servers
    public function generateRandomServers( int $serverNumbers )
    {
        # code...
    }
    
    // Assign a Task to a Server
    public function assignTask()
    {
        # code...
    }

    // Update servers "ActiveTasks"
    public function UpdateServers()
    {
        # code...
    }

    // Simulation starter: $simulationTime => in seconds
    public function startSimulation( $simulationTime = 30 )
    {
        # code...
    }
}


?>