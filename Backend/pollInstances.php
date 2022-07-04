<?php

require_once 'database_config.php';
require_once 'sanitization.php';

class PollInstances
{
    private $_connection;
    private $_tableName;

    public function __construct()
    {
        
        $connStr = sprintf("mysql:host=%s;dbname=%s", DBConfig::serverName, DBConfig::dbName);

        try
        {
            $this->_connection = new PDO($connStr, DBConfig::dbUsername, DBConfig::dbPassword);
            debug_to_console("Connected");
        }
        catch(PDOException $e)
        {
            debug_to_console("Not Connected");
        }

        $this->createTable();
    }

    public function __destruct()
    {
        $this->_connection = null;
    }

    public function createTable($name = 'poll_instances')
    {
        $this->_tableName = $name;

        $sql = <<<EOSQL
            CREATE TABLE IF NOT EXISTS $this->_tableName (
            pollInstanceId      INT AUTO_INCREMENT NOT NULL,
            pollId              INT,
            timestamp           TIMESTAMP,
            PRIMARY KEY (pollInstanceId),
            FOREIGN KEY (pollId) REFERENCES polls(pollId)
        );
        EOSQL;

        $this->_connection->exec($sql);
    }


    public function insertPollInstance($pollId)
    {
        $pollOfWhichInstance = $pollId->fetch();

        $pollInstance = array(
            ':pollId' => $pollOfWhichInstance['pollId']
        );

        $sql = <<<EOSQL
            INSERT INTO $this->_tableName(pollId) VALUES(:pollId);
        EOSQL;

        $stmt = $this->_connection->prepare($sql);

        try
        {
            $stmt->execute($pollInstance);
        }
        catch (Exception $e)
        {
            echo $e->getMessage();
        }

        return $this->_connection->lastInsertId();
    }

    public function updateTimeStamp($pollInstanceId, $timestamp)
    {
        $pollInstance = array(
            ':pollInstanceId' => $pollInstanceId,
            ':timestamp' => $timestamp
        );

        $sql = <<<EOSQL
            UPDATE $this->_tableName
            SET timestamp = :timestamp
            WHERE pollInstanceId = :pollInstanceId;
        EOSQL;

        $stmt = $this->_connection->prepare($sql);

        try
        {
            $stmt->execute($pollInstance);
        }
        catch (Exception $e)
        {
            echo $e->getMessage();
        }
    }

    public function deletePollInstance($pollInstanceId)
    {
        $sql = <<<EOSQL
            DELETE FROM $this->_tableName WHERE pollInstanceId = $pollInstanceId;
        EOSQL;

        $this->_connection->exec($sql);
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
  }
  


 $_pollInstances = new PollInstances();
  