<?php
namespace Biblos;

include __DIR__ .'/Db.php';

class Rent{

    // insert into rent_books(id_books,id_users,rent_start,rent_end) values (
    // (SELECT books.id from biblioteca_giu.books where title='TestS'),
    // (SELECT users.id from biblioteca_giu.users where email = 'test@test.it'),
    // '2021-07-13',
    // '2121-07-31');

    public static function validDataRent($input){
        return  implode('-', array_reverse(explode('/',$input)));
    }

    public static function insertRent($data){

        $data=array(
            'title'=>$data['title'],
            'email'=>$data['email'],
            'rent_start'=>$data['rent_start'],
            'rent_end'=>$data['rent_end'],
        );

        $data['rent_start'] = self::validDataRent($data['rent_start']);
        $data['rent_end'] = self::validDataRent($data['rent_end']);


        $db=connect();

        $query= $db->prepare("INSERT into rent_books(id_books,id_users,rent_start,rent_end) VALUES (
            (SELECT books.id from biblioteca_giu.books where title = ?),
            (SELECT users.id from biblioteca_giu.users where email = ?),
              ?,? )");
           
        $query->bind_param('ssss',$data['title'],$data['email'],$data['rent_start'],$data['rent_end']);
        $query->execute();

        if ($query->affected_rows === 0) {
            error_log('Errore MySQL: ' . $query->error_list[0]['error']);
            header('Location: http://localhost:8888/biblioteca/rent-insert.php?stato=ko');
            exit;
        }else{
            
            header('Location: http://localhost:8888/biblioteca/rent-insert.php?stato=ok');
            exit;
        }

        $query->close();
    }

    // SELECT rent_books.rent_start,rent_books.rent_end,users.name,users.surname,books.title from rent_books  
    //     inner join books on rent_books.id_books= books.id
    //     inner join users on rent_books.id_users=users.id;

    public static function showRents($data=null){


        $db = connect();

        if (isset($data['id'])) {
            $data['id'] = intval($data['id']);
            $query      = $db->prepare("SELECT rent_books.id,rent_books.rent_start,rent_books.rent_end,users.name,users.surname,books.title from rent_books  
                            inner join books on rent_books.id_books= books.id
                            inner join users on rent_books.id_users=users.id
                            where users.id= ?");
            $query->bind_param('i', $data['id'],);
            $query->execute();
            $query = $query->get_result();
        } else {
            $query = $db->query("SELECT rent_books.id,rent_books.rent_start,rent_books.rent_end,users.name,users.surname,books.title from rent_books  
                    inner join books on rent_books.id_books= books.id
                    inner join users on rent_books.id_users=users.id");
        }

        

        $results = array();

        while ($row = $query->fetch_assoc()) {
            $results[] = $row;
        }

        return $results;
    }
}