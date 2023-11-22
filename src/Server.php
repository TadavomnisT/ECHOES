<?php

/*

--------------- ECHOES Abstract Server Implementation ---------------  

A Server entity in ECHOESimulator contains following attributes:

    Name                => Server name: e.g "E_Server_GNULinux64"
    Type                => Server type: Edge/Cloud/Default
    Cores               => Number of CPU cores
    MIPS                => CPU Mega Instructions Per Second
    RAM                 => Server memory in MB
    AvailableRAM        => Server available memory in MB
    Storage             => Server storage in MB
    AvailableStorage    => Server available storage in MB
    StorageSpeed        => Server storage speed in MBps (Megabytes per second)
    AverageAccessTime   => Average Access Time for server in milliseconds (Similar to Latency)
    Latency             => Time delay for data to transmission between the server and connected devices in milliseconds
    NetworkBandwidth    => Server Netwrok Bandwidth in Mbps (megabits per second)
    EnergyEfficiency    => Power Usage Effectiveness (PUE) or Energy Efficiency Ratio (EER)
    RedundancyLevel     => The level of redundancy or fault tolerance
    Availability        => Is server available at the moment: True/False

Example:

    +-----------------------------------+
    |         Server Attributes         |
    +-----------------------------------+
    | Name:                 Server_1    |
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
    +-----------------------------------+

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

class Server {

    private $Name;              // Server name: e.g "E_Server_GNULinux64"
    private $Type;              // Server type: Edge/Cloud/Default
    private $Cores;             // Number of CPU cores
    private $MIPS;              // CPU Mega Instructions Per Second
    private $RAM;               // Server memory in MB
    private $AvailableRAM;      // Server available memory in MB
    private $Storage;           // Server storage in MB
    private $AvailableStorage;  // Server available storage in MB
    private $StorageSpeed;      // Server storage speed in MBps (Megabytes per second)
    private $AverageAccessTime; // Average Access Time for server in milliseconds (Similar to Latency)
    private $Latency;           // Time delay for data to transmission between the server and connected devices in milliseconds
    private $NetworkBandwidth;  // Server Netwrok Bandwidth in Mbps (megabits per second)
    private $EnergyEfficiency;  // Power Usage Effectiveness (PUE) or Energy Efficiency Ratio (EER)
    private $RedundancyLevel;   // The level of redundancy or fault tolerance
    private $Availability;      // Is server available at the moment: True/False
    

    public function __construct(
        string  $Name, 
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
        bool    $Availability
    ) {
        $this->Name = $Name;
        $this->Type = $Type;
        $this->Cores = $Cores;
        $this->MIPS = $MIPS;
        $this->RAM = $RAM;
        $this->AvailableRAM = $AvailableRAM;
        $this->Storage = $Storage;
        $this->AvailableStorage = $AvailableStorage;
        $this->StorageSpeed = $StorageSpeed;
        $this->AverageAccessTime = $AverageAccessTime;
        $this->Latency = $Latency;
        $this->NetworkBandwidth = $NetworkBandwidth;
        $this->EnergyEfficiency = $EnergyEfficiency;
        $this->RedundancyLevel = $RedundancyLevel;
        $this->Availability = $Availability;
    }

    // Getter and Setter for Name
    public function getName() {
        return $this->Name;
    }
    public function setName( string $Name ) {
        $this->Name = $Name;
        return true;
    }

    // Getter and Setter for Type
    public function getType() {
        return $this->Type;
    }
    public function setType( string $Type = "Default" ) {
        if( $Type !== "Default" && $Type !== "Edge" && $Type !== "Cloud"  )
        {
            throw new Exception("Unknown type \"" . $Type . "\"." , 1);
            return FALSE;
        }
        $this->Type = $Type;
        return true;
    }

    // Getter and Setter for Cores
    public function getCores() {
        return $this->Cores;
    }
    public function setCores( int $Cores ) {
        if( $Cores <= 0 )
        {
            throw new Exception("Invalid number of CPU cores \"" . $Cores . "\"." , 1);
            return FALSE;
        }
        $this->Cores = $Cores;
        return true;
    }

    // Getter and Setter for MIPS
    public function getMIPS() {
        return $this->MIPS;
    }
    public function setMIPS( int $MIPS ) {
        if( $MIPS <= 0 )
        {
            throw new Exception("Invalid number of CPU MIPS \"" . $Cores . "\"." , 1);
            return FALSE;
        }
        $this->MIPS = $MIPS;
        return true;
    }

    // Getter and Setter for RAM
    public function getRAM() {
        return $this->RAM;
    }
    public function setRAM( int $RAM ) {
        if( $RAM <= 0 )
        {
            throw new Exception("Invalid number of server memory \"" . $Cores . "\"." , 1);
            return FALSE;
        }
        $this->RAM = $RAM;
        return true;
    }

    // Getter and Setter for AvailableRAM
    public function getAvailableRAM()
    {
        return $this->AvailableRAM;
    }
    public function setAvailableRAM(int $AvailableRAM)
    {
        if ($AvailableRAM < 0) {
            throw new Exception("Invalid number of available RAM: \"" . $AvailableRAM . "\"." , 1);
            return false;
        }
        $this->AvailableRAM = $AvailableRAM;
        return true;
    }

    // Getter and Setter for Storage
    public function getStorage()
    {
        return $this->Storage;
    }
    public function setStorage(int $Storage)
    {
        if ($Storage <= 0) {
            throw new Exception("Invalid storage capacity: \"" . $Storage . "\"." , 1);
            return false;
        }
        $this->Storage = $Storage;
        return true;
    }

    // Getter and Setter for AvailableStorage
    public function getAvailableStorage()
    {
        return $this->AvailableStorage;
    }
    public function setAvailableStorage(int $AvailableStorage)
    {
        if ($AvailableStorage < 0) {
            throw new Exception("Invalid number of available storage: \"" . $AvailableStorage . "\"." , 1);
            return false;
        }
        $this->AvailableStorage = $AvailableStorage;
        return true;
    }

    // Getter and Setter for StorageSpeed
    public function getStorageSpeed()
    {
        return $this->StorageSpeed;
    }
    public function setStorageSpeed(int $StorageSpeed)
    {
        if ($StorageSpeed <= 0) {
            throw new Exception("Invalid storage speed: \"" . $StorageSpeed . "\"." , 1);
            return false;
        }
        $this->StorageSpeed = $StorageSpeed;
        return true;
    }

    // Getter and Setter for AverageAccessTime
    public function getAverageAccessTime()
    {
        return $this->AverageAccessTime;
    }
    public function setAverageAccessTime(int $AverageAccessTime)
    {
        if ($AverageAccessTime <= 0) {
            throw new Exception("Invalid average access time: \"" . $AverageAccessTime . "\"." , 1);
            return false;
        }
        $this->AverageAccessTime = $AverageAccessTime;
        return true;
    }

    // Getter and Setter for Latency
    public function getLatency()
    {
        return $this->Latency;
    }
    public function setLatency(int $Latency)
    {
        if ($Latency <= 0) {
            throw new Exception("Invalid latency: \"" . $Latency . "\"." , 1);
            return false;
        }
        $this->Latency = $Latency;
        return true;
    }

    // Getter and Setter for NetworkBandwidth
    public function getNetworkBandwidth()
    {
        return $this->NetworkBandwidth;
    }
    public function setNetworkBandwidth(int $NetworkBandwidth)
    {
        if ($NetworkBandwidth <= 0) {
            throw new Exception("Invalid network bandwidth: \"" . $NetworkBandwidth . "\"." , 1);
            return false;
        }
        $this->NetworkBandwidth = $NetworkBandwidth;
        return true;
    }

    // Getter and Setter for EnergyEfficiency
    public function getEnergyEfficiency()
    {
        return $this->EnergyEfficiency;
    }
    public function setEnergyEfficiency(float $EnergyEfficiency)
    {
        if ($EnergyEfficiency <= 0.0) {
            throw new Exception("Invalid energy efficiency: \"" . $EnergyEfficiency . "\"." , 1);
            return false;
        }
        $this->EnergyEfficiency = $EnergyEfficiency;
        return true;
    }

    // Getter and Setter for RedundancyLevel
    public function getRedundancyLevel()
    {
        return $this->RedundancyLevel;
    }
    public function setRedundancyLevel(int $RedundancyLevel)
    {
        if ($RedundancyLevel < 0) {
            throw new Exception("Invalid redundancy level: \"" . $RedundancyLevel . "\"." , 1);
            return false;
        }
        $this->RedundancyLevel = $RedundancyLevel;
        return true;
    }

    // Getter and Setter for Availability
    public function getAvailability()
    {
        return $this->Availability;
    }
    public function setAvailability(bool $Availability)
    {
        if ($Availability !== TRUE || $Availability !== FALSE) {
            throw new Exception("Invalid availability: \"" . $Availability . "\"." , 1);
            return false;
        }
        $this->Availability = $Availability;
        return true;
    }
}

?>