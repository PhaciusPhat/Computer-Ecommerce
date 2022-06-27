<?php
require_once './config/config.php';
class Product
{
    private $db;
    public function __construct()
    {
        $this->db = new Db();
    }

    public function get_all_product()
    {
        $queryString = "SELECT * FROM product";
        $result = $this->db->query_execute($queryString);
        return $result;
    }

    public function update_number_product($id, $minusNumber){
        $queryString = "UPDATE product SET number = $minusNumber WHERE id = $id";
        $result = $this->db->query_execute($queryString);
        return $result;
    }

    public function get_all_enable_product()
    {
        $queryString = "SELECT * FROM product where isDisable = 0";
        $result = $this->db->query_execute($queryString);
        return $result;
    }

    public function get_all_product_by_cate_id($id)
    {
        $queryString = "SELECT * FROM product where cateId = $id and isDisable = 0";
        $result = $this->db->query_execute($queryString);
        return $result;
    }

    public function get_product_by_id($id)
    {
        $queryString = "SELECT * FROM product WHERE id = $id";
        $result = $this->db->query_execute($queryString);
        return $result;
    }

    public function add_product($name, $number, $image, $price, $cateId)
    {
        $queryString = "INSERT INTO product(name, number,  price, image, cateId, isDisable) VALUES ('$name', '$number',  '$price', '$image', '$cateId', FALSE);";
        $result = $this->db->query_execute($queryString);
        return $result;
    }

    public function update_product($id, $name, $number, $price, $image,  $cateId)
    {
        $this->db = new Db();
        $queryString = "UPDATE product SET name = '$name', number = '$number', image = '$image', price = '$price', cateId = '$cateId' WHERE id = $id";
        $result = $this->db->query_execute($queryString);
        return $result;
    }

    public function delete_product($id, $disable)
    {
        $this->db = new Db();
        $queryString = "UPDATE product SET isDisable = $disable WHERE id = $id";
        $result = $this->db->query_execute($queryString);
        return $result;
    }
}
