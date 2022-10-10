<?php
namespace Tayara\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Tayara\DataBase\Db;




class Users
{
    public function createUser(Request $request) {
      
        $req = json_decode($request->getContent(), 1);
       try { 
            // QUERYING DATA
            $query = "INSERT INTO 
            `users`
            ( `username`, `firstname`, `lastname`, `phonenumber`, `whatsapp`, `facebook`, `instagram`, `email`, `password`, `img`) 
            VALUES 
            (?,?,?,?,?,?,?,?,?,?)";
            $data = Db::getInstance()->insertQuery($query, array($req['username'],$req['firstname'],$req['lastname'],$req['phonenumber'],$req['whatsapp'],$req['facebook'],$req['instagram'],$req['email'],$req['password'],$req['img']));
            return new Response("c bon",200);
        } catch(Exception $e) {
            return new Response($e, 400,['Content-Type', 'application/json']);
        }

        
        // SENDING DATA
        return  new Response(json_encode(['insert' => true]),200,['Content-Type', 'application/json']);
       
    }
    public function getUser($id)
    {
        try { 
            // QUERYING DATA
            $query = 'SELECT * FROM users WHERE id = ?';
            $data = Db::getInstance()->query($query, [$id]);
            return  new Response(json_encode($data),200,['Content-Type', 'application/json']);
        } catch(Exception $e) {
            return new Response($e, 400,['Content-Type', 'application/json']);
        }

        // SENDING DATA
        return  new Response(json_encode($data),200,['Content-Type', 'application/json']);
       
        
    }
    public function updateUser($id,Request $request)
    {
        $req = json_decode($request->getContent(), 1);
        try{
            $query = 'UPDATE users SET `username`= ? , `firstname`= ? , `lastname`= ? ,`phonenumber` =?, `whatsapp`= ? , `facebook`= ? , `instagram`= ?, `email`= ?, `password`= ?, `img`= ?  WHERE id=?';
            $data = Db::getInstance()->query($query, array($req['username'],$req['firstname'],$req['lastname'],$req['phonenumber'],$req['whatsapp'],$req['facebook'],$req['instagram'],$req['email'],$req['password'],$req['img'],[$id]));
            return new Response ("badltni cbon",200);
        }catch(Exception $e){
            return new Response($e, 400,['Content-Type', 'application/json']);
        }
        return  new Response(json_encode(['update' => true]),200,['Content-Type', 'application/json']);

    }
}
