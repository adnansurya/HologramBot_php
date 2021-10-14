<?php
  

    $pesan = $_GET['pesan'];


    function sendMessage($chatId, $msg, $tokenAPI){
        $request_params = [
            'chat_id' => $chatId,
            'text' => $msg
        ];    
        
        $request_url = 'https://api.telegram.org/bot'. $tokenAPI . '/sendMessage?' . http_build_query($request_params);
    
        file_get_contents($request_url);
    }

    sendMessage($adnan_id,  $pesan, $token);

    
?>