<?php

namespace OpenJournalTeam\Core\Models;

use Spatie\MailTemplates\TemplateMailable as Template;

class TemplateMailable extends Template
{
  public function getHtmlLayout(): string
  {
    $header = Config::find('mailtemplate.header')?->value ?? '';
    $footer = Config::find('mailtemplate.footer')?->value ?? '';


    return $header . '{{{ body }}}' . $footer;
  }
}
