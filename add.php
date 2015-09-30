<?php
    include 'utility.php';
    
    session_start();
    
    if (user_active() && isSuperUser()) {
        
        if (isset($_POST['email']) && isset($_POST['login']) &&
		    isset($_POST['senha']) && isset($_POST['nome'])) 
	   {
            
            
            $con = db_connect('lucas', '123456789', 'aula_php');
            
            if ($con) {
                
				$nome = $_POST['nome'];
				$login = $_POST['login'];
				$email = $_POST['email'];
				$senha = sha1($_POST['senha']);
				
                $stmt = $con->prepare('INSERT INTO user(login, email, nome, senha) VALUES(?, ?, ?, ?)');
                $stmt->bind_param('ssss', $login, $email, $nome, $senha);
                
                if($stmt->execute()) {
                    
                    header('HTTP/1.1 201 Created');
                }
                else {
                    header('HTTP/1.1 409 Conflict');
                }
                
                $stmt->close();
                $con->close();
            }
        }
    }
        
?>