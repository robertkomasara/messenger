<?php 

namespace App\Messenger\Tests\Encryption;

use App\Messenger\Tests\AppTestCase;
use App\Messenger\Encryption\Encryption;
use App\Messenger\Encryption\Decryption;

class CryptographyTest extends AppTestCase
{
    public function testEncryptDecrypt(): void
    {
        if ( isset($this->appIni['Cryptography']) ){

            $randomText = bin2hex(random_bytes(rand(10,20)));

            if ( !empty($this->appIni['Cryptography']['EncryptFingerprint']) ){
                $encryption = new Encryption($this->appIni['Cryptography']['EncryptFingerprint']);
                $encryptedText = $encryption->encryptText($randomText);
                if ( is_string($encryptedText) ) printf("\nEncryption:\n\n%s",$encryptedText);    
            }

            if ( !empty($this->appIni['Cryptography']['DecryptPassphrase']) && !empty($this->appIni['Cryptography']['DecryptFingerprint'])){

                $decryption = new Decryption(
                    $this->appIni['Cryptography']['DecryptPassphrase'],
                    $this->appIni['Cryptography']['DecryptFingerprint']
                );
                $decryptedText = $decryption->decryptText($encryptedText);
                if ( is_string($decryptedText) ) printf("\nDecrription:\n\n%s",$decryptedText);    
            }
    
            if ( isset($randomText) && isset($decryptedText) ){
                $this->assertSame($decryptedText,$randomText);
            }
        }
    }
}
