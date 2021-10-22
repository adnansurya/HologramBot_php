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

    function sendImage($chatId, $filepic, $tokenAPI){
        $bot_url    = "https://api.telegram.org/bot".$tokenAPI."/";
        $url        = $bot_url . "sendPhoto?chat_id=" . $chatId ;
        
        $post_fields = array('chat_id'   => $chatId,
            'photo'     => new CURLFile(realpath($filepic))
        );
        
        $ch = curl_init(); 
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Content-Type:multipart/form-data"
        ));
        curl_setopt($ch, CURLOPT_URL, $url); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields); 
        $output = curl_exec($ch);                    
        return $output;
    }
    function sendImageCaption($chatId, $filepic, $caption, $tokenAPI){
        $bot_url    = "https://api.telegram.org/bot".$tokenAPI."/";
        $url        = $bot_url . "sendPhoto?chat_id=" . $chatId ;
        
        $post_fields = array('chat_id'   => $chatId,
            'photo'     => new CURLFile(realpath($filepic)),
            'caption'   => $caption
        );
        
        $ch = curl_init(); 
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Content-Type:multipart/form-data"
        ));
        curl_setopt($ch, CURLOPT_URL, $url); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields); 
        $output = curl_exec($ch);                    
        return $output;
    }


    $date = new DateTime("now", new DateTimeZone('Asia/Makassar') );
    $waktu = $date->format('d-m-Y H:i:s');

    function selisihWaktu($waktunya){
        global $date;
        $d1 = strtotime($waktunya);
        $d2 = strtotime( $date->format('Y-m-d H:i:s'));
        $totalSecondsDiff = abs($d1-$d2);
        return $totalSecondsDiff;
    }
   
?>