<?php
$ini = parse_ini_file('app.ini');
return array(
    'db_name' => $ini['db_name'],
    'db_user' => $ini['db_user'],
    'db_password' => $ini['db_password'],
    'db_host' => $ini['db_host']
);
