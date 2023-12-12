<?php 

namespace RobertKomasara\Messenger\Tests;

use PHPUnit\Framework\TestCase;
use RobertKomasara\Messenger\Cryptography\Encryption;
use RobertKomasara\Messenger\Cryptography\Decryption;

class CryptographyTest extends TestCase
{
    private string $decryptPassphrase;
    private string $decryptFingerprint;
    private string $encryptFingerprint;

    public function setUp(): void
    {
        $this->decryptPassphrase = getenv('CryptographyTestKeyDecryptPassphrase');
        $this->decryptFingerprint = getenv('CryptographyTestKeyDecryptFingerprint');
        $this->encryptFingerprint = getenv('CryptographyTestKeyEncryptFingerprint');
    }

    public function testEncryptDecrypt(): void
    {
        $encryption = new Encryption($this->encryptFingerprint);
        $encryptedText = $encryption->encryptText('test txt');
        if ( is_string($encryptedText) ) printf("%s",$encryptedText);
        $this->assertTrue((bool)$encryptedText);

        $decryption = new Decryption($this->decryptPassphrase,$this->decryptFingerprint);
        $decryptedText = $decryption->decryptText($encryptedText);
        if ( is_string($decryptedText) ) printf("%s",$decryptedText);
        $this->assertTrue((bool)$decryptedText);
    }
}