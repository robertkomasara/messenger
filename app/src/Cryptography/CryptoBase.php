<?php 

namespace RobertKomasara\Messenger\Cryptography;

abstract class CryptoBase
{
    protected \gnupg $pgp;

    protected function gettKeyInfo(string $pattern): array
    {
        return $this->pgp->keyinfo($pattern);
    }
}