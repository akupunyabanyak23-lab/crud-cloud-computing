<?php

require_once __DIR__ . '/../config/koneksi.php';

if ($koneksi) {
    echo "Database Connection: PASS\n";
    exit(0);
}

echo "Database Connection: FAIL\n";
exit(1);