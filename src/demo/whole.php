<?php


$VM_1 = new Cloud( 8 , 4000 , 8000 , 200000 , 3000 );
$VM_2 = new Cloud( 4 , 4000 , 4000 , 200000 , 2500 );
$VM_3 = new Cloud( 4 , 4000 , 12000 , 200000 , 3000 );
$VM_4 = new Cloud( 8 , 4000 , 8000 , 200000 , 5000 );

$VM_5 = new Edge( 8 , 4000 , 8000 , 200000 , 200 );
$VM_6 = new Edge( 8 , 4000 , 8000 , 200000 , 250 );
$VM_7 = new Edge( 4 , 4000 , 12000 , 200000 , 500 );
$VM_8 = new Edge( 8 , 4000 , 8000 , 200000 , 500 );

$T1 = new Task( 80 , 1000 , 2000 , 1000 , microtime( TRUE ) );
$T2 = new Task( 80 , 1000 , 2000 , 1000 , microtime( TRUE ) );
$T3 = new Task( 80 , 1000 , 2000 , 1000 , microtime( TRUE ) );
$T4 = new Task( 80 , 1000 , 2000 , 1000 , microtime( TRUE ) );

$KS = new Knapsack();

$objects = [ 
    [ "value" => 90, "weight" => 17 ],
    [ "value" => 45, "weight" => 10 ],
    [ "value" => 50, "weight" => 15 ]
];
$w = 25;
var_dump( @$KS->one_dimensional_integer_knapsack( $objects, $w ) );



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


class Cloud
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




class Knapsack
{
    function one_dimensional_integer_knapsack( $objects, $w )
    {
        $n = count( $objects );
        $m = [ 0 ];
        for ($j=1; $j <= $n ; $j++) { 
            for ($y=1; $y <= $w ; $y++) { 
                if ( $objects[ $j ]["weight"] > $y ) {
                    $m[$j][$y] = $m[$j-1][$y];
                }
                else {
                    $m[$j][$y] = max(
                        $m[$j-1][$y],
                        $objects[ $j ]["value"] + $m[$j-1][$w-$objects[$j]["weight"]]
                    );
                }
            }
        }
        return $m[$n][$w];
    }
}


?>
