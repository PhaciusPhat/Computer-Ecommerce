<?php
require_once './config/config.php';
class User
{
    private $name;
    private $email;
    private $phone;
    private $address;
    private $username;
    private $password;

    private $db;

    public function __construct()
    {
    }



    public function register($name, $email, $phone, $address, $username, $password)
    {
        $this->db = new Db();
        $hashPass = md5($password);
        $queryString = "INSERT INTO user(username, password, name, 
        role, email, phone, address) 
        VALUES ('$username', '$hashPass', '$name', FALSE, '$email', 
        '$phone', '$address')";
        $result = $this->db->query_execute($queryString);
        if ($result == false) {
            return false;
        }
        return true;
    }

    public function login($username, $password)
    {
        $this->db = new Db();
        $hashPass = md5($password);
        $queryString = "SELECT * FROM user WHERE username = '$username' AND password = '$hashPass'";
        $result = $this->db->query_execute($queryString);
        if ($result == false) {
            return false;
        }
        return true;
    }
}
