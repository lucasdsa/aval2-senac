<!DOCTYPE html>
<html>
    <?php
        include 'utility.php';
        
        session_start();
        
        if (user_active()) {
            
            // Redireciona para página personalizada
            header('Location: environment.php');
        }
        else {
            // Mostra tela de login
            defaultHeader('Início');
    ?>
<body>
    <div id="content">
        <div class="form">
            <form method="POST" action="login.php">
                Login: <input type="text" name="login" /><br />
                Senha: <input type="password" name="senha" /><br />
                <input type="submit" />
            </form>
        </div>
    </div>
</body>
    <?php
        }    
    ?>
</html>
		