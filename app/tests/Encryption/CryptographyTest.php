<?php 

namespace App\Messenger\Tests\Encryption;

use PHPUnit\Framework\TestCase;
use App\Messenger\Encryption\Encryption;
use App\Messenger\Encryption\Decryption;

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