<?php

require_once 'database_config.php';
require_once 'sanitization.php';

class CurrentPoll
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

    public function createTable($name = 'currentPoll')
    {
        $this->_tableName = $name;

        $sql = <<<EOSQL
            CREATE TABLE IF NOT EXISTS $this->_tableName (
            entryID            INT AUTO_INCREMENT NOT NULL,
            currentPollId      INT NOT NULL,
            FOREIGN KEY (currentPollId) REFERENCES polls(pollId),
            PRIMARY KEY (entryID)
        );
        EOSQL;

        $this->_connection->exec($sql);
    }

    /*


    public function updateCurrentPoll($newCurrentPollID)
    {
        $poll = array(
            ':pollId' => $newCurrentPollID
        );

        $sql = <<<EOSQL
            UPDATE $this->_tableName 
            SET currentPollId = :pollId
            WHERE entryID = 1234;
        EOSQL;

        $stmt = $this->_connection->prepare($sql);

        try
        {
            $stmt->execute($poll);
        }
        catch (Exception $e)
        {
            echo $e->getMessage();
        }
    }*/

    public function deleteCurentPoll($pollId)
    {
        $sql = <<<EOSQL
            DELETE FROM $this->_tableName WHERE pollId = $pollId;
        EOSQL;

        $this->_connection->exec($sql);
    }

    
    public function updateCurrentPoll($newPollID)
    {
        $currentPoll = array(
            ':pollId' => $newPollID,
        );

        $sql = <<<EOSQL
            UPDATE $this->_tableName
            SET currentPollId = :pollId
            WHERE entryID = "1234";
        EOSQL;

        $stmt = $this->_connection->prepare($sql);

        try
        {
            $stmt->execute($currentPoll);
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

    public function getNameOfCurrentPoll()
    {
        $sql = <<<EOSQL
            SELECT pollName
            FROM polls
            INNER JOIN currentpoll
            ON polls.PollId = currentpoll.currentPollId;
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



 $_currentPoll = new CurrentPoll();
  