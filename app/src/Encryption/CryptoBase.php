<?php 

namespace App\Messenger\Encryption;

abstract class CryptoBase
{
    protected \gnupg $pgp;

    public function __construct()
    {
        $this->pgp = new \gnupg;
    }

    public function importKey(string $pgpKey): void
    {
        $this->pgp->import($pgpKey);
    }

    public function gettKeyInfo(string $pattern): array
    {
        return $this->pgp->keyinfo($pattern);
    }
}