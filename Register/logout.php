<?php


    session_start();
    session_unset();
    session_destroy();
    echo"
        <script>
        window.location.href='http://localhost:3000/Register/index.php';
        </script> 
    ";
      

?>