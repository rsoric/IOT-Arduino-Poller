<?php

require_once 'database_config.php';
require_once 'sanitization.php';

    class QuestionReplies
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

        public function createTable($name = 'question_replies'){

            $this->_tableName = $name;

            $sql = <<<EOSQL
                CREATE TABLE IF NOT EXISTS $this->_tableName (
                questionReplyId  INT AUTO_INCREMENT NOT NULL,
                value            INT,
                questionId       INT,
                pollInstanceId   INT,
                PRIMARY KEY (questionReplyId),
                FOREIGN KEY (questionId) REFERENCES questions(questionId),
                FOREIGN KEY (pollInstanceId) REFERENCES poll_instances(pollInstanceId) 
            );
            EOSQL;

            $this->_connection->exec($sql);
        }

        public function insertQuestionReply($value, $questionId, $pollInstanceId)
        {
            $questionReply = array(
                ':value' => $value,
                ':questionId' => $questionId,
                ':pollInstanceId' => $pollInstanceId
            );

            $sql = <<<EOSQL
                INSERT INTO $this->_tableName(value, questionId, pollInstanceId) VALUES(:value, :questionId, :pollInstanceId);
            EOSQL;

            $stmt = $this->_connection->prepare($sql);

            try
            {
                $stmt->execute($questionReply);
            }
            catch (Exception $e)
            {
                echo $e->getMessage();
            }
        }

        public function deleteQuestionReply($questionReplyId)
        {
            $sql = <<<EOSQL
                DELETE FROM $this->_tableName WHERE questionReplyId = $questionReplyId;
            EOSQL;

            $this->_connection->exec($sql);
        }

        public function updateQuestionReply($questionReplyId, $value)
        {
            $questionReply = array(
                ':questionReplyId' => $questionReplyId,
                ':value' => $value,
            );

            $sql = <<<EOSQL
                UPDATE $this->_tableName
                SET value = :value
                WHERE questionReplyId = :questionReplyId;
            EOSQL;

            $stmt = $this->_connection->prepare($sql);

            try
            {
                $stmt->execute($questionReply);
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

    $_questionReplies = new QuestionReplies();