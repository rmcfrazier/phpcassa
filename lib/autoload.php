<?php

$GLOBALS['THRIFT_ROOT'] = __DIR__.'/thrift';
$GLOBALS['THRIFT_AUTOLOAD'] = array();

spl_autoload_register(function($className){
    if (strpos($className, 'phpcassa') === 0) {
        require_once __DIR__.'/'.str_replace('\\', '/', $className).'.php';
    } else {
        // Find the thrift-generated class file
        global $THRIFT_AUTOLOAD;
        $classl = strtolower($className);
        if (isset($THRIFT_AUTOLOAD[$classl])) {
          require_once $GLOBALS['THRIFT_ROOT'].'/packages/'.$THRIFT_AUTOLOAD[$classl];
        } else {
            return false;
        }
    }
});

// This sets up the THRIFT_AUTOLOAD map
require_once __DIR__.'/thrift/packages/cassandra/Cassandra.php';
