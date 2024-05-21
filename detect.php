<?php
function isMobileDevice() {
    $userAgent = $_SERVER['HTTP_USER_AGENT'];
    $mobileAgents = [
        'android', 'webos', 'iphone', 'ipad', 'ipod', 'blackberry', 'iemobile', 'opera mini'
    ];

    foreach ($mobileAgents as $device) {
        if (stripos($userAgent, $device) !== false) {
            return true;
        }
    }
    return false;
}

// การใช้งาน
if (isMobileDevice()) {
    // Redirect ไปที่หน้า B เมื่อเป็นอุปกรณ์มือถือ
    header('Location: https://example.com/pageB');
    exit();
} else {
    // Redirect ไปที่หน้า A เมื่อเป็น desktop device
    header('Location: https://example.com/pageA');
    exit();
}
?>
