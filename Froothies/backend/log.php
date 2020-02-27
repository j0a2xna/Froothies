<?php
    //write to files
    //global.log --> all webserver backend
    //auth.log --> authentication database
    //error.log --> apache /var/www/log/error.log
    require_once('path.inc');
    require_once('rabbitMQLib.inc');
    require_once('get_host_info.inc');

    function requestProcessor($request){
        var_dump($request);
        if($request['type']=="log"){
            $event = $request;
            writeLog($event);
        }else{
            $request['type'] = "OVERWRITTEN || ERROR: TYPE";
            $event = $request['type'];
            writeLog($event);
        }
    }

    function writeLog($event){

            $event['msg'] = 
            $time = time();
            $date = gmdata("y/m-d H:i:s", $time);
            $file = "global.log";

            $fh = fopen($file, 'a') or die("Cannot Open");
            fwrite($fh, "\n" . $date . "\t" . $file);
    }

    $server = new rabbitMQServer("RMQ_log.ini", "logServer");
    $server->process_requests('requestProcessor');
    $server->send_request($send);
    exit();

?>
