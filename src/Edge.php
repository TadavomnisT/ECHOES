<?php

/*

--------------- ECHOES Edge-Server Implementation ---------------  

An Edge server is a server that is located near the user device.
As the code, it's an implementation which extends "Server.php" class.

                ------------------
                |    Server      |
                ------------------
                  |           |
           ---------------   ----------------      
           | Edge-server |   | Cloud-server |
           ---------------   ----------------      


An Edge-Server entity in ECHOESimulator contains following attributes:

    Name                => Edge-Server name: e.g "E_Server_GNULinux64"
    Type                => Server type: Edge
    Cores               => Number of CPU cores
    MIPS                => CPU Mega Instructions Per Second
    RAM                 => Edge-Server memory in MB
    AvailableRAM        => Edge-Server available memory in MB
    Storage             => Edge-Server storage in MB
    AvailableStorage    => Edge-Server available storage in MB
    StorageSpeed        => Edge-Server storage speed in MBps (Megabytes per second)
    AverageAccessTime   => Average Access Time for Edge-Server in milliseconds (Similar to Latency)
    Latency             => Time delay for data to transmission between the Edge-Server and connected devices in milliseconds
    NetworkBandwidth    => Edge-Server Netwrok Bandwidth in Mbps (megabits per second)
    EnergyEfficiency    => Power Usage Effectiveness (PUE) or Energy Efficiency Ratio (EER)
    RedundancyLevel     => The level of redundancy or fault tolerance
    Availability        => Is Edge-Server available at the moment: True/False
    ActiveTasks         => Current active tasks on server
    Location            => Locatation of Edge-server
    Temperature         => The temperature of Edge-server (°C)

Example:

    +-----------------------------------+
    |      Edge-server Attributes       |
    +-----------------------------------+
    | Name:                 E_Server64  |
    | Type:                 Edge        |
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

    $edgeServer = new Edge("E_Server_12", "Edge", 4, 2000, 8192, 8192, 500000, 500000, 10, 42, 5, 1000, 0.9, 2, true, "GEOL_14", 30);

    echo $edgeServer->getType(); // Output: Edge
    echo $edgeServer->getTemperature(); // Output: 30

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

class Edge extends Server
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
        $this->Type = "Edge";
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
        $this->Location = $Location;
        $this->Temperature = $Temperature;
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