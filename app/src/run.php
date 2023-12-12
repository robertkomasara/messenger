<?php

error_reporting(E_ALL);

require_once '../sockets/vendor/autoload.php';

use RobertKomasara\Messenger\Server\SocketInstance;

( new SocketInstance() );
