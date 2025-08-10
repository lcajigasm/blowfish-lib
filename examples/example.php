<?php
require_once __DIR__ . '/../src/blowFish.php';

$bf = new BlowFish(12);
$plain = 'ExamplePassword123!';
$hash = $bf->hashPassword($plain);

echo "Generated hash: $hash\n";

echo 'Verify correct password: ' . ($bf->verifyPassword($plain, $hash) ? 'OK' : 'FAIL') . "\n";

echo 'Verify wrong password: ' . ($bf->verifyPassword('wrong', $hash) ? 'UNEXPECTED' : 'OK') . "\n";
