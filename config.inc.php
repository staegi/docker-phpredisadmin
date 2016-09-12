<?php

$config = array(
    'servers'             => array(),
    'seperator'           => ':',
    'maxkeylen'           => 100,
    'count_elements_page' => 100,
    'keys'                => false, // Use the old KEYS command instead of SCAN to fetch all keys.
    'scansize'            => 1000, // How many entries to fetch using each SCAN command.
);

$admin_user = getenv('ADMIN_USER');
$admin_pass = getenv('ADMIN_PASS');

if (!empty($admin_user)) {
    $config['login'] = array(
        $admin_user => array(
            'password' => $admin_pass,
        ),
    );
}

$i = 1;

while (true) {

    $prefix = 'REDIS_' . $i . '_';

    $server_name = getenv($prefix . 'NAME');
    $server_host = getenv($prefix . 'HOST');
    $server_port = getenv($prefix . 'PORT');

    if (empty($server_host)) {
        break;
    }

    if (empty($server_name)) {
        $server_name = $server_host;
    }

    if (empty($server_port)) {
        $server_port = 6379;
    }

    $config['servers'][] = array(
        'name'   => $server_name,
        'host'   => $server_host,
        'port'   => $server_port,
        'filter' => '*',
    );

    $i++;
}
