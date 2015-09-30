<?php include 'menu.php'; ?>
<div id="content">
    <?php
        $con = db_connect('lucas', '123456789', 'aula_php');
        readAll($con);
        $con->close();
    ?>
</div>
<script type="application/javascript" src="public/js/jquery-2.1.4.min.js"></script>
<script type="application/javascript" src="public/js/utility.js"></script>
