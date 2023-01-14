<?php
require_once 'database.php';

Class User{
    public $user_email;
    public $user_password;
    public $user_firstname;
    public $user_lastname;
    public $user_type;


    function __construct()
    {
        $this->db = new Database();
    }

    function validate(){
        $sql = "SELECT * FROM users WHERE binary user_email =:user_email and binary user_password = :user_password ;";
        $query=$this->db->connect()->prepare($sql);
        $query->bindParam(':user_email', $this->user_email);
        $query->bindParam(':user_password', $this->user_password);
        if($query->execute()){
            $data = $query->fetch();
        }
        return $data;
    }
  

    
    function add(){
        $sql = "INSERT INTO users (user_id, user_email, user_password, user_firstname, user_lastname, user_type)
        VALUES ('null' ,:user_email, :user_password, :user_firstname, :user_lastname, 'staff');";
        $query=$this->db->connect()->prepare($sql);
        $query->bindParam(':user_email', $this->user_email);
        $query->bindParam(':user_password', $this->user_password);
        $query->bindParam(':user_firstname', $this->user_firstname);
        $query->bindParam(':user_lastname', $this->user_lastname);
        if($query->execute()){
            return true;
        }
        else{
            return false;
        }
    }
}

?>