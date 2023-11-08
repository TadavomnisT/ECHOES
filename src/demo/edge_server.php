<?php

class Edge
{
    private $Cores;
    private $MIPS; //CPU Mega Instructions Per Second
    private $RAM; //in MB
    private $Storage; //in MB
    private $Average_Access_Time; //in micro-seconds

    public function __construct(int $Cores, int $MIPS, int $RAM, int $Storage, int $Average_Access_Time) {
        $this->Cores   = $Cores;
        $this->MIPS    = $MIPS;
        $this->RAM     = $RAM;
        $this->Storage = $Storage;
        $this->Average_Access_Time = $Average_Access_Time;
    }
    
    public function getCores() {
        return $this->Cores;
    }
    public function getMIPS() {
        return $this->MIPS;
    }
    public function getRAM() {
        return $this->RAM;
    }
    public function getStorage() {
        return $this->Storage;
    }
    public function getAverage_Access_Time() {
        return $this->Average_Access_Time;
    }
    
    public function setCores( int $Cores ) {
        $this->Cores = $Cores;
        return true;
    }
    public function setMIPS( int $MIPS ) {
        $this->MIPS = $MIPS;
        return true;
    }
    public function setRAM( int $RAM ) {
        $this->RAM = $RAM;
        return true;
    }
    public function setStorage( int $Storage ) {
        $this->Storage = $Storage;
        return true;
    }
    public function setAverage_Access_Time( int $Average_Access_Time ) {
        $this->Average_Access_Time = $Average_Access_Time;
        return true;
    }    
}


?>