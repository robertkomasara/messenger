<?php 

namespace RobertKomasara\Messenger\Cryptography;

class Decryption extends CryptoBase
{
    public function __construct(
        private string $passphrase = "",
        private string $fingerprint = "",
    ){}

    public function decryptText(string $message): string
    {
        $gpg = new \gnupg();
        $gpg->seterrormode(\gnupg::ERROR_EXCEPTION);
        $gpg->adddecryptkey($this->fingerprint,$this->passphrase);
        $decrypted = $gpg->decrypt($message);

        return $decrypted;
    }
}