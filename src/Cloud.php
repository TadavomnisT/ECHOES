<?php

/*

--------------- ECHOES Cloud-Server Implementation ---------------  

A Cloud-server is a server that is located in cloud data-centers (away from the user).
As the code, it's an implementation which extends "Server.php" class.

                ------------------
                |    Server      |
                ------------------
                  |           |
           ---------------   ----------------      
           | Edge-server |   | Cloud-server |
           ---------------   ----------------    


A Cloud-Server entity in ECHOESimulator contains following attributes:

    Name                => Cloud-Server name: e.g "C_Server_GNULinux64"
    Type                => Server type: Cloud
    Cores               => Number of CPU cores
    MIPS                => CPU Mega Instructions Per Second
    RAM                 => Cloud-Server memory in MB
    AvailableRAM        => Cloud-Server available memory in MB
    Storage             => Cloud-Server storage in MB
    AvailableStorage    => Cloud-Server available storage in MB
    StorageSpeed        => Cloud-Server storage speed in MBps (Megabytes per second)
    AverageAccessTime   => Average Access Time for Cloud-Server in milliseconds (Similar to Latency)
    Latency             => Time delay for data to transmission between the Cloud-Server and connected devices in milliseconds
    NetworkBandwidth    => Cloud-Server Netwrok Bandwidth in Mbps (megabits per second)
    EnergyEfficiency    => Power Usage Effectiveness (PUE) or Energy Efficiency Ratio (EER)
    RedundancyLevel     => The level of redundancy or fault tolerance
    Availability        => Is Cloud-Server available at the moment: True/False
    ActiveTasks         => Current active tasks on Cloud-server
    Location            => Locatation of Cloud-server
    Temperature         => The temperature of Cloud-server (°C)

Example:

    +-----------------------------------+
    |      Cloud-server Attributes      |
    +-----------------------------------+
    | Name:                 E_Server64  |
    | Type:                 Cloud       |
    | Cores:                8           |
    | MIPS:                 16000       |
    | RAM:                  32768 MB    |
    | Available RAM:        28672 MB    |
    | Storage:              1048576 MB  |
    | Available Storage:    786432 MB   |
    | Storage Speed:        10 MBps     |
    | Avg. Access Time:     10 ms       |
    | Latency:              12 ms       |
    | Network Bandwidth:    1000 Mbps   |
    | Energy Efficiency:    1.5         |
    | Redundancy Level:     98          |
    | Availability:         True        |
    | ActiveTasks :         [T1,T2]     |
    | Location:             GEOL_356    |
    | Temperature:          24          |
    +-----------------------------------+

Usage:

    $cloudServer = new Cloud("E_Server_12", "Cloud", 4, 2000, 8192, 8192, 500000, 500000, 10, 42, 5, 1000, 0.9, 2, true, "GEOL_14", 30);

    echo $cloudServer->getType(); // Output: Cloud
    echo $cloudServer->getTemperature(); // Output: 30

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


require_once "Server.php";

class Cloud extends Server
{
    private $Type;
    private $Location;
    private $Temperature;

    public function __construct(
        string  $Name, 
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
        int     $Temperature
    ) {
        $this->Type = "Cloud";
        parent::__construct(
            $Name, 
            $this->Type,
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
        $this->setLocation( $Location );
        $this->setTemperature( $Temperature );
    }

    // Getter and Setter for Location
    public function getLocation()
    {
        return $this->Location;
    }
    public function setLocation(string $Location)
    {
        $this->Location = $Location;
    }

    // Getter and Setter for Temperature
    public function getTemperature()
    {
        return $this->Temperature;
    }
    public function setTemperature(int $Temperature)
    {
        $this->Temperature = $Temperature;
    }
}


?>