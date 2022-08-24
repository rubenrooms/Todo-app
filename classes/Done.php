<?php

    include_once(__DIR__ . "/Db.php");

    class Done  {
        private $todo_id;
        private $user_id;

        /**
         * Get the value of todo_id
         */ 
        public function getTodo_id()
        {
                return $this->todo_id;
        }

        /**
         * Set the value of todo_id
         *
         * @return  self
         */ 
        public function setTodo_id($todo_id)
        {
                $this->todo_id = $todo_id;

                return $this;
        }

        /**
         * Get the value of user_id
         */ 
        public function getUser_id()
        {
                return $this->user_id;
        }

        /**
         * Set the value of user_id
         *
         * @return  self
         */ 
        public function setUser_id($user_id)
        {
                $this->user_id = $user_id;

                return $this;
        }

        public function done()
        {
                $conn = Db:: getConnection();

                $sql = "INSERT INTO done (todo_id, user_id) VALUES (:todo_id, :user_id)";
                $statement = $conn->prepare($sql);

                $todo_id = $this->getTodo_id();
                $user_id = $this->getUser_id();

                $statement->bindValue(":todo_id", $todo_id);
                $statement->bindValue(":user_id", $user_id);

                return $statement->execute();
        }

        public function notDone()
        {
                $conn = Db:: getConnection();

                $sql = "delete from done where (todo_id, user_id) = (:todo_id, :user_id)";
                $statement = $conn->prepare($sql);

                $todo_id = $this->getTodo_id();
                $user_id = $this->getUser_id();

                $statement->bindValue(":todo_id", $todo_id);
                $statement->bindValue(":user_id", $user_id);

                return $statement->execute();
        }

        public function getDoneByTask()
        {
                $conn = Db::getConnection();

                $sql = "SELECT * from done WHERE (todo_id) = (:todo_id)";
                $statement = $conn->prepare($sql);

                $todo_id = $this->getTodo_id();

                $statement->bindValue(":todo_id", $todo_id);

                return $statement->execute();
        }

        public static function getDone($todo_id)
        {
            $conn = Db::getConnection();
    
            $sql = "SELECT * FROM done WHERE (todo_id) = $todo_id LIMIT 1";
            $statement = $conn->prepare($sql);
            $statement->execute();
    
            return $statement->fetch(); 
        }
    }