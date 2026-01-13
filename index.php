<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: /views/login/index.php");
} else {
    header("Location: /views/home/index.php");
}
