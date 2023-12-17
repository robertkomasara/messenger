<?php 

namespace RobertKomasara\Messenger\Cryptography;

class Encryption extends CryptoBase
{
    private object $pgp;

    public function __construct()
    {
        $this->pgp = $gpg = new \gnupg();
    }

    public function importKey(string $pgpKey): void
    {
        $this->pgp->import($pgpKey);
    }

    public function encryptText(string $fingerprint,string $message): string
    {
        $this->pgp->addencryptkey($fingerprint);
        $encrypted = $this->pgp->encrypt($message);

        return $encrypted;
    }
}