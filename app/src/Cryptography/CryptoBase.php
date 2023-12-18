<?php 

namespace RobertKomasara\Messenger\Cryptography;

abstract class CryptoBase
{
    protected \gnupg $pgp;

    public function __construct()
    {
        $this->pgp = new \gnupg;
    }

    protected function gettKeyInfo(string $pattern): array
    {
        return $this->pgp->keyinfo($pattern);
    }
}