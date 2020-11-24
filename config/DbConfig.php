<?php
class Dbconfig {
    protected $serverName;
    protected $userName;
    protected $passCode;
    protected $dbName;

    protected $sshHost;
    protected $sshUser;
    protected $sshPass;
    protected $sshPort;

    function Dbconfig() {
        $this->sshHost = "***";
        $this->sshUser = "***";
        $this->sshPass = "***";
        $this->sshPort = "***"; 
        
        $this->serverName = "***";
        $this->userName = "***";
        $this->passCode = "***";
        $this->dbName = "***";

        
    }
}
?> 