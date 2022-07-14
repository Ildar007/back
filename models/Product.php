<?php

class Product extends Database
{
  private $db;
  public function __construct()
  {
    $this->db = new Database;
  }
  public function getProducts()
  {
    $this->db->query('SELECT * FROM products ORDER BY id DESC');
    $result = $this->db->resultSet();
    return $result;
  }
  public function checkItem($sku)
  {
    $this->db->query('SELECT * FROM products WHERE sku = :sku');
    $this->db->bind(':sku', $sku);
    $rowCount = $this->db->rowCount();
    return $rowCount;
  }

  public function addProduct($data)
  {
    $this->db->query('INSERT INTO products(sku, name, price, attribute, attribute_content) VALUES (:sku, :name, :price, :attribute, :attribute_content)');
    $this->db->bind(':sku', $data['sku']);
    $this->db->bind(':name', $data['name']);
    $this->db->bind(':price', $data['price']);
    $this->db->bind(':attribute', $data['attribute']);
    $this->db->bind(':attribute_content', $data['attribute_content']);

    //execute 
    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }

  //delete a post
  public function deleteProducts($ids)
  {
    $this->db->query("DELETE FROM products WHERE id IN ($ids)");
    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }
}
