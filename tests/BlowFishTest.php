<?php

use PHPUnit\Framework\TestCase;
use Luisinder\BlowfishLib\BlowFish;

class BlowFishTest extends TestCase
{
    public function testHashAndVerify(): void
    {
        $bf = new BlowFish(10);
        $hash = $bf->hashPassword('secret');
        $this->assertTrue($bf->verifyPassword('secret', $hash));
        $this->assertFalse($bf->verifyPassword('other', $hash));
    }

    public function testNeedsRehash(): void
    {
        $bfLow = new BlowFish(8);
        $hash = $bfLow->hashPassword('secret');
        $bfHigh = new BlowFish(12);
        $this->assertTrue($bfHigh->needsRehash($hash));
        $this->assertFalse($bfLow->needsRehash($hash));
    }

    public function testBackwardCompatibilityMethods(): void
    {
        $bf = new BlowFish(10);
        $hash = $bf->crypt_blowfish('secret');
        $this->assertTrue($bf->checkPassword('secret', $hash));
    }
}
