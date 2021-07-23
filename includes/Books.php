<?php
namespace Biblos;

include __DIR__ .'/Db.php';

class Book{

    public static function cleanInput($input)
    {
        $input = trim($input);
        $input = filter_var($input, FILTER_SANITIZE_ADD_SLASHES);
        $input = filter_var($input, FILTER_SANITIZE_SPECIAL_CHARS);
        return $input;
    }

    //la regex funziona ma non mi da errori di conf, cercare il modo di comunicare error in inserimento
    public static function isISBNvalid($isbn){
       	
        return preg_match('/^[0-9]*[-| ][0-9]*[-| ][0-9]*[-| ][0-9]*[-| ][0-9]*$/', $isbn);
    }



    protected static function sanitize($fields)
    {
         $errors        = array();
         $fields['ISBN'] = self::cleanInput($fields['ISBN']);
        if (self::isISBNvalid($fields['ISBN']) === 0) {
            $errors[] = new \Exception('ISBN non valido');
        }
        $fields['title'] = self::cleanInput($fields['title']);

        $fields['description'] = self::cleanInput($fields['description']);
     
        $fields['editor'] = self::cleanInput($fields['editor']); 

        $fields['author_name'] = self::cleanInput($fields['author_name']);

        $fields['author_bio'] = self::cleanInput($fields['author_bio']);

        if (count($errors) > 0) {
            return $errors;
        }

        return $fields;
    }


    public static function insertBook($data){

        
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

        $data = self::sanitize($data);

        $db=connect();

        $query = $db->prepare('INSERT INTO books(ISBN,title,description,cover,price,published_year,editor,available,author_name,author_bio) 
        VALUES (?,?,?,?,?,?,?,?,?,?)');
        $query->bind_param('ssssiisiss',$data['ISBN'],$data['title'],$data['description'],$data['cover'],$data['price'],
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

    public static function updateBook($data,$id){

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
        
        $data = self::sanitize($data);

        if ($data) {
            
            $db= connect();

            $id          = intval($id);
            $is_in_error = false;

            try {
                $query = $db->prepare('UPDATE books 
                SET ISBN = ?,title = ?, description = ?, cover = ?,price = ?,published_year = ?,editor = ?,available = ?,
                author_name = ?, author_bio = ? WHERE id = ?');
                if (is_bool($query)) {
                    throw new \Exception('Query non valida. $mysqli->prepare ha restituito false.');
                }
                $query->bind_param('ssssiisissi',$data['ISBN'],$data['title'],$data['description'],$data['cover'],$data['price'],
                        $data['published_year'],$data['editor'],$data['available'],$data['author_name'],$data['author_bio'],$id);

                $query->execute();

            } catch (\Exception $e) {
                error_log("Errore PHP in linea {$e->getLine()}: " . $e->getMessage() . "\n", 3, 'my-errors.log');
            }

            if (! is_bool($query)) {
                if (count($query->error_list) > 0) {
                    $is_in_error = true;
                    foreach ($query->error_list as $error) {
                        error_log("Errore MySQL n. {$error['errno']}: {$error['error']} \n", 3, 'my-errors.log');
                    }
                    header('Location: http://localhost:8888/biblioteca/edit-book.php?id=' . $id . '&stato=ko');
                    exit;
                }
            }

            $stato = $is_in_error ? 'ko' : 'ok';
            header('Location: http://localhost:8888/biblioteca/detail-book.php?id=' . $id . '&stato=' . $stato);
            exit;

        }
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