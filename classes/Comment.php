<?php
include_once(__DIR__ . "/Db.php");

class Comment {
    private $id;
    private $text;
    private $user_id;
    private $todo_id;

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of text
     */ 
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set the value of text
     *
     * @return  self
     */ 
    public function setText($text)
    {
        $this->text = $text;

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

    public function saveComment() 
    {
        $conn = Db::getConnection();

        $sql = "INSERT INTO comments (text, user_id, todo_id) VALUES (:text, :user_id, :todo_id)";
        $statement = $conn->prepare($sql);
        $text = $this->getText();
        $user_id = $this->getUser_id();
        $todo_id = $this->getTodo_id();

        $statement->bindValue(":text", $text);
        $statement->bindValue(":user_id", $user_id);
        $statement->bindValue(":todo_id", $todo_id);

        return $statement->execute();
    }

    public static function getAll($todo_id)
    {
        $conn = Db::getConnection();

        $sql = "SELECT * FROM comments WHERE todo_id = :todo_id";
        $statement = $conn->prepare($sql);
        $statement->bindValue(":todo_id", $todo_id);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC); 
    }
}