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
        $key = $_SERVER['DOCUMENT_ROOT'] . '/../../../secret/public.pub';
        if (PublicKey::fromFile($key)->canDecrypt($encryptedData)) {
            return self::getPublicKey()->decrypt($encryptedData);
        }
        return false;
    }

    static function decryptWithPrivateKey($encryptedData)
    {
        $key = $_SERVER['DOCUMENT_ROOT'] . '/../../../secret/private.pem';
        if (PrivateKey::fromFile($key)->canDecrypt($encryptedData)) {
            return self::getPrivateKey()->decrypt($encryptedData);
        }
        return false;
    }

    static function getPublicKey()
    {
        $_publicKey = $_SERVER['DOCUMENT_ROOT'] . '/../../../secret/public.pub';
        return PublicKey::fromFile($_publicKey);
    }

    static function getPrivateKey($_privateKey = false)
    {
        $_privateKey = $_SERVER['DOCUMENT_ROOT'] . '/../../../secret/private.pem';
        return PrivateKey::fromFile($_privateKey);
    }
}
