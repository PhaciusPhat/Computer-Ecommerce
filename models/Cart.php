<?php
require_once './config/config.php';
class Cart
{
    private $db;
    public function __construct()
    {
        $this->db = new Db();
    }

    public function get_cart()
    {
        $queryString = "SELECT * FROM cart";
        $result = $this->db->query_execute($queryString);
        return $result;
    }

    public function add_cart($userId, $productId, $number)
    {
        $queryString = "INSERT INTO cart(userId, productId, number) VALUES ($userId, $productId, $number);";
        $result = $this->db->query_execute($queryString);
        return $result;
    }

    public function update_cart($userId, $productId, $number)
    {
        $queryString = "UPDATE cart SET number = number + $number WHERE userId = $userId and productId = $productId";
        $result = $this->db->query_execute($queryString);
        return $result;
    }

    public function delete_cart($userId, $productId)
    {
        $queryString = "DELETE FROM cart WHERE userId = $userId and productId = $productId";
        $result = $this->db->query_execute($queryString);
        return $result;
    }

}
