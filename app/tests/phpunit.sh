#!/bin/bash

set -euo pipefail;

export CryptographyTestKeyDecryptPassphrase=$1;
export CryptographyTestKeyDecryptFingerprint="ABDC05203A10E5FBAC4D7B97BC1D60021023FA7C";
export CryptographyTestKeyEncryptFingerprint="582244C8DE5FE8965000E9566DC9E850A3C4303D";

./../../vendor/phpunit/phpunit/phpunit --bootstrap ./../../app/tests/Bootstrap.php  ./../../app/tests;