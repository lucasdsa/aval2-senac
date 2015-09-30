<!DOCTYPE html>
<html>
    <?php
        include 'utility.php';
        
        session_start();
        
        if (user_active()) {
            
            header('Location: environment.php?view=list');
        }        

        
        if (isset($_POST['login']) &&
            isset($_POST['senha']))
        {
            
            $con = null;
            if ($con = db_connect('lucas', '123456789', 'aula_php')) {
                
                $result = set_user($con, $_POST['login'], $_POST['senha']);
                
                if ($result) {
                    
                    header('Location: environment.php?view=list');
                }
                else {
                    
                    echo 'Login falhou!';
                }
                
                $con->close();
            }
        }

    ?>
</html>