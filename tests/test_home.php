<?php

$html = file_get_contents("http://app/index.php");

if ($html !== false) {
    echo "Homepage: PASS\n";
    exit(0);
}

echo "Homepage: FAIL\n";
exit(1);