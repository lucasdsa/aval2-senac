<?php include 'menu.php'; ?>
<div id="content">
    <form id="submitform" method="POST" action="add.php">
	    Nome: <input type="text" name="nome" id="nome" /><br />
	    Login: <input type="text" name="login" id="login" /><br />
		E-mail: <input type="email" name="email" id="email" /><br />
		Senha: <input type="password" name="senha" id="senha" /><br />
		<input type="submit" id="submitadd" />
	</form>
    <p id="status"></p>
</div>
<script type="application/javascript" src="public/js/jquery-2.1.4.min.js"></script>
<script type="application/javascript" src="public/js/utility.js"></script>