<?php

$appIniFile = parse_ini_file(
    getenv('APP_DIR_PATH') . '/app/cfg/application.ini'
);

define('APP_INI',$appIniFile);