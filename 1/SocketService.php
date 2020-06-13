<?php
$host = "127.0.0.1";
// 指定监听的端口，注意该端口不能与现有应用的端口冲突
$port = '9000';
$null = null;
// 创建Socket。AF_INET：代表通信时使用IPv4协议；SOCK_STREAM：代表传输的数据是二进制流数据；SOL_TCP：代表底层使用的协议是TCP
$socket = socket_create ( AF_INET, SOCK_STREAM, SOL_TCP );
// 指定Socket相应的属性。SOL_SOCKET：设定协议的等级；SO_REUSEADDR：设置端口释放之后可以立即被使用
socket_set_option ( $socket, SOL_SOCKET, SO_REUSEADDR, 1 );
// 绑定端口
socket_bind ( $socket, 0, $port );
// 监听端口
socket_listen ( $socket );
// 声明一个数组，用于存放所有的客户端连接
$clients = array (
        $socket 
);
while ( true ) {
    $changed_socket = $clients;
    // 在当前数组中获取活跃的Socket连接，即当前正在发送请求的连接或正在传输数据的连接等
    socket_select ( $changed_socket, $null, $null, 0, 10 );
    // 判断当前的Socket是否为活跃的Socket，如果是，说明客户端在请求连接
    if (in_array ( $socket, $changed_socket )) {
        echo "client connecting";
        // 接受连接
        $socket_new = socket_accept ( $socket );
        $clients [] = $socket_new;
        // 发送握手信息
        $header = socket_read ( $socket_new, 1024 );
        perform_handshaking ( $header, $socket_new, $host, $port );
        // 在连接成功后，当前Socket要从活跃Socket列表中删除，否则会陷入死循环
        $key = array_search ( $socket, $changed_socket );
        unset ( $changed_socket [$key] );
    } else {
        // 不是新连接，是客户端在发送数据
        // 服务器开始读取客户端发送的数据
        foreach ( $changed_socket as $v ) {
            while ( socket_recv ( $v, $buf, 1024, 0 ) >= 1 ) {
                // 解包数据
                $received_text = unmask ( $buf );
                // 将数据解包后转成JSON对象
                $msgJson = json_decode ( $received_text );
                // 读取数据
                $namer = $msgJson->namer;
                $content = $msgJson->content;
                // 将数据进行编码
                $message = mask ( json_encode ( [ 
                        'namer' => $namer,
                        'content' => $content,
                        'type' => 'usermsg' 
                ] ) );
                // 广播编码后的数据。服务器进行广播的消息会触发客户端的onmessage事件
                send_message ( $message );
                // 跳出foreach循环
                break 2;
            }
            // 删除已经关闭的Socket
            $buf = @socket_read ( $v, 1024, PHP_NORMAL_READ );
            if ($buf === false) {
                $key = array_search ( $v, $clients );
                socket_getpeername ( $v, $ip );
                unset ( $clients [$key] );
                $msg = mask ( json_encode ( [ 
                        'type' => 'system',
                        'content' => $ip . "已经下线。" 
                ] ) );
                send_message ( $msg );
            }
        }
    }
}
// 发送消息的方法
function send_message($msg) {
    global $clients;
    foreach ( $clients as $changed_socket ) {
        @socket_write ( $changed_socket, $msg, strlen ( $msg ) );
    }
    return true;
}
// 以下3个函数，我们只需了解总体结构即可。在有需要时可以直接使用
// 解码数据。服务器解码客户端发送过来的数据
function unmask($text) {
    $length = ord ( $text [1] ) & 127;
    if ($length == 126) {
        $masks = substr ( $text, 4, 4 );
        $data = substr ( $text, 8 );
    } elseif ($length == 127) {
        $masks = substr ( $text, 10, 4 );
        $data = substr ( $text, 14 );
    } else {
        $masks = substr ( $text, 2, 4 );
        $data = substr ( $text, 6 );
    }
    $text = "";
    for($i = 0; $i < strlen ( $data ); ++ $i) {
        $text .= $data [$i] ^ $masks [$i % 4];
    }
    return $text;
}
// 编码数据。在服务器向客户端发送数据时需要将数据打包
function mask($text) {
    $b1 = 0x80 | (0x1 & 0x0f);
    $length = strlen ( $text );
    if ($length <= 125) {
        $header = pack ( 'CC', $b1, $length );
    } elseif ($length > 125 && $length < 65536) {
        $header = pack ( 'CCn', $b1, 126, $length );
    } elseif ($length >= 65536) {
        $header = pack ( 'CCNN', $b1, 127, $length );
    }
    return $header . $text;
}

// 握手的逻辑。客户端与服务端相互识别的过程
function perform_handshaking($receved_header, $client_conn, $host, $port) {
    $headers = array ();
    $lines = preg_split ( "/\r\n/", $receved_header );
    foreach ( $lines as $line ) {
        $line = chop ( $line );
        if (preg_match ( '/\A(\S+): (.*)\z/', $line, $matches )) {
            $headers [$matches [1]] = $matches [2];
        }
    }
    $secKey = $headers ['Sec-WebSocket-Key'];
    $secAccept = base64_encode ( pack ( 'H*', sha1 ( $secKey . '258EAFA5-E914-47DA-95CA-C5AB0DC85B11' ) ) );
    $upgrade = "HTTP/1.1 101 Web Socket Protocol Handshake\r\n" . "Upgrade: websocket\r\n" . "Connection: Upgrade\r\n" . "WebSocket-Origin: $host\r\n" . "Sec-WebSocket-Accept:$secAccept\r\n\r\n";
    socket_write ( $client_conn, $upgrade, strlen ( $upgrade ) );
}