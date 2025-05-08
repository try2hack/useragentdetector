<?php
function is_googlebot() {
    $user_agent = $_SERVER['HTTP_USER_AGENT'] ?? '';
    $ip = $_SERVER['REMOTE_ADDR'] ?? '';
    
    // ตรวจสอบ User Agent
    $is_agent = preg_match('/Googlebot|bingbot|Slurp|DuckDuckBot|Baiduspider|YandexBot/i', $user_agent);
    
    // ตรวจสอบ IP (เพิ่มความแม่นยำ)
    $is_valid_ip = false;
    if ($is_agent) {
        $hostname = gethostbyaddr($ip);
        $is_valid_ip = preg_match('/\.googlebot\.com$|\.google\.com$|\.search\.msn\.com$/i', $hostname);
    }
    
    return $is_agent && $is_valid_ip;
}

if (is_googlebot()) {
    // แสดงเนื้อหาสำหรับบอท
    include 'seo_content.html';
} else {
    // แสดงเนื้อหาจริงสำหรับผู้ใช้ทั่วไป
    include 'real_content.html';
}
?>
