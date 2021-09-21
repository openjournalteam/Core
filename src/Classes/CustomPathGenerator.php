<?php

namespace OpenJournalTeam\Core\Classes;

use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\Support\PathGenerator\PathGenerator;

class CustomPathGenerator implements PathGenerator
{
  public function getPath(Media $media): string
  {
    return $this->getBasePath($media) . '/';
  }

  public function getPathForConversions(Media $media): string
  {
    return $this->getBasePath($media) . '/conversions/';
  }

  public function getPathForResponsiveImages(Media $media): string
  {
    return $this->getBasePath($media) . '/responsive-images/';
  }

  protected function getBasePath(Media $media): string
  {
    //here im using trait to generate default path, e.g: path/mimes/avatar/media->id
    //its up to you to define folder structure, just make sure each folder
    //for conversions has unique name, or else it will be deleted
    return "media/{$media->getKey()}";
  }
}
