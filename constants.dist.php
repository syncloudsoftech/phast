<?php

if (! defined('EXECUTION_ALLOWED')) {
    exit('Unauthorized access denied.');
}

define('DB_HOST', 'mysql');
define('DB_PORT', 3306);
define('DB_USERNAME', 'phastapp');
define('DB_PASSWORD', 'phastapp');
define('DB_NAME', 'phastapp');

define('SMTP_HOST', 'mailcatcher');
define('SMTP_PORT', 1025);
define('SMTP_USERNAME', null);
define('SMTP_PASSWORD', null);
define('SMTP_ENCRYPTION', ''); // ssl or tls
