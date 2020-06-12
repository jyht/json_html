<?php
//确保在连接客户端时不会超时
set_time_limit(0);

$ip = '127.0.0.1';
$port = 1935;

/*
 +-------------------------------
 *    @socket通信整个过程
 +-------------------------------
 *    @socket_create
 *    @socket_bind
 *    @socket_listen
 *    @socket_accept
 *    @socket_read
 *    @socket_write
 *    @socket_close
 +--------------------------------
 */

/*----------------    以下操作都是手册上的    -------------------*/
$sock = socket_create(AF_INET,SOCK_STREAM,SOL_TCP);
$ret = socket_bind($sock,$ip,$port);
$ret = socket_listen($sock,4);

$count = 0;

do {
    if (($msgsock = socket_accept($sock)) < 0) {
        echo "socket_accept() failed: reason: " . socket_strerror($msgsock) . "\n";
        break;
    } else {

        //发到客户端
        socket_write($msgsock, $msg, strlen($msg));

        $buf = socket_read($msgsock,8192);


        $talkback = "lai:$buf\n";
        echo $talkback;

        if(++$count >= 5){
            break;
        };


    }
    //echo $buf;
    socket_close($msgsock);

} while (true);

socket_close($sock);
?>