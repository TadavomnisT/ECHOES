<?php

require_once "Server.php";

class Edge extends Server
{
    private $Location;
    private $Connectivity;

    public function __construct(
        string  $Type, 
        int     $Cores, 
        int     $MIPS, 
        int     $RAM, 
        int     $AvailableRAM, 
        int     $Storage, 
        int     $AvailableStorage, 
        int     $StorageSpeed, 
        int     $AverageAccessTime, 
        int     $Latency, 
        int     $NetworkBandwidth, 
        float   $EnergyEfficiency, 
        int     $RedundancyLevel, 
        bool    $Availability,
        string  $Location,
        int     $Connectivity
    ) {
        parent::__construct(
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
        $this->Location = $Location;
        $this->Connectivity = $Connectivity;
    }

    public function getLocation()
    {
        return $this->Location;
    }

    public function setLocation(string $Location)
    {
        $this->Location = $Location;
    }

    public function getConnectivity()
    {
        return $this->Connectivity;
    }

    public function setConnectivity(int $Connectivity)
    {
        $this->Connectivity = $Connectivity;
    }
}


?>