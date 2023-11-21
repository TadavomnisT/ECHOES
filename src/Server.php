<?php

/*

--------------- ECHOES Abstract Server Implementation ---------------  

A Server entity in ECHOES Simulator contains following attrebutes:

    Type                => Server type: Edge/Cloud/Default
    Cores               => Number of CPU cores
    MIPS                => CPU Mega Instructions Per Second
    RAM                 => Server memory in MB
    AvailableRAM        => Server available memory in MB
    Storage             => Server storage in MB
    AvailableStorage    => Server available storage in MB
    StorageSpeed        => Server storage speed in MBps (Megabytes per second)
    Average_Access_Time => Average Access Time for server in milliseconds (Similar to Latency)
    Latency             => Time delay for data to transmission between the server and connected devices in milliseconds
    Network_Bandwidth   => Server Netwrok Bandwidth in Mbps (megabits per second)
    Energy_Efficiency   => Power Usage Effectiveness (PUE) or Energy Efficiency Ratio (EER)
    Redundancy_Level    => The level of redundancy or fault tolerance
    Availability        => Is server available at the moment: True/False

Example:

    +-----------------------------------+
    |         Server Attributes         |
    +-----------------------------------+
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

    private $Type;                  // Server type: Edge/Cloud/Default
    private $Cores;                 // Number of CPU cores
    private $MIPS;                  // CPU Mega Instructions Per Second
    private $RAM;                   // Server memory in MB
    private $AvailableRAM;          // Server available memory in MB
    private $Storage;               // Server storage in MB
    private $AvailableStorage;      // Server available storage in MB
    private $StorageSpeed;          // Server storage speed in MBps (Megabytes per second)
    private $Average_Access_Time;   // Average Access Time for server in milliseconds (Similar to Latency)
    private $Latency;               // Time delay for data to transmission between the server and connected devices in milliseconds
    private $Network_Bandwidth;     // Server Netwrok Bandwidth in Mbps (megabits per second)
    private $Energy_Efficiency;     // Power Usage Effectiveness (PUE) or Energy Efficiency Ratio (EER)
    private $Redundancy_Level;      // The level of redundancy or fault tolerance
    private $Availability;          // Is server available at the moment: True/False
    

    public function __construct(
        string  $Type, 
        int     $Cores, 
        int     $MIPS, 
        int     $RAM, 
        int     $AvailableRAM, 
        int     $Storage, 
        int     $AvailableStorage, 
        int     $StorageSpeed, 
        int     $Average_Access_Time, 
        int     $Latency, 
        int     $Network_Bandwidth, 
        float   $Energy_Efficiency, 
        int     $Redundancy_Level, 
        bool    $Availability
    ) {
        $this->Type = $Type;
        $this->Cores = $Cores;
        $this->MIPS = $MIPS;
        $this->RAM = $RAM;
        $this->AvailableRAM = $AvailableRAM;
        $this->Storage = $Storage;
        $this->AvailableStorage = $AvailableStorage;
        $this->StorageSpeed = $StorageSpeed;
        $this->Average_Access_Time = $Average_Access_Time;
        $this->Latency = $Latency;
        $this->Network_Bandwidth = $Network_Bandwidth;
        $this->Energy_Efficiency = $Energy_Efficiency;
        $this->Redundancy_Level = $Redundancy_Level;
        $this->Availability = $Availability;
    }

    public function getType() {
        return $this->Type;
    }
    public function setType( string $Type = "default" ) {
        if( $Type !== "default" && $Type !== "edge" && $Type !== "cloud"  )
        {
            throw new Exception("Unknown type\"" . $Type . "\"." , 1);
            return FALSE;
        }
        $this->Type = $Type;
        return true;
    }

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

    public function getAvailableRAM()
    {
        return $this->AvailableRAM;
    }
    public function setAvailableRAM(int $AvailableRAM)
    {
        if ($AvailableRAM < 0) {
            throw new Exception("Invalid number of available RAM: " . $AvailableRAM, 1);
            return false;
        }
        $this->AvailableRAM = $AvailableRAM;
        return true;
    }

    public function getStorage()
    {
        return $this->Storage;
    }
    public function setStorage(int $Storage)
    {
        if ($Storage <= 0) {
            throw new Exception("Invalid storage capacity: " . $Storage, 1);
            return false;
        }
        $this->Storage = $Storage;
        return true;
    }

    public function getAvailableStorage()
    {
        return $this->AvailableStorage;
    }
    public function setAvailableStorage(int $AvailableStorage)
    {
        if ($AvailableStorage < 0) {
            throw new Exception("Invalid number of available storage: " . $AvailableStorage, 1);
            return false;
        }
        $this->AvailableStorage = $AvailableStorage;
        return true;
    }

    public function getStorageSpeed()
    {
        return $this->StorageSpeed;
    }
    public function setStorageSpeed(int $StorageSpeed)
    {
        if ($StorageSpeed <= 0) {
            throw new Exception("Invalid storage speed: " . $StorageSpeed, 1);
            return false;
        }
        $this->StorageSpeed = $StorageSpeed;
        return true;
    }

    public function getAverageAccessTime()
    {
        return $this->Average_Access_Time;
    }
    public function setAverageAccessTime(int $Average_Access_Time)
    {
        if ($Average_Access_Time <= 0) {
            throw new Exception("Invalid average access time: " . $Average_Access_Time
            return false;
        }
        $this->Average_Access_Time = $Average_Access_Time;
        return true;
    }

    public function getLatency()
    {
        return $this->Latency;
    }
    public function setLatency(int $Latency)
    {
        if ($Latency <= 0) {
            throw new Exception("Invalid latency: " . $Latency, 1);
            return false;
        }
        $this->Latency = $Latency;
        return true;
    }

    public function getNetworkBandwidth()
    {
        return $this->Network_Bandwidth;
    }
    public function setNetworkBandwidth(int $Network_Bandwidth)
    {
        if ($Network_Bandwidth <= 0) {
            throw new Exception("Invalid network bandwidth: " . $Network_Bandwidth, 1);
            return false;
        }
        $this->Network_Bandwidth = $Network_Bandwidth;
        return true;
    }

    public function getEnergyEfficiency()
    {
        return $this->Energy_Efficiency;
    }
    public function setEnergyEfficiency(float $Energy_Efficiency)
    {
        if ($Energy_Efficiency <= 0.0) {
            throw new Exception("Invalid energy efficiency: " . $Energy_Efficiency, 1);
            return false;
        }
        $this->Energy_Efficiency = $Energy_Efficiency;
        return true;
    }

    public function getRedundancyLevel()
    {
        return $this->Redundancy_Level;
    }
    public function setRedundancyLevel(int $Redundancy_Level)
    {
        if ($Redundancy_Level < 0) {
            throw new Exception("Invalid redundancy level: " . $Redundancy_Level, 1);
            return false;
        }
        $this->Redundancy_Level = $Redundancy_Level;
        return true;
    }

    public function getAvailability()
    {
        return $this->Availability;
    }
    public function setAvailability(bool $Availability)
    {
        if ($Availability !== TRUE || $Availability !== FALSE) {
            throw new Exception("Invalid availability: " . $Availability, 1);
            return false;
        }
        $this->Availability = $Availability;
        return true;
    }
}

?>