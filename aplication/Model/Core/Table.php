<?php Ccc::loadClass('Model_Core_Adapter'); ?>
<?php

class Model_Core_Table{
    protected $tabelName = null;
    protected $primaryKey = null;

    public function setTableName($tableNmae)
    {
        $this->tableName = $tableNmae;
        return $this;
    }

    public function getTableName()
    {
        return $this->tableName;
    }

    public function setPrimarykey($primaryKey)
    {
        $this->primaryKey = $primaryKey;
        return $this;
    }

    public function getPrimaryKey()
    {
        return $this->primaryKey;
    }

    public function insert(array $data)
    {
		$adapter = new Model_Core_Adapter();
        foreach($data as $key => $value){
            $data[$key] = "'".$value."'";
        }

        $insertQuery =  "INSERT INTO ".$this->getTableName()." (".implode(',',array_keys($data)).") VALUES (".implode(',',array_values($data)).")";
        $insertId = $adapter->insert($insertQuery);

        if(!$insertId){
            throw new Exception("System is unable to save your data", 1);
        }
        return $insertId;
    }

    public function update(array $data,$primaryKey,$coloum=null)
    {
        
		$adapter = new Model_Core_Adapter();
        $finalData = "";
        foreach($data as $key => $value){
            $finalData .= $key."='".$value."',"; 
        }
        $finalData = rtrim($finalData,',');
        if($coloum){
            $updateQuery = "UPDATE ".$this->getTableName()." SET ". $finalData ." WHERE ".$coloum."=".$primaryKey." ";
            $result = $adapter->update($updateQuery);

            if(!$result){
                throw new Exception("System is unable to update your data", 1);
            }
            return $result;
        }
        $updateQuery = "UPDATE ".$this->getTableName()." SET ". $finalData ." WHERE ".$this->getPrimaryKey()."=".$primaryKey." ";

        $result = $adapter->update($updateQuery);

        if(!$result){
            throw new Exception("System is unable to update your data", 1);
        }
        return $result;
    }

    public function delete($primaryKey)
    {
		$adapter = new Model_Core_Adapter();
        $deleteQuery = "DELETE FROM ".$this->getTableName()." WHERE ".$this->getPrimaryKey()."=".$primaryKey." ";
        $result = $adapter->delete($deleteQuery);

        if(!$result){
            throw new Exception("System is unable to delete your data", 1);
        }
        return $result;
    }

	public function fetchAll($query)
	{

		$adapter = new Model_Core_Adapter();
		$result = $adapter->fetchAll($query);
		return $result;
	}

	public function fetchRow($query)
	{
		$adapter = new Model_Core_Adapter();
		$result=$adapter->fetchRow($query);

		if(!$result)
		{
			return $result;	
		}
		return $result;
	}
    
}

?>