<?php

namespace OpenJournalTeam\Core\Classes;

use Illuminate\Support\Facades\Crypt;

class AttachmentManager
{
  /**
   * Converts the given path into an encrypted
   *
   * @param  string $path
   *
   * @return string
   */
  public function getEncryptFromPath($path)
  {
    return Crypt::encryptString($path);
  }

  /**
   * Converts the given encrypted into a path
   *
   * @param  string $encrypt
   *
   * @return string
   */
  public function getPathFromEncrypt($encrypt)
  {
    if (!trim($encrypt)) {
      throw new \Exception('Encrypted path is empty');
    }

    return Crypt::decryptString($encrypt);
  }
}
