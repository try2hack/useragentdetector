<?php
function is_search_engine_crawler() {
    $ip = $_SERVER['REMOTE_ADDR'];
    $ranges = [
        'Google' => ['64.18.0.0/20', '64.233.160.0/19', '66.102.0.0/20', '66.249.64.0/19', '72.14.192.0/18', '74.125.0.0/16', '108.177.8.0/21', '172.217.0.0/16', '209.85.128.0/17', '216.58.192.0/19', '216.239.32.0/19'],
        'Bing' => ['13.104.0.0/14', '40.74.0.0/15', '40.112.0.0/13', '51.104.0.0/15', '52.96.0.0/12', '65.52.0.0/14', '131.253.21.0/24', '131.253.22.0/23', '131.253.24.0/21', '131.253.32.0/20', '157.54.0.0/15', '157.56.0.0/14', '157.60.0.0/16', '167.220.0.0/16', '199.30.16.0/20', '207.46.0.0/16', '207.68.128.0/18']
    ];
    
    foreach ($ranges as $engine => $cidrs) {
        foreach ($cidrs as $cidr) {
            if (ip_in_range($ip, $cidr)) {
                return true;
            }
        }
    }
    return false;
}

function ip_in_range($ip, $cidr) {
    // ฟังก์ชันตรวจสอบ IP อยู่ในช่วงหรือไม่
    list($subnet, $mask) = explode('/', $cidr);
    $ip_long = ip2long($ip);
    $subnet_long = ip2long($subnet);
    $mask_long = ~((1 << (32 - $mask)) - 1);
    return ($ip_long & $mask_long) == ($subnet_long & $mask_long);
}

if (is_search_engine_crawler()) {
    // แสดงเนื้อหาสำหรับบอท
    readfile('cloaked_content.html');
    exit;
}
?>
