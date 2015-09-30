<?php
    include 'utility.php';
    
    session_start();
    
    if (user_active() && isSuperUser()) {
        
        if (isset($_POST['email'])) {
            
            
            $con = db_connect('lucas', '123456789', 'aula_php');
            
            if ($con) {
                
                $stmt = $con->prepare('DELETE FROM user WHERE email = ?');
                $stmt->bind_param('s', $_POST['email']);
                
                if($stmt->execute()) {
                    
                    echo 'Sucesso!';
                }
                else {
                    echo 'Falha';
                }
                
                $stmt->close();
                $con->close();
            }
        }
    }
        
?>