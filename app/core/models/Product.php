<?php

namespace core\models;

use core\services\Connect;
use core\services\Database;

class Product
{
    public $table_name = 'products';

    public $id;
    public $name;
    public $description;
    public $price;
    public $category_id;
    public $category_name;
    public $created;

    public function readProducts()
    {
        $sql = "
            SELECT 
                c.name as category_name,p.id,p.name, p.description,p.price,p.category_id,p.created
            FROM
                ".$this->table_name." p
            LEFT JOIN
                categories c 
                ON p.category_id = c.id
            ORDER BY
                p.created DESC
        ";
        $db = Connect::getInstanse();
        $records = $db->query($sql,[]);
        return $records;
    }
    public function createdProduct()
    {
        $sql = "
            INSERT INTO 
                ".$this->table_name." 
            SET
                name=:name, price=:price,description=:description, category_id=:category_id, created=:created
        ";
        $db = Connect::getInstanse();
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->price= htmlspecialchars(strip_tags($this->price));
        $this->description=htmlspecialchars(strip_tags($this->description));
        $this->category_id = htmlspecialchars(strip_tags($this->category_id));
        $this->created = htmlspecialchars(strip_tags($this->created));

        $db->query($sql,
        [
            ":name"=>$this->name,
            ":price"=>$this->price,
            ":description"=>$this->description,
            ':category_id'=>$this->category_id,
            ':created'=>$this->created
        ]);

        if(!$db)
        {
            return false;
        }
        else {return true;}
    }

    public function aboutOne(int $id)
    {
        $sql = "
            SELECT
                c.name as category_name , p.id, p.name, p.description, p.price, p.category_id, p.created
            FROM
                ".$this->table_name." p
            LEFT JOIN
                categories c
            ON p.category_id = c.id
            WHERE
                p.id= :id
            LIMIT
                0,1
        ";

            $db = Connect::getInstanse();
            $one = $db->query(
                $sql,
                [':id'=>$id]
            );

            return $one ? $one[0]:null;
    }

    public function update($id)
    {
        $sql = "
            UPDATE 
                ".$this->table_name."
            SET
                name = :name,
                price = :price,
                description = :description,
                category_id = :category_id
            WHERE 
                id = :id
        ";

        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->price = htmlspecialchars(strip_tags($this->price));
        $this->description = htmlspecialchars($this->description);
        $this->category_id = htmlspecialchars(strip_tags($this->category_id));
        $this->id = htmlspecialchars(strip_tags($this->id));

        $db = Connect::getInstanse();
        $db->query(
            $sql,
            [
                ':name'=> $this->name,
                ':price'=>$this->price,
                ':description'=>$this->description,
                ':category_id'=>$this->category_id,
                ':id'=>$this->id
            ]
        );
    }

    public function deleteProd($id)
    {
        $sql = "
            DELETE FROM ".$this->table_name." where id = :id
        ";
        $db = Connect::getInstanse();
        $resp = $db->query(
            $sql,
            [':id'=>$id]
        );

    }
}