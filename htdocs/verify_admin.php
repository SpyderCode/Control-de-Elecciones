<?php
    if($_SESSION['Role']!="Admin"){
        header('Location: Index.html');
    }

?>