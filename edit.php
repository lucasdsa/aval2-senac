<?php
    include 'utility.php';
    
    session_start();
    
    if (user_active() && isSuperUser()) {
	
	    $con = db_connect('lucas', '123456789', 'aula_php');
        
        if (isset($_POST['email']) && isset($_POST['login']) &&
		    isset($_POST['senha']) && isset($_POST['nome'])) 
	    {
	   
            if ($con) {
                
				$nome = $_POST['nome'];
				$login = $_POST['login'];
				$email = $_POST['email'];
				$senha = sha1($_POST['senha']);
				
                $stmt = $con->prepare('UPDATE user SET login = ?, email = ?, nome = ?, senha = ? WHERE email = ?');
                $stmt->bind_param('sssss', $login, $email, $nome, $senha, $email);
                
                if($stmt->execute()) {
                    
                    header('HTTP/1.1 201 OK');
                }
                else {
                    header('HTTP/1.1 204 No content');
                }
                
                $stmt->close();
                $con->close();
            }
        }
		else if (isset($_GET['email'])) {
		    
			if ($con) {
			    
				$email = $_GET['email'];
				$stmt = $con->prepare('SELECT login, nome FROM user WHERE email = ?');
				$stmt->bind_param('s', $email);
				
				if ($stmt->execute()) {
				
				    $stmt->bind_result($login, $nome);
					$stmt->fetch();
?>
<body>
<?php
					defaultheader('Editar usuário');
					include 'edit_ui.php';
?>
    <script type="text/javascript">
	    
		$(document).ready(function () {
		
		    $('#nome').val('<?php echo $nome ?>');
			$('#login').val('<?php echo $login ?>');
			$('#email').val('<?php echo $email ?>');
		});
	</script>
<?php
				}
				else {
				    header('HTTP/1.1 400 Bad Request');
				}
				
				$stmt->close();
				$con->close();
			}
		}
		else {
		
		    if ($con) {
			
			    $result = $con->query('SELECT id FROM');
			}
		}
    }
?>
</body>