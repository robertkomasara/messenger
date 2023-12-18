<?php 

namespace RobertKomasara\Messenger\Cryptography;

class Encryption extends CryptoBase
{
    public function __construct(
        private string $fingerprint
    ){}

    public function importKey(string $pgpKey): void
    {
        $this->pgp->import($pgpKey);
    }

    public function encryptText(string $message): string
    {
        $this->pgp->addencryptkey($this->fingerprint);
        
        return  $this->pgp->encrypt($message);
    }
}