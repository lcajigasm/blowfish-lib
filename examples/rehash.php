<?php
require_once __DIR__ . '/../src/blowFish.php';

$bf = new BlowFish(10);
$plain = 'RotateMe!';
$hash = $bf->hashPassword($plain);

// Later we decide to increase cost to 12
$bfHigh = new BlowFish(12);
if ($bfHigh->needsRehash($hash)) {
    echo "Hash needs rehash -> updating...\n";
    $hash = $bfHigh->hashPassword($plain);
} else {
    echo "Hash OK at desired cost.\n";
}

echo 'Final hash: ' . $hash . "\n";
