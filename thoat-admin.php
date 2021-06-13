<?php
    session_start();
    if( isset($_SESSION['admin-id']))
    {
        unset($_SESSION['admin-id']);
        unset($_SESSION['admin-name']);
    }
    header("Location: /");exit();
?>