<?php
namespace Biblos;

include __DIR__ .'/Db.php';

class Book{

    public static function insertBook($data){


        //isbn è un codice di 13 cifre, crea un regex per controllarlo e settalo a char di 13 controlla i -;
        
        $data=array(
            'ISBN'=>$data['ISBN'],
            'title'=>$data['title'],
            'description'=>$data['description'],
            'cover'=>$data['cover'],
            'price'=>$data['price'],
            'published_year'=>$data['published_year'],
            'editor'=>$data['editor'],
            'available'=>$data['available'],
            'author_name'=>$data['author_name'],
            'author_bio'=>$data['author_bio'],
        );

        $db=connect();

        $query = $db->prepare('INSERT INTO books(ISBN,title,description,cover,price,published_year,editor,available,author_name,author_bio) 
        VALUES (?,?,?,?,?,?,?,?,?,?)');
        $query->bind_param('isssiisiss',$data['ISBN'],$data['title'],$data['description'],$data['cover'],$data['price'],
                            $data['published_year'],$data['editor'],$data['available'],$data['author_name'],$data['author_bio']);
        $query->execute();

        if ($query->affected_rows === 0) {
            error_log('Errore MySQL: ' . $query->error_list[0]['error']);
            header('Location: http://localhost:8888/biblioteca/book-insert.php?stato=ko');
            exit;
        }else{
            
            header('Location: http://localhost:8888/biblioteca/book-insert.php?stato=ok');
            exit;
        }

        $query->close();

    }

    public static function selectBook($data=null){

        $db=connect();

        if (isset($data['id'])) {
            $data['id'] = intval($data['id']);
            $query      = $db->prepare('SELECT * FROM books WHERE books.id = ?');
            $query->bind_param('i', $data['id'],);
            $query->execute();
            $query = $query->get_result();
        } else {
            $query = $db->query('SELECT * FROM books');
        }

        $results = array();

        while ($row = $query->fetch_assoc()) {
            $results[] = $row;
        }

        return $results;

    }

    public static function updateBook(){

    }

    public static function deleteBook($id = null){

        $db= connect();

        if ( $id ) {

            $id = intval($id);
    
            $query = $db->prepare('DELETE FROM books WHERE id = ?');
            $query->bind_param('i', $id);
            $query->execute();
    
            if ($query->affected_rows > 0) {
                header('Location: http://localhost:8888/biblioteca/?statocanc=ok');
                exit;
            } else {
                header('Location: http://localhost:8888/biblioteca/?statocanc=ko');
                exit;
            }
        }

    }

 
}