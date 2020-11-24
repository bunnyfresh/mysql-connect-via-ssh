<?php
include 'config/DbConfig.php';
require_once('vendor/autoload.php'); 
use phpseclib\Net\SSH2;

class MysqlCon extends Dbconfig
{

    public $connectionString;
    public $dataSet;
    // private $sqlQuery;

    protected $dbName;
    protected $serverName;
    protected $userName;
    protected $passCode;

    protected $sshHost;
    protected $sshUser;
    protected $sshPass;
    protected $sshPort;

    protected $ssh;
 

    function Mysql()
    {
        $this->connectionString = NULL;
        $this->sqlQuery = NULL;
        $this->dataSet = NULL;
      
        $dbPara = new Dbconfig(); 
        $this->dbName = $dbPara->dbName;
        $this->serverName = $dbPara->serverName;
        $this->userName = $dbPara->userName;
        $this->passCode = $dbPara->passCode;

        $this->sshHost = $dbPara->sshHost;
        
        $this->sshUser = $dbPara->sshUser;
        $this->sshPass = $dbPara->sshPass;
        $this->sshPort = $dbPara->sshPort;
        $dbPara = NULL; 
    }

    function dbConnect()
    {        

        

        $this->connectionString = mysqli_connect($this->serverName,$this->userName,$this->passCode);
        mysqli_select_db($this->connectionString ,$this->dbName );
        return $this->connectionString;
    }

    function sshConnect()
    {        
        $this->ssh = new SSH2($this->sshHost);
        return $this->ssh;
    }

    function sendToDBViaSHH2($request){ 
        $command = "mysql -u ".$this->userName." -p'".$this->passCode."'  \
        -h ".$this->serverName." -P 3306 \
        -D ".$this->dbName ." -e '".$request."' ";
        

           if (!$this->ssh->login($this->sshUser, $this->sshPass)) {
               $output ='Login Failed';
           }
           else{
               $output = $this->ssh->exec($command); 
        }

    }

    function dbDisconnect()
    {
        $this->connectionString = NULL;
        $this->sqlQuery = NULL;
        $this->dataSet = NULL;
        $this->databaseName = NULL;
        $this->serverName = NULL;
        $this->userName = NULL;
        $this->passCode = NULL;
    }
}
