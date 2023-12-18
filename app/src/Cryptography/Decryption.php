<?php 

namespace RobertKomasara\Messenger\Cryptography;

class Decryption extends CryptoBase
{
    public function __construct(
        private string $passphrase,
        private string $fingerprint,
    ){}

    public function decryptText(string $message): string
    {
        $this->pgp->seterrormode(\gnupg::ERROR_EXCEPTION);
        $this->pgp->adddecryptkey($this->fingerprint,$this->passphrase);

        return $this->pgp->decrypt($message);
    }
}