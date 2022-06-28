<?php

require_once 'database_config.php';
require_once 'sanitization.php';

class Questions
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

    public function createTable($name = 'questions')
    {
        $this->_tableName = $name;

        $sql = <<<EOSQL
            CREATE TABLE IF NOT EXISTS $this->_tableName (
            questionId         INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
            questionText       NVARCHAR (16) DEFAULT NULL
        );
        EOSQL;

        $this->_connection->exec($sql);
    }


    public function insertQuestion($questionText)
    {
        $question = array(
            ':questionText' => $questionText
        );

        $sql = <<<EOSQL
            INSERT INTO $this->_tableName(questionText) VALUES(:questionText);
        EOSQL;

        $stmt = $this->_connection->prepare($sql);

        try
        {
            $stmt->execute($question);
        }
        catch (Exception $e)
        {
            echo $e->getMessage();
        }
    }

    public function deleteQuestion($questionId)
    {
        $sql = <<<EOSQL
            DELETE FROM $this->_tableName WHERE questionId = $questionId;
        EOSQL;

        $this->_connection->exec($sql);
    }

    public function updateQuestion($questionId, $questionText)
    {
        $question = array(
            ':questionId' => $questionId,
            ':questionText' => $questionText
        );

        $sql = <<<EOSQL
            UPDATE $this->_tableName
            SET questionText = :questionText
            WHERE questionId = :questionId;
        EOSQL;

        $stmt = $this->_connection->prepare($sql);

        try
        {
            $stmt->execute($question);
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
  }
  


 $_questions = new Questions();
  