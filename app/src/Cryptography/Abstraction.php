<?php 

namespace RobertKomasara\Messenger\Cryptography;

// putenv("GNUPGHOME=/tmp");

abstract class Abstraction
{
    protected object $gnupg;

    private function printKeyInfo(string $pattern): void
    {
        $gpg = new \gnupg();
        $info = $gpg -> keyinfo($pattern);
        print_r($info);
    }

    private function importPubKey(string $filePath): string
    {
        $publicKey = file_get_contents($filePath);

        $this->gnupg = new \gnupg();
        $this->gnupg->seterrormode(\gnupg::ERROR_EXCEPTION);
        $info = $this->gnupg->import($publicKey);
        $this->gnupg->addencryptkey($info['fingerprint']);

        return $info['fingerprint'];
    }
}