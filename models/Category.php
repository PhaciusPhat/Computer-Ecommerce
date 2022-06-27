<?php
require_once './config/config.php';
class Category
{
    private $db;
    public function __construct()
    {
        $this->db = new Db();
    }

    public function get_all_category()
    {
        $queryString = "SELECT * FROM category";
        $result = $this->db->query_execute($queryString);
        return $result;
    }

    public function get_category_by_id($id)
    {
        $queryString = "SELECT * FROM category WHERE id = $id";
        $result = $this->db->query_execute($queryString);
        return $result;
    }

    public function add_category($name)
    {
        
        $queryString = "INSERT INTO category(name, disable) VALUES ('$name', false);";
        $result = $this->db->query_execute($queryString);
        return $result;
    }

    public function update_category($id, $name)
    {
        $this->db = new Db();
        $queryString = "UPDATE category SET name = '$name' WHERE id = $id";
        $result = $this->db->query_execute($queryString);
        return $result;
    }

    public function delete_category($id, $disable)
    {
        $this->db = new Db();
        $queryString = "UPDATE category SET disable=$disable WHERE id = $id";
        $result = $this->db->query_execute($queryString);
        return $result;
    }
}
