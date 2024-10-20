<?php
    session_start();

    function redirection($url) {
        header("Location: $url");
        exit();
    }

    function chiffrerMdp($password) {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    function verifierMdp($password, $hash) {
        return password_verify($password, $hash);
    }
?>