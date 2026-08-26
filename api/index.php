<?php

// Buat semua folder penyimpanan sementara di memori Vercel
$tmpDirs = [
    '/tmp/views',
    '/tmp/sessions',
    '/tmp/cache/data',
    '/tmp/logs',
];

foreach ($tmpDirs as $dir) {
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
    }
}

// Dialihkan agar Laravel tidak menulis ke storage lokal yang read-only
putenv('APP_SERVICES_CACHE=/tmp/services.php');
putenv('APP_PACKAGES_CACHE=/tmp/packages.php');
putenv('APP_CONFIG_CACHE=/tmp/config.php');
putenv('APP_ROUTES_CACHE=/tmp/routes.php');

require __DIR__ . '/../public/index.php';