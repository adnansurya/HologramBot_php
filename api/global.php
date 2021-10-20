<?php 

    include 'secret.php';
    $debugMode = True;

    function sendMessage($chatId, $msg, $tokenAPI){
        $request_params = [
            'chat_id' => $chatId,
            'text' => $msg
        ];    
        
        $request_url = 'https://api.telegram.org/bot'. $tokenAPI . '/sendMessage?' . http_build_query($request_params);

        file_get_contents($request_url);
    }

    function deleteMessage($chatId, $messageId, $tokenAPI){
        $request_params = [
            'chat_id' => $chatId,
            'message_id' => $messageId
        ];    
        
        $request_url = 'https://api.telegram.org/bot'. $tokenAPI . '/deleteMessage?' . http_build_query($request_params);

        file_get_contents($request_url);
    }

    $date = new DateTime("now", new DateTimeZone('Asia/Makassar') );
    $waktu = $date->format('Y-m-d H:i:s');
?>