<div class="d-flex align-items-center">
    <div class="identity">
        <div class="subject">{{ $mailTemplate->subject }}</div>
        <div class="description">{{ $mailTemplate->description }}</div>
        <div class="key">
            <span class="badge bg-primary" data-bs-toggle="tooltip" data-bs-placement="bottom"
                title="KEY">{{ $mailTemplate->key }}</span>
        </div>
    </div>
    <button class="btn btn-tabler btn-icon btn-outline-secondary ms-auto" data-bs-toggle="collapse"
        data-bs-target="#template-example-{{ $mailTemplate->id }}">
        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
            stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path
                d="M15 4v8h3.586a1 1 0 0 1 .707 1.707l-6.586 6.586a1 1 0 0 1 -1.414 0l-6.586 -6.586a1 1 0 0 1 .707 -1.707h3.586v-8a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1z" />
        </svg>
    </button>
</div>
<div class="collapse mt-2" id="template-example-{{ $mailTemplate->id }}">
    <ul class="list-group list-group-flush">
        <li class="list-group-item">Subject : {{ $mailTemplate->subject }}</li>
        <li class="list-group-item">{!! $mailTemplate->html_template !!}</li>
        <li class="list-group-item d-flex align-items-center">
            <a href="#" class="btn btn-primary ms-auto edit_form_modal"
                data-url="{{ route('core.admin.email.edit_template', $mailTemplate->id) }}" href="#"
                data-bs-toggle="modal" data-bs-target="#modal-form-email-template">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                    stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M9 7h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3"></path>
                    <path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3"></path>
                    <line x1="16" y1="5" x2="19" y2="8"></line>
                </svg>
                Edit
            </a>
            <a href="{{ route('core.admin.email.reset_template', $mailTemplate->id) }}"
                data-title="Are you sure want to reset this template?" class="btn btn-outline-danger ms-2"
                data-control="confirm">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                    stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4" />
                    <path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4" />
                </svg>
                Reset
            </a>
        </li>
    </ul>
</div>
