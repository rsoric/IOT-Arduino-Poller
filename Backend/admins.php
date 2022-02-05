<?php

require_once 'database_config.php';
require_once 'sanitization.php';

class Admins
{
    private $_connection;
    private $_tableName;

    public function __construct()
    {
        $connStr = sprintf("mysql:host=%s;dbname=%s", DBConfig::serverName, DBConfig::dbName);

        try
        {
            $this->_connection = new PDO($connStr, DBConfig::dbUsername, DBConfig::dbPassword);
            echo "Connected!";
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
            echo "Not Connected!";
        }

        $this->createTable();

        if(count($this->getDBdata()->fetchAll(PDO::FETCH_COLUMN, 0)) == 0)
        {    
            $this->insertUser('admin', 'admin123');
        }
    }

    public function __destruct()
    {
        $this->_connection = null;
    }

    

    public function createTable($name = 'admins')
    {
        if($this->tableExists($this->_connection, $name) == TRUE)
        {
            $this->_tableName = $name;

            $sql = <<<EOSQL
                CREATE TABLE IF NOT EXISTS $this->_tableName (
                adminId         INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
                adminUsername   NVARCHAR (255) DEFAULT NULL,
                adminPassword   NVARCHAR (255) DEFAULT NULL
            );
            EOSQL;

            $this->_connection->exec($sql);
            debug_to_console("Table Created");
        }
    }




    public function insertUser($adminUsername, $adminPassword)
    {
        $user = array(
            ':adminUsername' => $adminUsername,
            ':adminPassword' => md5($adminPassword)
        );

        $sql = <<<EOSQL
            INSERT INTO $this->_tableName(adminUsername, adminPassword) VALUES(:adminUsername, :adminPassword);
        EOSQL;

        $stmt = $this->_connection->prepare($sql);

        try
        {
            $stmt->execute($user);
        }
        catch (Exception $e)
        {
            echo $e->getMessage();
        }
    }

    public function getDBdata()
    {
        $sql = <<<EOSQL
            SELECT * FROM $this->_tableName;
        EOSQL;

        $stmt = $this->_connection->prepare($sql);

        try
        {
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            return $stmt;

        }
        catch (Exception $e)
        {
            echo $e->getMessage();
        }
    }

    public function tableExists($pdo, $table) {

        // Try a select statement against the table
        // Run it in try/catch in case PDO is in ERRMODE_EXCEPTION.
        try {
            $result = $pdo->query("SELECT 1 FROM $table LIMIT 1");
        } catch (Exception $e) {
            // We got an exception == table not found
            return FALSE;
        }
    
        // Result is either boolean FALSE (no table found) or PDOStatement Object (table found)
        return $result !== FALSE;
    }
  }
  


 $_admins = new Admins();
  