<?php 

namespace RobertKomasara\Messenger\Cryptography;

class Encryption extends Abstraction
{
    public function __construct(
        private string $fingerprint = ""
    ){}

    public function importKey(string $pgpKey): mixed
    {
        $gpg = new \gnupg();

        return $gpg->import($pgpKey);
    }

    public function encryptText(string $message): string
    {
        $gpg = new \gnupg();
        $gpg->addencryptkey($this->fingerprint);
        $encrypted = $gpg->encrypt($message);

        return $encrypted;
    }
}