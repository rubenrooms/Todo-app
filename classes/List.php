<?php
include_once(__DIR__ . "/Db.php");

class TodoList 
{
    private $id;
    private $name;
    private $user_id;

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
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName($name)
    {
        $this->name = $name;

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

    public function save()
    {
        $conn = Db::getConnection();
        var_dump("connection");
        $sql = "INSERT INTO Lists (name, user_id) VALUES (:listname, :user_id)";
        $statement = $conn->prepare($sql);
        $name = $this->getName();
        $user_id = $this->getUser_id();

        $statement->bindValue(":listname", $name);
        $statement->bindValue(":user_id", $user_id);
        $statement->execute();

        return $this;
    }

    public function getAllLists()
    {
        $conn = Db::getConnection();

        $sql = "SELECT * FROM Lists WHERE user_id = :id";
        $statement = $conn->prepare($sql);
        $id = $_SESSION['id'];
        $statement->bindValue(":id", $id);
        $statement->execute();

        return $statement->fetchAll();  
    }

    public static function getListById($id)
    {
        $conn = Db::getConnection();

        $sql = "SELECT * FROM Lists WHERE id = $id LIMIT 1";
        $statement = $conn->prepare($sql);
        $statement->execute();

        return $statement->fetch();
    }
}
?>