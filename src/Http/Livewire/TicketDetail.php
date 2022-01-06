<?php

namespace OpenJournalTeam\Core\Http\Livewire;

use App\Modules\Shop\Models\Customer;
use App\Modules\Shop\Models\CustomerTicket;
use Livewire\Component;

class TicketDetail extends Component
{
    public $customer;
    public $ticket;
    public $status;

    public function mount(Customer $customer, CustomerTicket $customerTicket)
    {
        $this->customer = $customer;
        $this->ticket   = $customerTicket;
        $this->status   = $customerTicket->status == CustomerTicket::STATUS_OPEN ? 'open' : 'closed';
    }

    public function render()
    {
        return render_livewire('core::livewire.ticket.single-ticket');
    }
}