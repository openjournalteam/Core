<?php

namespace OpenJournalTeam\Core\Mail;

use OpenJournalTeam\Core\Models\Config;
use Spatie\MailTemplates\TemplateMailable as Template;

abstract class TemplateMailable extends Template
{
  public function getHtmlLayout(): string
  {
    $header = Config::find('mailtemplate.header')?->value ?? '';
    $footer = Config::find('mailtemplate.footer')?->value ?? '';


    return $header . '<br><br>{{{ body }}}<br><br>' . $footer;
  }

  public static function getDefaultHtmlTemplate(): ?string
  {
    return 'html default';
  }

  public static function getDefaultSubject(): ?string
  {
    return 'subject default';
  }
}
