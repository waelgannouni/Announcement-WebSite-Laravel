<?php
namespace Tayara\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Tayara\DataBase\Db;



class Categories
{
    public function getAllCategorie() {
        try{
            $query = 'SELECT * FROM categories';
            $data = Db::getInstance()->query($query, []);
            return  new Response(json_encode($data),200,['Content-Type', 'application/json']);
        } catch(Exception $e) {
            return new Response($e, 500,['Content-Type', 'application/json']);
        }
       
    }
}
