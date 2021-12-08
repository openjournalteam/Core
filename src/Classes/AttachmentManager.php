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
  public static function getEncryptFromPath($path)
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
  public static function getPathFromEncrypt($encrypt)
  {
    if (!trim($encrypt)) {
      throw new \Exception('Encrypted path is empty');
    }

    return Crypt::decryptString($encrypt);
  }

  public static function dropzoneData($medias)
  {
    return $medias->map(function ($media) {
      return [
        'uuid' => $media->uuid,
        'name' => $media->file_name,
        'url' => $media->getUrl(),
        'size' => $media->size,
        'mime_type' => $media->mime_type,
      ];
    });
  }
}
