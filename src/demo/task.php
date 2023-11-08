<?php

class Task
{
    private $Priority; //in percent
    private $RequiredMIPS; //CPU Mega Instructions Per Second
    private $RequiredRAM; //in MB
    private $RequiredStorage; //in MB
    private $TimeStamp; //in UNIX-timestamp micro-seconds

    public function __construct(int $Priority, int $RequiredMIPS, int $RequiredRAM, int $RequiredStorage, int $TimeStamp) {
        $this->Priority        = $Priority;
        $this->RequiredMIPS    = $RequiredMIPS;
        $this->RequiredRAM     = $RequiredRAM;
        $this->RequiredStorage = $RequiredStorage;
        $this->TimeStamp       = $TimeStamp;
    }
    
    public function getPriority() {
        return $this->Priority;
    }
    public function getMIPS() {
        return $this->RequiredMIPS;
    }
    public function getRAM() {
        return $this->RequiredRAM;
    }
    public function getStorage() {
        return $this->RequiredStorage;
    }
    public function getTimeStamp() {
        return $this->TimeStamp;
    }

  
    public function setPriority( int $Priority ) {
        $this->Priority = $Priority;
        return true;
    }
    public function setMIPS( int $RequiredMIPS ) {
        $this->RequiredMIPS = $RequiredMIPS;
        return true;
    }
    public function setRAM( int $RequiredRAM ) {
        $this->RequiredRAM = $RequiredRAM;
        return true;
    }
    public function setStorage( int $RequiredStorage ) {
        $this->RequiredStorage = $RequiredStorage;
        return true;
    }
    public function setTimeStamp( int $TimeStamp ) {
        $this->TimeStamp = $TimeStamp;
        return true;
    }
  
}


?>