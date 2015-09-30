<?php
    
    function user_active() {
        
        return (isset($_SESSION['nome']) && 
                isset($_SESSION['super']));
    }
    
    function set_user($mysqli, $nome, $senha) {
        
        $result = false;
        
        $senha = sha1($senha);
        $stmt = $mysqli->prepare('SELECT nome, super FROM user WHERE login = ? AND senha = ?');
        $stmt->bind_param('ss', $nome, $senha);
        
        if ($stmt->execute()) {
            
            $stmt->bind_result($nome, $super);
            $stmt->fetch();
            
            $_SESSION['nome'] = $nome;
            $_SESSION['super'] = $super;
            
            $result = true;
        }
        
        echo $stmt->num_rows;
        $stmt->close();
        
        return $result;
    }
    
    function db_connect($login, $senha, $database) {
        
        $mysqli = new mysqli('localhost', $login, $senha, $database);
        
        if ($mysqli->connect_errno) {
        
            return false;
        }
        
        return $mysqli;        
    }
    
    function defaultHeader($title) {
        
        echo '<head><title>' . $title . '</title>' .
             '<meta charset="utf-8" />' . 
             '<link rel="stylesheet" href="public/css/style.css" /></head>';
    }    
    
    function logout() {
        
        unset($_SESSION['nome']);
        unset($_SESSION['super']);
    }
    
    // Utilizada em cada consulta ao banco
    function isSuperUser() {
        
        return $_SESSION['super'];
    }
    
    // Funcionalidades disponíveis apenas para super usuários ($_SESSION['super'] == true)
    function create($login, $email, $nome, $senha) {
        
    }
    
    function delete($login) {
        
    }
    
    // Lê os usuários existentes no banco
    function readAll($con) {
        
        if ($result = $con->query('SELECT nome, email FROM user')) {
            
            if ($row = $result->fetch_assoc()) {
                
                echo '<table>';
                
                foreach ($row as $key => $value) {
                    
                    echo '<th>' . $key . '</th>';
                }
                echo '<td><button id="add" type="button">Adicionar</button></td>';
                echo '</tr>';
                
                // Exibe os campos
                do  {
                
                    echo '<tr>';
                
                    foreach ($row as $key => $value) {
                    
                        echo '<td class="'. $key . '">' . $value . '</td>';
                    }
                    echo '<td><button class="edit" type="button">Editar</button>';
                    echo '<button class="remove" type="button">Remover</button></td>';
                    echo '</tr>';
                    
                } while ($row = $result->fetch_assoc());
                
                echo '</table>';
            }
            
            $result->close();
        }
    }
    
    function update($login, $email, $nome, $senha) {
        
    }
?>