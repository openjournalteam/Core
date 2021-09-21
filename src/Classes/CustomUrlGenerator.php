<?php

namespace OpenJournalTeam\Core\Classes;

use DateTimeInterface;
use Illuminate\Support\Str;
use League\Flysystem\Adapter\AbstractAdapter;
use Spatie\MediaLibrary\Support\UrlGenerator\BaseUrlGenerator;

class CustomUrlGenerator extends BaseUrlGenerator
{
  public function getUrl(): string
  {
    $url = $this->getDisk()->url($this->getPathRelativeToRoot());

    $url = $this->versionUrl($url);

    return $url;
  }

  public function getTemporaryUrl(DateTimeInterface $expiration, array $options = []): string
  {
    return $this->getDisk()->temporaryUrl($this->getPathRelativeToRoot(), $expiration, $options);
  }

  public function getBaseMediaDirectoryUrl()
  {
    return $this->getDisk()->url('/');
  }

  public function getPath(): string
  {
    $adapter = $this->getDisk()->getAdapter();

    $cachedAdapter = '\League\Flysystem\Cached\CachedAdapter';

    if ($adapter instanceof $cachedAdapter) {
      $adapter = $adapter->getAdapter();
    }

    $pathPrefix = '';
    if ($adapter instanceof AbstractAdapter) {
      $pathPrefix = $adapter->getPathPrefix();
    }

    return $pathPrefix . $this->getPathRelativeToRoot();
  }

  public function getResponsiveImagesDirectoryUrl(): string
  {
    $base = Str::finish($this->getBaseMediaDirectoryUrl(), '/');

    $path = $this->pathGenerator->getPathForResponsiveImages($this->media);

    return Str::finish(url($base . $path), '/');
  }
}
