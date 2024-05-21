<?php 

namespace App\Messenger\Encryption;

class Encryption extends CryptoBase
{
    public function __construct(private string $fingerprint = '')
    {
        parent::__construct(); 
    }

    public function encryptText(string $message): string
    {
        if ( isset($this->fingerprint) ){
            $this->pgp->addencryptkey($this->fingerprint);
        }

        return  $this->pgp->encrypt($message);
    }
}