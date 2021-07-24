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
        }

        $last_id = $query->insert_id;
        
        $query->close();

        $query_2=$db->prepare("UPDATE books set available=0 
                        where books.id = (SELECT rent_books.id_books from rent_books where id= ?)");
        $query_2->bind_param('i',$last_id);
        $query_2->execute();

        if ($query_2->affected_rows === 0) {
            header('Location: http://localhost:8888/biblioteca/rent-insert.php?stato=ko');
            exit;
        }

        header('Location: http://localhost:8888/biblioteca/rent-insert.php?stato=ok');
        exit;
    
    }

    // SELECT rent_books.rent_start,rent_books.rent_end,users.name,users.surname,books.title from rent_books  
    //     inner join books on rent_books.id_books= books.id
    //     inner join users on rent_books.id_users=users.id;

    public static function showRents($data=null){


        $db = connect();

        if (isset($data['id'])) {
            $data['id'] = intval($data['id']);
            $query      = $db->prepare("SELECT rent_books.id,rent_books.rent_start,rent_books.rent_end,users.name,users.surname,books.title,books.available
                            from rent_books  
                            inner join books on rent_books.id_books= books.id
                            inner join users on rent_books.id_users=users.id
                            where users.id= ? AND is_back=0");
            $query->bind_param('i', $data['id'],);
            $query->execute();
            $query = $query->get_result();
        } else {
            $query = $db->query("SELECT rent_books.id,rent_books.rent_start,rent_books.rent_end,users.name,users.surname,books.title,books.available
                    from rent_books  
                    inner join books on rent_books.id_books= books.id
                    inner join users on rent_books.id_users=users.id
                    where is_back=0");
        }

        

        $results = array();

        while ($row = $query->fetch_assoc()) {
            $results[] = $row;
        }

        return $results;
    }

    public static function closeRent($id){

        $db= connect();

        if ( $id ) {

            $id = intval($id);
    
            $query = $db->prepare('UPDATE rent_books SET is_back=1  WHERE id = ?');
            $query->bind_param('i', $id);
            $query->execute();

            $query_2=$db->prepare("UPDATE books set available=1
                            where books.id = (SELECT rent_books.id_books from rent_books where id= ?)");
            $query_2->bind_param('i',$id);
            $query_2->execute();
    
            if ($query->affected_rows > 0) {
                header('Location: http://localhost:8888/biblioteca/all-rents.php?statocanc=ok');
                exit;
            } else {
                header('Location: http://localhost:8888/biblioteca/all-rents.php?statocanc=ko');
                exit;
            }
        }
    }
}