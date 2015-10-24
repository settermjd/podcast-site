<?php

/**
 * This is a simple router, which should be used ONLY in development environments,
 * specifically for working with PHP's in-built webserver.
 */
if (php_sapi_name() == 'cli-server') {
    // Return image resources, as-is, but everything else is routed through PHP
    if (preg_match('/\.(?:png|jpg|jpeg|gif|js|css|eot|svg|ttf|woff|woff2)$/', $_SERVER["REQUEST_URI"])) {
        return false;
    } else {
        include_once 'index.php';
    }
}