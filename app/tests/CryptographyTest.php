<?php 

namespace RobertKomasara\Messenger\Tests;

use PHPUnit\Framework\TestCase;
use RobertKomasara\Messenger\Cryptography\Encryption;
use RobertKomasara\Messenger\Cryptography\Decryption;

class CryptographyTest extends TestCase
{
    public function testEncryptDecrypt(): void
    {
        $randomText = bin2hex(random_bytes(rand(10,20)));

        $encryption = new Encryption(APP_INI['EncryptFingerprint']);
        $encryptedText = $encryption->encryptText($randomText);
        if ( is_string($encryptedText) ) printf("\nEncryption:\n\n%s",$encryptedText);

        $decryption = new Decryption(APP_INI['DecryptPassphrase'],APP_INI['DecryptFingerprint']);
        $decryptedText = $decryption->decryptText($encryptedText);
        if ( is_string($decryptedText) ) printf("\nDecrription:\n\n%s",$decryptedText);

        $this->assertSame($decryptedText,$randomText);
    }
}