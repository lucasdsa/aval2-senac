<!DOCTYPE html>
<html>
    <?php
        include 'utility.php';
        
        session_start();
        
        $ui_file = 'default_ui.php';
        
        if (user_active()) {
            
            if (isSuperUser() && isset($_GET['view'])) {
                
                defaultHeader('Gerenciar usuários');
				
				switch ($_GET['view']) {
					
					case 'list':
					    $ui_file = 'super_ui.php';
						break;
				    case 'add':
					    $ui_file = 'add_ui.php';
						break;
					case 'edit':
					    $ui_file = 'edit_ui.php';					
				}
            }
            else {
                
                defaultHeader('Perfil');
            }
    ?>
	<body>
            
	<?php
            include $ui_file;         
        }
        else {
            header('Location: /');
        }         
    ?>
	</body>
</html>
