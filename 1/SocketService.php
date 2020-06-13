<?php
$host = "127.0.0.1";
// ָ�������Ķ˿ڣ�ע��ö˿ڲ���������Ӧ�õĶ˿ڳ�ͻ
$port = '9000';
$null = null;
// ����Socket��AF_INET������ͨ��ʱʹ��IPv4Э�飻SOCK_STREAM��������������Ƕ����������ݣ�SOL_TCP������ײ�ʹ�õ�Э����TCP
$socket = socket_create ( AF_INET, SOCK_STREAM, SOL_TCP );
// ָ��Socket��Ӧ�����ԡ�SOL_SOCKET���趨Э��ĵȼ���SO_REUSEADDR�����ö˿��ͷ�֮�����������ʹ��
socket_set_option ( $socket, SOL_SOCKET, SO_REUSEADDR, 1 );
// �󶨶˿�
socket_bind ( $socket, 0, $port );
// �����˿�
socket_listen ( $socket );
// ����һ�����飬���ڴ�����еĿͻ�������
$clients = array (
        $socket 
);
while ( true ) {
    $changed_socket = $clients;
    // �ڵ�ǰ�����л�ȡ��Ծ��Socket���ӣ�����ǰ���ڷ�����������ӻ����ڴ������ݵ����ӵ�
    socket_select ( $changed_socket, $null, $null, 0, 10 );
    // �жϵ�ǰ��Socket�Ƿ�Ϊ��Ծ��Socket������ǣ�˵���ͻ�������������
    if (in_array ( $socket, $changed_socket )) {
        echo "client connecting";
        // ��������
        $socket_new = socket_accept ( $socket );
        $clients [] = $socket_new;
        // ����������Ϣ
        $header = socket_read ( $socket_new, 1024 );
        perform_handshaking ( $header, $socket_new, $host, $port );
        // �����ӳɹ��󣬵�ǰSocketҪ�ӻ�ԾSocket�б���ɾ���������������ѭ��
        $key = array_search ( $socket, $changed_socket );
        unset ( $changed_socket [$key] );
    } else {
        // ���������ӣ��ǿͻ����ڷ�������
        // ��������ʼ��ȡ�ͻ��˷��͵�����
        foreach ( $changed_socket as $v ) {
            while ( socket_recv ( $v, $buf, 1024, 0 ) >= 1 ) {
                // �������
                $received_text = unmask ( $buf );
                // �����ݽ����ת��JSON����
                $msgJson = json_decode ( $received_text );
                // ��ȡ����
                $namer = $msgJson->namer;
                $content = $msgJson->content;
                // �����ݽ��б���
                $message = mask ( json_encode ( [ 
                        'namer' => $namer,
                        'content' => $content,
                        'type' => 'usermsg' 
                ] ) );
                // �㲥���������ݡ����������й㲥����Ϣ�ᴥ���ͻ��˵�onmessage�¼�
                send_message ( $message );
                // ����foreachѭ��
                break 2;
            }
            // ɾ���Ѿ��رյ�Socket
            $buf = @socket_read ( $v, 1024, PHP_NORMAL_READ );
            if ($buf === false) {
                $key = array_search ( $v, $clients );
                socket_getpeername ( $v, $ip );
                unset ( $clients [$key] );
                $msg = mask ( json_encode ( [ 
                        'type' => 'system',
                        'content' => $ip . "�Ѿ����ߡ�" 
                ] ) );
                send_message ( $msg );
            }
        }
    }
}
// ������Ϣ�ķ���
function send_message($msg) {
    global $clients;
    foreach ( $clients as $changed_socket ) {
        @socket_write ( $changed_socket, $msg, strlen ( $msg ) );
    }
    return true;
}
// ����3������������ֻ���˽�����ṹ���ɡ�������Ҫʱ����ֱ��ʹ��
// �������ݡ�����������ͻ��˷��͹���������
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
// �������ݡ��ڷ�������ͻ��˷�������ʱ��Ҫ�����ݴ��
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

// ���ֵ��߼����ͻ����������໥ʶ��Ĺ���
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