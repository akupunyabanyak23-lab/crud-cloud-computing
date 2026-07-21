<?php

$response = file_get_contents("http://app/health.php");

if (trim($response) === "OK") {
    echo "Health Check: PASS\n";
    exit(0);
}

echo "Health Check: FAIL\n";
exit(1);