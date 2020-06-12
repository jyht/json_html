<?php
error_reporting(E_ALL);
set_time_limit(0);
echo "<h2>TCP/IP Connection</h2>\n";

$port = 1935;
$ip = "127.0.0.1";

/*
 +-------------------------------
 *    @socket������������
 +-------------------------------
 *    @socket_create
 *    @socket_connect
 *    @socket_write
 *    @socket_read
 *    @socket_close
 +--------------------------------
 */

$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
if ($socket < 0) {
    echo "socket_create() failed: reason: " . socket_strerror($socket) . "\n";
}else {
    echo "�����ɹ�<br>";
}

$result = socket_connect($socket, $ip, $port);
if ($result < 0) {
    echo "socket_connect() failed.\nReason: ($result) " . socket_strerror($result) . "\n";
}else {
    echo "���ӳɹ�<br>";
}

$in = "����a";
$out = '';

if(!socket_write($socket, $in, strlen($in))) {
    echo "socket_write() failed: reason: " . socket_strerror($socket) . "\n";
}else {
    echo "���͵���������Ϣ�ɹ���\n";
    echo "���͵�����Ϊ:<font color='red'>$in</font> <br>";
}

while($out = socket_read($socket, 8192)) {
    echo "���շ������ش���Ϣ�ɹ���\n";
    echo "���ܵ�����Ϊ:",$out;
}
socket_close($socket);
?>