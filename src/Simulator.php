<?php



require_once "Server.php";
require_once "Cloud.php";
require_once "Edge.php";
require_once "Task.php";

class Simulator
{
    // Instance-Handlers for each class
    private $serverHandler;
    private $cloudHandler;
    private $edgeHandler;
    private $taskHandler;

    // List of simulator's entities
    private $servers;
    private $cloudServers;
    private $edgeServers;
    private $tasks;

    // Constructor
    public function __construct() {
        $this->serverHandler    = new Server();
        $this->cloudHandler     = new Cloud();
        $this->edgeHandler      = new Edge();
        $this->taskHandler      = new Task();

        $servers        = [];
        $cloudServers   = [];
        $edgeServers    = [];
        $tasks          = [];
    }

    // Get simulator servers at the moment
    public function getServers()
    {
        return $this->$servers;
    }

    // Get simulator cloud-servers at the moment
    public function getCloudServers()
    {
        return $this->$cloudServers;
    }

    // Get simulator edge-servers at the moment
    public function getEdgeServers()
    {
        return $this->$edgeServers;
    }

    // Get simulator tasks at the moment
    public function getTasks()
    {
        return $this->$tasks;
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
        end($tasks);
        return key($tasks); 
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
        end($servers);
        return key($servers); 
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
        end($edgeServers);
        return key($edgeServers); 
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
        end($cloudServers);
        return key($cloudServers); 
    }

    public function deleteTask( $ID )
    {
        unset( $this->tasks[ $ID ] );
        return true;
    }

    public function deleteEdgeServer( $ID )
    {
        unset( $this->edgeServers[ $ID ] );
        return true;
    }

    public function deleteCloudServer( $ID )
    {
        unset( $this->cloudServers[ $ID ] );
        return true;
    }

    public function deleteServer( $ID )
    {
        unset( $this->servers[ $ID ] );
        return true;
    }

    public function getTaskDetails( $ID )
    {
        return [
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
            
        ];
    }

    public function getCloudServerStatus( $ID )
    {
        return [
            
        ];
    }

    public function getServerStatus( $ID )
    {
        return [
            
        ];
    }

}


?>