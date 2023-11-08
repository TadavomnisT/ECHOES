<?php

$VM_1 = new Cloud( 8 , 4000 , 8000 , 200000 , 3000 );
$VM_2 = new Cloud( 4 , 4000 , 4000 , 200000 , 2500 );
$VM_3 = new Cloud( 4 , 4000 , 12000 , 200000 , 3000 );
$VM_4 = new Cloud( 8 , 4000 , 8000 , 200000 , 5000 );

$VM_5 = new Edge( 8 , 4000 , 8000 , 200000 , 200 );
$VM_6 = new Edge( 8 , 4000 , 8000 , 200000 , 250 );
$VM_7 = new Edge( 4 , 4000 , 12000 , 200000 , 500 );
$VM_8 = new Edge( 8 , 4000 , 8000 , 200000 , 500 );

$cloud_servers = [
    $VM_1,
    $VM_2,
    $VM_3,
    $VM_4
];

$edge_servers = [
    $VM_5,
    $VM_6,
    $VM_7,
    $VM_8
];

// small set==============================================================
$T1 = new Task( 80 , 1000 , 2000 , 1000 , microtime( ) );
sleep(1);
$T2 = new Task( 80 , 1000 , 2000 , 1000 , microtime( ) );
sleep(1);
$T3 = new Task( 80 , 1000 , 2000 , 1000 , microtime( ) );
sleep(1);
$T4 = new Task( 80 , 1000 , 2000 , 1000 , microtime( ) );

$tasks = [
    $T1,
    $T2,
    $T2,
    $T4,
];
// ========================================================================

// // big set==============================================================
// for ($i=0; $i < 10000 ; $i++) { 
//     $tasks[] = new Task( 80 , 1000 , 2000 , 1000 , microtime( ) );
// }
// // =====================================================================

$KS = new Knapsack();

@$KS->integer_knapsack( $tasks, $edge_servers );



class Server {
    private $Type;
    private $Cores;
    private $MIPS; //CPU Mega Instructions Per Second
    private $RAM; //in MB
    private $Storage; //in MB
    private $Average_Access_Time; //in micro-seconds

    public function __construct(string $Type, int $Cores, int $MIPS, int $RAM, int $Storage, int $Average_Access_Time) {
        $this->Type = $Type;
        $this->Cores   = $Cores;
        $this->MIPS    = $MIPS;
        $this->RAM     = $RAM;
        $this->Storage = $Storage;
        $this->Average_Access_Time = $Average_Access_Time;
    }

    public function getType() {
        return $this->Type;
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

class Cloud extends Server {
    public function __construct(int $Cores, int $MIPS, int $RAM, int $Storage, int $Average_Access_Time) {
        parent::__construct('Cloud', $Cores, $MIPS, $RAM, $Storage, $Average_Access_Time);
    }
}

class Edge extends Server {
    public function __construct(int $Cores, int $MIPS, int $RAM, int $Storage, int $Average_Access_Time) {
        parent::__construct('Edge', $Cores, $MIPS, $RAM, $Storage, $Average_Access_Time);
    }
}

class Task
{
    private $Priority; //in percent
    private $RequiredMIPS; //CPU Mega Instructions Per Second
    private $RequiredRAM; //in MB
    private $RequiredStorage; //in MB
    private $TimeStamp; //in UNIX-timestamp with micro-seconds

    public function __construct(int $Priority, int $RequiredMIPS, int $RequiredRAM, int $RequiredStorage, int|string $TimeStamp) {
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

class Knapsack
{
    public function integer_knapsack($objects, $w)
    {
        // Reduce the dimensionality of tasks into a single value using priority as weight
        $values = array_map(function ($task) {
            return $task->getPriority();
        }, $objects);

        // Convert server attributes into weights
        $weights = array_map(function ($server) {
            return [
                $server->getCores(),
                $server->getMIPS(),
                $server->getRAM(),
                $server->getStorage(),
                $server->getAverage_Access_Time()
            ];
        }, $w);

        $n = count($values);
        $m = count($weights);

        // Initialize the table with zeros
        $table = array_fill(0, $n + 1, array_fill(0, $m + 1, 0));

        // Fill the table using dynamic programming approach
        for ($i = 1; $i <= $n; $i++) {
            for ($j = 1; $j <= $m; $j++) {
                if ($weights[$j - 1][0] > $values[$i - 1]) {
                    $table[$i][$j] = $table[$i - 1][$j];
                } else {
                    $table[$i][$j] = max(
                        $table[$i - 1][$j],
                        $table[$i - 1][$j - 1] + $values[$i - 1]
                    );
                }
            }
        }

        // Backtrack to find the optimal solution
        $selected = [];
        while ($n > 0 && $m > 0) {
            if ($table[$n][$m] != $table[$n - 1][$m]) {
                array_push($selected, $n - 1);
                $m -= 1;
            }
            $n -= 1;
        }

        // Assign tasks to selected servers
        foreach ($selected as $i) {
            $task = $objects[$i];
            $server = $w[count($w) - $m];

            echo "Task(Priority:" . $task->getPriority() . ",RequiredMIPS:" . $task->getMIPS() . ",RequiredRAM:" . $task->getRAM() . ",RequiredStorage:" . $task->getStorage() . ",TimeStamp:\"" . $task->getTimeStamp() . "\") is assigned to server[" . (count($w) - $m) . "]" . PHP_EOL;

            $m -= 1;
        }
    }
}