<?php

namespace OpenJournalTeam\Core\Models;

use Illuminate\Support\Facades\DB;
use Spatie\MailTemplates\Models\MailTemplate as BaseMailTemplate;

class MailTemplate extends BaseMailTemplate
{
  public function resetToDefaultTemplate()
  {
    $mailTemplate = $this;

    DB::transaction(function () use ($mailTemplate) {
      $mailableClass = $this->mailable;

      if (!class_exists($mailableClass)) {
        return false;
      }

      $defaultSubject = $mailableClass::getDefaultSubject();
      $defaultHtmlTemplate = $mailableClass::getDefaultHtmlTemplate();


      $mailTemplate->subject = $defaultSubject;
      $mailTemplate->html_template = $defaultHtmlTemplate;
      $mailTemplate->save();
    });


    return $this;
  }
}
