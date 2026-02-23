<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (array_key_exists("flash", $_SESSION)) {
    $message = $_SESSION["flash"]["message"];
    $type = $_SESSION["flash"]["type"];
    echo "<div class='alert alert-$type'>$message</div>";

    unset($_SESSION["flash"]);
}
