<?php
namespace Tayara\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Tayara\DataBase\Db;


class Annonces
{
    public function create(Request $request) {
      
        $req = json_decode($request->getContent(), 1);
       try { 
            // QUERYING DATA
            $query = "INSERT INTO 
            `annonces`
            ( `title`, `Description`, `Date`, `Specifications`, `Categorie`, `Conditions`, `Brand`, `img`, `price`, `userid`) 
            VALUES 
            (?,?,?,?,?,?,?,?,?,?)";
            $data = Db::getInstance()->insertQuery($query, array($req['title'],$req['Description'],$req['Date'],$req['Specifications'],$req['Categorie'],$req['Conditions'],$req['Brand'],$req['img'],$req['price'],$req['userid']));
            return new Response("c bon",200);
        } catch(Exception $e) {
            return new Response($e, 400,['Content-Type', 'application/json']);
        }

        
        // SENDING DATA
        return  new Response(json_encode(['insert' => true]),200,['Content-Type', 'application/json']);
       
    }
    public function getAll() {
        try{
            $query = 'SELECT * FROM annonces';
            $data = Db::getInstance()->query($query, []);
            return  new Response(json_encode($data),200,['Content-Type', 'application/json']);
        } catch(Exception $e) {
            return new Response($e, 500,['Content-Type', 'application/json']);
        }
       
    }
    public function getAd($id)
    {
        try { 
            // QUERYING DATA
            $query = 'SELECT * FROM annonces WHERE id = ?';
            $data = Db::getInstance()->query($query, [$id]);

        } catch(Exception $e) {
            return new Response($e, 400,['Content-Type', 'application/json']);
        }

        // SENDING DATA
        return  new Response(json_encode($data),200,['Content-Type', 'application/json']);
       
        
    }
    public function deleteAd($id)
    {
        try { 
            // QUERYING DATA
            $query = 'DELETE FROM annonces WHERE id = ?';
            $data = Db::getInstance()->query($query,[$id]);
            return new Response ("fasa5tni cbon",201);
        } catch(Exception $e) {
            return new Response($e, 400,['Content-Type', 'application/json']);
        }

        // SENDING DATA
        return  new Response(json_encode($data),200,['Content-Type', 'application/json']);
       
        
    }
    public function UpdateAd($id,Request $request)
    {
        $req = json_decode($request->getContent(), 1);
        try{
            $query = 'UPDATE annonces SET title= ? , Description= ? , Date= ? , Specifications= ? , Conditions= ?, Brand= ?, img= ?, price= ? WHERE id=?';
            $data = Db::getInstance()->query($query, array($req['title'],$req['Description'],$req['Date'],$req['Specifications'],$req['Conditions'],$req['Brand'],$req['img'],$req['price'],[$id]));
            return new Response ("badlha aman",200);
        }catch(Exception $e){
            return new Response($e, 400,['Content-Type', 'application/json']);
        }
        return  new Response(json_encode(['update' => true]),200,['Content-Type', 'application/json']);

    }
   
}

