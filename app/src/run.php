<?php

require 'vendor/autoload.php';

use RobertKomasara\Messenger\Server\SocketInstance;

try { ( new SocketInstance() ); } catch (\Exception $e){
    printf("Run SocketInstance problem: %s",$e->getMessage());
}
