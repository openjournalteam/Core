<div class="container">
    <div class="page-header d-print-none">
        <div class="row align-items-center">
            <div class="col">
                <div class="page-pretitle">
                    {{-- <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                        stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <circle cx="12" cy="12" r="9" />
                        <path d="M9 12l2 2l4 -4" /></svg> --}}
                    Status {{ $status }}
                </div>
                <h2 class="page-title">
                    {{ $ticket->subject }}
                </h2>
            </div>
            <div class="col-auto ms-auto d-print-none">
                <a href="#" class="btn btn-primary d-sm-inline-block" data-bs-toggle="modal"
                    data-bs-target="#modal-reply">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                        stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M4 21v-13a3 3 0 0 1 3 -3h10a3 3 0 0 1 3 3v6a3 3 0 0 1 -3 3h-9l-4 4" />
                        <line x1="10" y1="11" x2="14" y2="11" />
                        <line x1="12" y1="9" x2="12" y2="13" /></svg>
                    Reply
                </a>
            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="row row-cards">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-start pb-2 border-bottom">
                            <div style="width: 80px">
                                <span class="avatar avatar-lg mx-auto rounded-circle">{{ substr($customer->name, 0, 1) }}</span>
                            </div>
                            <div class="ps-3">
                                <h5 class="fs-md mb-2">{{ $customer->name }}</h5>
                                <p class="fs-md mb-1">{{ $ticket->comment }}</p>
                                <span class="fs-ms text-muted d-flex justify-content-end pt-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <circle cx="12" cy="12" r="9" />
                                        <polyline points="12 7 12 12 15 15" /></svg>
                                    Sep 30, 2019 at 11:05AM
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if ($ticket->ticketDetail)
                @foreach ($ticket->ticketDetail as $comment)
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-start pb-2 border-bottom">
                                    <div style="width: 80px">
                                        <span class="avatar avatar-lg mx-auto rounded-circle">M </span>
                                    </div>
                                    <div class="ps-3">
                                        <h5 class="fs-md mb-2">Michael Davis</h5>
                                        <p class="fs-md mb-1">Lorem ipsum dolor sit ametLorem ipsum dolor sit amet, consectetur
                                            adipiscing elit, sed do
                                            eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat
                                            cupidatat non proident, sunt in culpa qui.</p>
                                        <span class="fs-ms text-muted d-flex justify-content-end pt-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <circle cx="12" cy="12" r="9" />
                                                <polyline points="12 7 12 12 15 15" /></svg>
                                            Sep 30, 2019 at 11:05AM
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
                
        </div>
    </div>
</div>

<div class="modal modal-blur fade" id="modal-reply" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Reply Ticket</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="customer_id" value="#">
                <div class="mb-3" x-data="{caracter : 0}" x-init="caracter = $refs.countme.value.length">
                    <label class="form-label">Massage <span class="form-label-description"
                            x-text="`${caracter}/500`"></span></label>
                    <textarea class="form-control" rows="6" maxlength="500" placeholder="Enter your problem.." id="comment"
                        x-ref="countme" x-on:keyup="caracter = $refs.countme.value.length" name="comment"></textarea>
                </div>
                {{-- <div class="mb-3">
                    <input type="file" data-control="dropzone" name="profile" multiple />
                </div> --}}
            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                    Cancel
                </a>
                <a href="#" class="btn btn-primary ms-auto" data-bs-dismiss="modal">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                        stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <line x1="10" y1="14" x2="21" y2="3" />
                        <path d="M21 3l-6.5 18a0.55 .55 0 0 1 -1 0l-3.5 -7l-7 -3.5a0.55 .55 0 0 1 0 -1l18 -6.5" /></svg>
                    Send
                </a>
            </div>
        </div>
    </div>
</div>
