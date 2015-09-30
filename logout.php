<?php
    include 'utility.php';
    
    session_start();
    
    if (user_active()) {
        
        logout();
        header('Location: /');
    }
?>