<?php

class Adapter{
    public $config = ['host' => 'localhost',
                      'userName' => 'root',
                      'password' => '',
                      'dbName' => 'ecommerce'];
    
    private $connect = null;

    public function connect()
    {
        $connect = mysqli_connect($this->config['host'],$this->config['userName'],$this->config['password'],$this->config['dbName']);
        $this->setConnect($connect);
        return $connect;
    }

    public function setConnect($connect)
    {
        $this->connect = $connect;
        return $this;
    }

    public function getConnect()
    {
        return $this->connect;
    }

    public function setConfig($config)
    {
        $this->config = $config;
        return $this;
    }

    public function getConfig()
    {
        return $this->config;
    }

    public function query($query)
    {
        if(!$this->getConnect()){
            $this->connect();
        }
        $result = $this->getConnect()->query($query);
        return $result;
    }

    public function insert($query)
    {
        $result = $this->query($query);
        return $result;
    }

    public function update($query)
    {
        $result = $this->query($query);
        return $result;
    }

    public function delete($query)
    {
        $result = $this->query($query);
        return $result;
    }

    public function fetchRow($query)
    {
        $result = $this->query($query);
        if($result->num_rows){
            return $result->fetch_assoc();
        }
        return false;
    }

    public function fetchAll($query)
    {
        $result = $this->query($query);
        if($result->num_rows){
            return $result->fetch_all(MYSQLI_ASSOC);
        }
        return false;
    }
}

?>