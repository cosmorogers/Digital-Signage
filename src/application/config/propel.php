<?php
// This file generated by Propel 1.7.2-dev convert-conf target
// from XML runtime conf file /home/chris/PhpstormProjects/Digital-Signage/src/application/database/runtime-conf.xml
$conf = array (
  'datasources' => 
  array (
    'signage' => 
    array (
      'adapter' => 'mysql',
      'connection' => 
      array (
        'classname' => 'DebugPDO',
        'dsn' => 'mysql:host=localhost;dbname=signage',
        'user' => 'signage',
        'password' => 'jsmqFr5qP4DtF9a7',
        'settings' => 
        array (
          'charset' => 
          array (
            'value' => 'utf8',
          ),
        ),
      ),
    ),
    'default' => 'signage',
  ),
  'generator_version' => '1.7.2-dev',
);
$conf['classmap'] = include(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'propel-classmap.php');
return $conf;