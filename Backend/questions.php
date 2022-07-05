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
            questionId         INT AUTO_INCREMENT NOT NULL,
            questionText       NVARCHAR (16) DEFAULT NULL,
            pollId             INT, 
            PRIMARY KEY (questionId),
            FOREIGN KEY (pollId) REFERENCES polls(pollId)
        );
        EOSQL;

        $this->_connection->exec($sql);
    }


    public function insertQuestion($questionText, $pollId)
    {
        $question = array(
            ':questionText' => $questionText,
            ':pollId' => $pollId
        );

        $sql = <<<EOSQL
            INSERT INTO $this->_tableName(questionText, pollId) VALUES(:questionText, :pollId);
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
            DELETE FROM question_replies WHERE questionId = $questionId;
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
  