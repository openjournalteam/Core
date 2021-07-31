<?php

namespace OpenJournalTeam\Core\Classes;

use Illuminate\Database\Eloquent\Model;

class UploadManager
{
  public $filepond;

  public function __construct()
  {
    $this->filepond = app(Sopamo\LaravelFilepond\Filepond::class);
  }

  public function addMedia(Model $model, $inputName = 'file')
  {
    dd($model, $this->filepond->getPathFromServerId());
  }
}
