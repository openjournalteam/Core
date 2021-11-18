<?php

namespace OpenJournalTeam\Core\Traits;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\FileAdder;
use Illuminate\Support\Str;
use OpenJournalTeam\Core\Classes\AttachmentManager;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

trait InteractsWithHashedMedia
{
  use InteractsWithMedia {
    InteractsWithMedia::addMedia as parentAddMedia;
  }

  public function addMedia($file): FileAdder
  {
    $fileName = Str::uuid() . '.' . File::extension($file);

    return $this->parentAddMedia($file)
      ->usingFileName($fileName);
  }

  public function saveAttachments(array|string $data, $collectionName = 'default', array $customProperties = [], $diskName = '', $callback = null): void
  {
    if (is_string($data)) {
      $data = [$data];
    }

    if (!Arr::exists($customProperties, 'name')) {
      $customProperties['name'] = $collectionName;
    }

    foreach ($data as $key => $file) {
      $media = $this->saveAttachment($file, $collectionName, $customProperties, $diskName);
      if ($callback) {
        call_user_func_array($callback, [$media, $key]);
      }
    }
  }

  public function saveAttachment(string $encrypt, $collectionName = 'default', array $customProperties = [], string $diskName = '')
  {
    if (!Arr::exists($customProperties, 'name')) {
      $customProperties['name'] = $collectionName;
    }

    return $this->addMedia(AttachmentManager::getPathFromEncrypt($encrypt))
      ->withCustomProperties($customProperties)
      ->toMediaCollection($collectionName, $diskName);
  }

  public function registerMediaConversions(Media $media = null): void
  {
    $this
      ->addMediaConversion('thumb')
      ->width(368)
      ->quality(70);
    $this->addMediaConversion('thumb-lg')
      ->height(1024)
      ->quality(70);
  }
}
