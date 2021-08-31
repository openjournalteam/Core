<?php


namespace OpenJournalTeam\Core\Classes;

use Spatie\Crypto\Rsa\PublicKey;
use Spatie\Crypto\Rsa\PrivateKey;

class KeyManager
{
    static function encryptWithPublicKey($data)
    {
        return self::getPublicKey()->encrypt($data);
    }

    static function encryptWithPrivateKey($data)
    {
        return self::getPrivateKey()->encrypt($data);
    }

    static function decryptWithPublicKey($encryptedData)
    {
        $publicKey = self::getPublicKey();
        if ($publicKey->canDecrypt($encryptedData)) {
            return $publicKey->decrypt($encryptedData);
        }
        return false;
    }

    static function decryptWithPrivateKey($encryptedData)
    {
        $privateKey = self::getPrivateKey();
        if ($privateKey->canDecrypt($encryptedData)) {
            return $privateKey->decrypt($encryptedData);
        }
        return false;
    }

    static function getPublicKey()
    {
        $_publicKey = self::getPublicKeyFile();
        return PublicKey::fromFile($_publicKey);
    }

    static function getPrivateKey()
    {
        $_privateKey = self::getPrivateKeyFile();
        return PrivateKey::fromFile($_privateKey);
    }

    static function getPublicKeyFile()
    {
        return storage_path('public.pub');
    }

    static function getPrivateKeyFile()
    {
        return storage_path('private.pem');
    }
}
