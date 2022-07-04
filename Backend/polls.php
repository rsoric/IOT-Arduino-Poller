<?php

require_once 'database_config.php';
require_once 'sanitization.php';

class Polls
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

    public function createTable($name = 'polls')
    {
        $this->_tableName = $name;

        $sql = <<<EOSQL
            CREATE TABLE IF NOT EXISTS $this->_tableName (
            pollId             INT AUTO_INCREMENT NOT NULL,
            pollName    NVARCHAR (300) DEFAULT NULL,
            PRIMARY KEY (pollId)
        );
        EOSQL;

        $this->_connection->exec($sql);
    }


    public function insertPoll($pollName)
    {
        $poll = array(
            ':pollName' => $pollName
        );

        $sql = <<<EOSQL
            INSERT INTO $this->_tableName(pollName) VALUES(:pollName);
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
        return $this->_connection->lastInsertId();
    }

    public function deletePoll($pollId)
    {
        $sql = <<<EOSQL
            DELETE FROM questions WHERE pollId = $pollId;
            DELETE FROM $this->_tableName WHERE pollId = $pollId;
        EOSQL;

        $this->_connection->exec($sql);
    }

    public function updatePoll($pollId, $pollName)
    {
        $poll = array(
            ':pollId' => $pollId,
            ':pollName' => $pollName
        );

        $sql = <<<EOSQL
            UPDATE $this->_tableName
            SET pollName = :pollName
            WHERE pollId = :pollId;
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

    public function getPollToEdit($pollId)
    {
        $sql = <<<EOSQL
            SELECT * FROM $this->_tableName
            WHERE pollId = $pollId;
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

    public function getPollQuestions($pollId)
    {
        $sql = <<<EOSQL
            SELECT * FROM questions
                WHERE pollId = $pollId;
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
  


 $_polls = new Polls();