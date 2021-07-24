<?php
namespace Biblos;

include __DIR__ .'/Db.php';

class Users{

    public static function cleanInput($input)
    {
        $input = trim($input);
        $input = filter_var($input, FILTER_SANITIZE_ADD_SLASHES);
        $input = filter_var($input, FILTER_SANITIZE_SPECIAL_CHARS);
        return $input;
    }

    public static function isEmailAddressValid($email_address)
    {
        return filter_var($email_address, FILTER_VALIDATE_EMAIL);
    }
    
    protected static function sanitize($fields)
    {
        if (isset($fields['email']) && $fields['email'] !== '') {
            $fields['email'] = self::cleanInput($fields['email']);
            if (! self::isEmailAddressValid($fields['email'])) {
                $errors[] = new \Exception('Indirizzo email non valido.');
            }
        }
    
        return $fields;
    }

    
    public static function registerUser($data)
    {
        
        $fields = array(
            'name'        => $data['name'],
            'surname'        => $data['surname'],
            'email'        => $data['email'],
            'password'        => $data['password'],
            'password-check'  => $data['password-check']
        );
        
        $fields = self::sanitize($fields);
        
        if ($fields['password'] !== $fields['password-check']) {
            
            header('Location: http://localhost:8888/biblioteca/register-user.php?stato=errore&messages=Le password non corrispondono');
            exit;
            
        }
        
        $db=connect();
        
        $query_user = $db->query("SELECT email FROM users WHERE email = '" . $fields['email'] . "'");
        
        if ($query_user->num_rows > 0) {
            header('Location: http://localhost:8888/biblioteca/register-user.php?stato=errore&messages=Email già presente');
            exit;
        }
        
        $query_user->close();
        
        $query = $db->prepare('INSERT INTO users(name,surname,email, password) VALUES (?,?,?, MD5(?))');
        $query->bind_param('ssss', $fields['name'], $fields['surname'], $fields['email'], $fields['password']);
        $query->execute();
        
        if ($query->affected_rows === 0) {
            error_log('Error MySQL: ' . $query->error_list[0]['error']);
            header('Location: http://localhost:8888/biblioteca/register-user.php?stato=ko');
            exit;
        }
        
        header('Location: http://localhost:8888/biblioteca/register-user.php?stato=ok');
        exit;
    }

    public static function showUsers(){

        $db = connect();

        $query = $db->query("SELECT * FROM users");

        $results = array();

        while ($row = $query->fetch_assoc()) {
            $results[] = $row;
        }

        return $results;
    }
}