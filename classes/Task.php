<?php
include_once(__DIR__ . "/Db.php");

class Task {
    private $id;
    private $title;
    private $description;
    private $hoursneeded;
    private $deadline;
    private $done;
    private $list_id;
    private $user_id;
    private $comment_id;

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
     * Get the value of title
     */ 
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @return  self
     */ 
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of description
     */ 
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */ 
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of hoursneeded
     */ 
    public function getHoursneeded()
    {
        return $this->hoursneeded;
    }

    /**
     * Set the value of hoursneeded
     *
     * @return  self
     */ 
    public function setHoursneeded($hoursneeded)
    {
        $this->hoursneeded = $hoursneeded;

        return $this;
    }

    /**
     * Get the value of deadline
     */ 
    public function getDeadline()
    {
        return $this->deadline;
    }

    /**
     * Set the value of deadline
     *
     * @return  self
     */ 
    public function setDeadline($deadline)
    {
        $this->deadline = $deadline;

        return $this;
    }

    /**
     * Get the value of done
     */ 
    public function getDone()
    {
        return $this->done;
    }

    /**
     * Set the value of done
     *
     * @return  self
     */ 
    public function setDone($done)
    {
        $this->done = $done;

        return $this;
    }

    /**
     * Get the value of list_id
     */ 
    public function getList_id()
    {
        return $this->list_id;
    }

    /**
     * Set the value of list_id
     *
     * @return  self
     */ 
    public function setList_id($list_id)
    {
        $this->list_id = $list_id;

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
     * Get the value of comment_id
     */ 
    public function getComment_id()
    {
        return $this->comment_id;
    }

    /**
     * Set the value of comment_id
     *
     * @return  self
     */ 
    public function setComment_id($comment_id)
    {
        $this->comment_id = $comment_id;

        return $this;
    }

    public function saveTask()
    {
        $conn = Db::getConnection();

        $sql = "INSERT INTO Todo (title, description, hours_needed, deadline, done, list_id, user_id) VALUES (:title, :description, :hours_needed, :deadline, :done, :list_id, :user_id)";
        $statement = $conn->prepare($sql);
        $title = $this->getTitle();
        $description = $this->getDescription();
        $hours_needed = $this->getHoursneeded();
        $deadline = $this->getDeadline();
        $done = 0;
        $list_id = $this->getList_id();
        $user_id = $this->getUser_id();

        $statement->bindValue(":title", $title);
        $statement->bindValue(":description", $description);
        $statement->bindValue(":hours_needed", $hours_needed);
        $statement->bindValue(":deadline", $deadline);
        $statement->bindValue(":done", $done);
        $statement->bindValue(":list_id", $list_id);
        $statement->bindValue(":user_id", $user_id);

        return $statement->execute();
    }

    public function getAllTasks($id)
    {
        $conn = Db::getConnection();

        $sql = "SELECT * FROM Todo WHERE list_id = $id";
        $statement = $conn->prepare($sql);
        $statement->execute();

        return $statement->fetchAll();  
    }
}