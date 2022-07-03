<?php

    require_once 'database_config.php';
    require_once 'sanitization.php';

    class FullReplies
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

        public function createTable($name = 'full_replies'){

            $this->_tableName = $name;

            $sql = <<<EOSQL
                CREATE TABLE IF NOT EXISTS $this->_tableName (
                fullReplyId         INT AUTO_INCREMENT NOT NULL,
                timestamp           TIMESTAMP,
                questionReplyId     INT,
                pollInstanceId      INT,
                PRIMARY KEY (fullReplyId),
                FOREIGN KEY (questionReplyId) REFERENCES question_replies(questionReplyId),
                FOREIGN KEY (pollInstanceId) REFERENCES poll_instances(pollInstanceId)
            );
            EOSQL;

            $this->_connection->exec($sql);
        }

        public function insertFullReply($timestamp, $questionReplyId, $pollInstanceId)
        {
            $fullReply = array(
                ':timestamp' => $timestamp,
                ':questionReplyId' => $questionReplyId,
                ':pollInstanceId' => $pollInstanceId
            );

            $sql = <<<EOSQL
                INSERT INTO $this->_tableName(timestamp, questionReplyId, pollInstanceId) VALUES(:timestamp, :questionReplyId, :pollInstanceId);
            EOSQL;

            $stmt = $this->_connection->prepare($sql);

            try
            {
                $stmt->execute($fullReply);
            }
            catch (Exception $e)
            {
                echo $e->getMessage();
            }
        }

        public function deleteFullReply($fullReplyId)
        {
            $sql = <<<EOSQL
                DELETE FROM $this->_tableName WHERE fullReplyId = $fullReplyId;
            EOSQL;

            $this->_connection->exec($sql);
        }

        public function updateFullReply($fullReplyId, $timestamp)
        {
            $fullReply = array(
                ':fullReplyId' => $fullReplyId,
                ':timestamp' => $timestamp,
            );

            $sql = <<<EOSQL
                UPDATE $this->_tableName
                SET timestamp = :timestamp
                WHERE questionReplyId = :fullReplyId;
            EOSQL;

            $stmt = $this->_connection->prepare($sql);

            try
            {
                $stmt->execute($fullReply);
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
    
    $_fullReply = new FullReplies();