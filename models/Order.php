<?php
require_once './config/config.php';
class Order
{
    private $db;
    public function __construct()
    {
        $this->db = new Db();
    }

    public function get_all_order()
    {
        $queryString = "SELECT * FROM php_project.order";
        $result = $this->db->query_execute($queryString);
        return $result;
    }

    public function create_order($totalPrice, $create_date, $userId, $address)
    {
        $queryString = "INSERT INTO php_project.order(totalPrice, create_date, userId, address) VALUES ($totalPrice, $create_date, $userId, '$address');";
        $result = $this->db->query_execute($queryString);
        return $result;
    }

    public function find_order_by_name_timestamp($id, $timestamp)
    {
        $queryString = "SELECT * FROM php_project.order WHERE userId = $id AND create_date = $timestamp";
        $result = $this->db->query_execute($queryString);
        return $result;
    }

    public function get_order_by_id($id)
    {
        $queryString = "SELECT * FROM php_project.orderdetail WHERE orderId = $id";
        $result = $this->db->query_execute($queryString);
        return $result;
    }

    public function create_order_detail($productId, $orderId, $number, $price)
    {
        $queryString = "INSERT INTO php_project.orderdetail( orderId, productId, number, price) VALUES ($orderId,$productId,  $number, $price);";
        $result = $this->db->query_execute($queryString);
        return $result;
    }

    public function get_order_by_userId($userId)
    {
        $queryString = "SELECT * FROM php_project.order WHERE userId = $userId";
        $result = $this->db->query_execute($queryString);
        return $result;
    }
}
