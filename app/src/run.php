<?php

require '/home/vagrant/src/vendor/autoload.php';

use RobertKomasara\Messenger\Server\SocketInstance;

try { 
  $srv = new SocketInstance();
  $srv->createSock()->bindAddress();
} catch (\Exception $e){
    printf("Run SocketInstance problem: %s",$e->getMessage());
}
