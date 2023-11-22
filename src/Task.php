<?php


class Task
{
    private $Priority;              // Priority: High/Medium/Low
    private $RequiredCores;         // Required number of CPU cores for execution 
    private $RequiredMIPSPerCore;   // RequiredCPU MIPS(Mega Instructions Per Second) per core
    private $RequiredRAM;           // Required memory in MB
    private $RequiredStorage;       // Required storage in MB
    private $Timestamp;             // Current time in UNIX-timestamp seconds
    private $TimestampMS;           // Current time in UNIX-timestamp milliseconds
    private $RequiredDataDownload;  // The amount of data the task may download in MB
    private $RequiredDataUpload;    // The amount of data the task may upload in MB
    private $Deadline;              // Task deadline in seconds
    private $SecurityLevel;         // Security Level: High/Medium/Low
    private $CommunicationType;     // Communication Type: "synchronous" or "asynchronous"
    
    public function __construct($Priority, $RequiredCores, $RequiredMIPSPerCore, $RequiredRAM, $RequiredStorage, $Timestamp, $TimestampMS, $RequiredDataDownload, $RequiredDataUpload, $Deadline, $SecurityLevel, $CommunicationType) {
        $this->Priority             = $Priority;
        $this->RequiredCores        = $RequiredCores;
        $this->RequiredMIPSPerCore  = $RequiredMIPSPerCore;
        $this->RequiredRAM          = $RequiredRAM;
        $this->RequiredStorage      = $RequiredStorage;
        $this->Timestamp            = $Timestamp;
        $this->TimestampMS          = $TimestampMS;
        $this->RequiredDataDownload = $RequiredDataDownload;
        $this->RequiredDataUpload   = $RequiredDataUpload;
        $this->Deadline             = $Deadline;
        $this->SecurityLevel        = $SecurityLevel;
        $this->CommunicationType    = $CommunicationType;
    }
    
    // Getter and Setter for Priority
    public function getPriority() {
        return $this->Priority;
    }
    public function setPriority( string $Priority = "Medium" ) {
        if( $Priority !== "High" && $Priority !== "Medium" && $Priority !== "Low"  )
        {
            throw new Exception("Unknown priority \"" . $Priority . "\"." , 1);
            return FALSE;
        }
        $this->Priority = $Priority;
        return true;
    }

    // Getter and Setter for RequiredCores
    public function getRequiredCores() {
        return $this->RequiredCores;
    }
    public function setRequiredCores( int $RequiredCores ) {
        if( $RequiredCores <= 0 )
        {
            throw new Exception("Invalid number of required cores \"" . $RequiredCores . "\"." , 1);
            return FALSE;
        }
        $this->RequiredCores = $RequiredCores;
        return true;
    }

    // Getter and Setter for RequiredMIPSPerCore
    public function getRequiredMIPSPerCore() {
        return $this->RequiredMIPSPerCore;
    }
    public function setRequiredMIPSPerCore(int $RequiredMIPSPerCore) {
        if ($RequiredMIPSPerCore <= 0) {
            throw new Exception("Invalid value for required MIPS per core \"" . $RequiredMIPSPerCore . "\".", 1);
            return FALSE;
        }
        $this->RequiredMIPSPerCore = $RequiredMIPSPerCore;
        return true;
    }

    // Getter and Setter for RequiredRAM
    public function getRequiredRAM() {
        return $this->RequiredRAM;
    }
    public function setRequiredRAM(int $RequiredRAM) {
        if ($RequiredRAM <= 0) {
            throw new Exception("Invalid value for required RAM \"" . $RequiredRAM . "\".", 1);
            return FALSE;
        }
        $this->RequiredRAM = $RequiredRAM;
        return true;
    }

    // Getter and Setter for RequiredStorage
    public function getRequiredStorage() {
        return $this->RequiredStorage;
    }
    public function setRequiredStorage(int $RequiredStorage) {
        if ($RequiredStorage < 0) {
            throw new Exception("Invalid value for required storage \"" . $RequiredStorage . "\".", 1);
            return FALSE;
        }
        $this->RequiredStorage = $RequiredStorage;
        return true;
    }

    // Getter and Setter for Timestamp
    public function getTimestamp() {
        return $this->Timestamp;
    }
    public function setTimestamp(int $Timestamp) {
        if ($Timestamp <= 0) {
            throw new Exception("Invalid value for timestamp \"" . $Timestamp . "\".", 1);
            return FALSE;
        }
        $this->Timestamp = $Timestamp;
        return true;
    }

    // Getter and Setter for TimestampMS
    public function getTimestampMS() {
        return $this->TimestampMS;
    }
    public function setTimestampMS(float $TimestampMS) {
        if ($TimestampMS <= 0) {
            throw new Exception("Invalid value for timestamp_ms \"" . $TimestampMS . "\".", 1);
            return FALSE;
        }
        $this->TimestampMS = $TimestampMS;
        return true;
    }

    // Getter and Setter for RequiredDataDownload
    public function getRequiredDataDownload() {
        return $this->RequiredDataDownload;
    }
    public function setRequiredDataDownload(int $RequiredDataDownload) {
        if ($RequiredDataDownload < 0) {
            throw new Exception("Invalid value for required data download \"" . $RequiredDataDownload . "\".", 1);
            return FALSE;
        }
        $this->RequiredDataDownload = $RequiredDataDownload;
        return true;
    }

    // Getter and Setter for RequiredDataUpload
    public function getRequiredDataUpload() {
        return $this->RequiredDataUpload;
    }
    public function setRequiredDataUpload(int $RequiredDataUpload) {
        if ($RequiredDataUpload < 0) {
            throw new Exception("Invalid value for required data upload \"" . $RequiredDataUpload . "\".", 1);
            return FALSE;
        }
        $this->RequiredDataUpload = $RequiredDataUpload;
        return true;
    }

    // Getter and Setter for Deadline
    public function getDeadline() {
        return $this->Deadline;
    }
    public function setDeadline(int $Deadline) {
        if ($Deadline <= 0) {
            throw new Exception("Invalid value for deadline \"" . $Deadline . "\".", 1);
            return FALSE;
        }
        $this->Deadline = $Deadline;
        return true;
    }

    // Getter and Setter for SecurityLevel
    public function getSecurityLevel() {
        return $this->SecurityLevel;
    }
    public function setSecurityLevel(string $SecurityLevel = "Medium") {
        if ($SecurityLevel !== "High" && $SecurityLevel !== "Medium" && $SecurityLevel !== "Low") {
            throw new Exception("Unknown security level \"" . $SecurityLevel . "\".", 1);
            return FALSE;
        }
        $this->SecurityLevel = $SecurityLevel;
        return true;
    }

    // Getter and Setter for CommunicationType
    public function getCommunicationType() {
        return $this->CommunicationType;
    }
    public function setCommunicationType(string $CommunicationType = "synchronous") {
        if ($CommunicationType !== "synchronous" && $CommunicationType !== "asynchronous") {
            throw new Exception("Unknown communication type \"" . $CommunicationType . "\".", 1);
            return FALSE;
        }
        $this->CommunicationType = $CommunicationType;
        return true;
    }

}


?>