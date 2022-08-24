<?php
 include_once(__DIR__ . "/Db.php");

 class User {

    private $id;
    private $firstname;
    private $lastname;
    private $username;
    private $password;

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
     * Get the value of firstname
     */ 
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set the value of firstname
     *
     * @return  self
     */ 
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get the value of lastname
     */ 
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set the value of lastname
     *
     * @return  self
     */ 
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get the value of username
     */ 
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set the value of username
     *
     * @return  self
     */ 
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get the value of password
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */ 
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    public function hashPassword()
    {
        $password = $this->getPassword();
        $options = [
            "cost" => 12,
        ];
        $this->password = password_hash($password, PASSWORD_DEFAULT, $options);
        return $this;
    }

    public function save()
    {
        $conn = Db:: getConnection();

        $sql = "INSERT INTO Users (firstname, lastname, username, password) VALUES (:firstname, :lastname, :username, :password)";
        $statement = $conn->prepare($sql);
        $firstname = $this->getFirstname();
        $lastname = $this->getLastname();
        $username = $this->getUsername();
        $password = $this->getPassword();

        $statement->bindValue(":firstname", $firstname);
        $statement->bindValue(":lastname", $lastname);
        $statement->bindValue(":username", $username);
        $statement->bindValue(":password", $password);
        $statement->execute();

        return $this;
    }

    public function canLogin()
    {
        $conn = Db::getConnection();

        $sql = "SELECT * FROM users WHERE username = :username LIMIT 1";
        $statement = $conn->prepare($sql);

        $username = $this->getUsername();
        $statement->bindValue(":username", $username);

        $statement->execute();
        $result = $statement->fetch();

        $password = $this->getPassword();
        $hash = $result['password'];
        if (password_verify($password, $hash)) {
            $this->setId($result["id"]);
            return true;
        }else{
            throw new Exception("Username or password is incorrect!");
            return false;
        }
    }

    public function getSessionId($username)
    {
        session_start();
        $conn = Db::getConnection();

        $sql = "SELECT id FROM users WHERE username = :username";
        $statement = $conn->prepare($sql);
        $statement->bindValue(":username", $username);
        $statement->execute();
        $result = $statement->fetch();

        return $result['id'];

    }
 }