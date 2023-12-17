<?php

require '/home/vagrant/src/vendor/autoload.php';

use RobertKomasara\Messenger\Server\SocketInstance;

try { 
  
  $srv = new SocketInstance();
  $binded = $srv->createSock()->bindAddress();
  if ( $binded ) $srv->startListen();

} catch (\Exception $e){
    printf("Run SocketInstance problem: %s",$e->getMessage());
}
