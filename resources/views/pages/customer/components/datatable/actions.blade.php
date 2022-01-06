<div class="dropdown">
    <button type="button" aria-label="dropdown-user" class="btn btn-sm dropdown-toggle" data-bs-toggle="dropdown">
        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
            stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path
                d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z" />
            <circle cx="12" cy="12" r="3" />
        </svg>
    </button>
    <div class="dropdown-menu">
        <span class="dropdown-header">Actions</span>

        <a class="dropdown-item edit_form_modal generate_token" href="#" data-bs-toggle="modal"
            data-bs-target="#modal-form-new-ticket" data-json="{{ $json }}">
            <svg xmlns='http://www.w3.org/2000/svg' class='icon' width='24' height='24' viewBox='0 0 24 24'
                stroke-width='2' stroke='currentColor' fill='none' stroke-linecap='round' stroke-linejoin='round'>
                <path stroke='none' d='M0 0h24v24H0z' fill='none' />
                <path d='M9 7h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3' />
                <path d='M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3' />
                <line x1='16' y1='5' x2='19' y2='8' /></svg>
            Edit
        </a>

        <a class="dropdown-item text-danger general_confirm" href="#" data-route="{{ route('core.customer.ticket.closed', $row->id) }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M5 12l5 5l10 -10" /></svg>
            Closed
        </a>
    </div>
</div>
