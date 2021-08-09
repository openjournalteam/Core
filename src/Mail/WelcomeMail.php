<?php

namespace OpenJournalTeam\Core\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use OpenJournalTeam\Master\Models\Customer;

class WelcomeMail extends Mailable
{
  use Queueable, SerializesModels;

  public $customer;

  public function __construct(Customer $customer)
  {
    $this->customer = $customer;
  }

  public function build()
  {
    return $this->view('core::emails.welcome');
  }
}
