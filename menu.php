<div id="header">
    <div>
        <ul class="menubar">
            <li class="menu">
                <span>Olá, <?php  echo $_SESSION['nome']; ?>!</span>
                <ul class="menulist">
                    <li><a href="/">Início</a></li>
                    
                    <?php if ($_SESSION['super']) { ?>
                    <li><a href="environment.php?view=list">Gerenciar usuários</a></li>
                    <?php } ?>
                    
                    <li><a href="logout.php">Sair</a>
                </ul>
            </li>
        </ul>
    </div>
</div>