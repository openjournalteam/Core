<div class="container">
    <div class="page-header d-print-none">
        <div class="row align-items-center">
            <div class="col">
                <div class="page-pretitle">
                    Tickets
                </div>
                <h2 class="page-title">
                    My Tickets
                </h2>
            </div>
            <div class="col-auto ms-auto d-print-none">
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="card" id="menu-component">
            <ul class="nav nav-tabs nav-tabs-alt" id="count_status" url="{{ route('core.customer.ticket.status') }}"
                x-data="status">
                <li class="nav-item">
                    <a href="#tab-open" class="nav-link active p-3 tabs-color status" data-bs-toggle="tab">
                        Open <span :class="[status.open > 0 ? 'badge badge-pill bg-yellow' : 'ps-1 greyed']"
                            x-text="status.open"></span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#tab-closed" class="nav-link p-3 tabs-color" data-bs-toggle="tab">
                        Close <span class="ps-1 greyed" x-text="`(${status.closed})`"></span>
                    </a>
                </li>
            </ul>
            <div class="card-body">
                <div class="tab-content">
                    <div id="tab-open" class="tab-pane active show">
                        <div class="d-flex justify-content-end pb-2">
                            <a href="#" class="btn btn-outline-primary" data-bs-toggle="modal"
                                data-bs-target="#modal-form-new-ticket" id="add-bank-transfer">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <line x1="15" y1="5" x2="15" y2="7" />
                                    <line x1="15" y1="11" x2="15" y2="13" />
                                    <line x1="15" y1="17" x2="15" y2="19" />
                                    <path
                                        d="M5 5h14a2 2 0 0 1 2 2v3a2 2 0 0 0 0 4v3a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-3a2 2 0 0 0 0 -4v-3a2 2 0 0 1 2 -2" />
                                </svg>
                                New Ticket
                            </a>
                        </div>
                        <table class="table table-bordered datatables w-100 table-hover" id="table-filter"
                            data-ajax="{{ route('core.customer.ticket.datatable', [$customer->id, $open]) }}">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width:5%" data-data="DT_RowIndex" data-name="index"
                                        data-orderable="false" data-searchable="false" data-class="text-center">No</th>
                                    <th data-data="subject" data-name="subject">Ticket Subject</th>
                                    <th data-data="created_at" data-name="created_at">Date Submitted | Updated</th>
                                    <th data-data="type" data-name="type">Type</th>
                                    <th data-data="priority" data-name="priority">Priority</th>
                                    <th style="width:10%" data-data="actions" data-name="actions" data-orderable="false"
                                        data-searchable="false">Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <div id="tab-closed" class="tab-pane">
                        <table class="table table-bordered datatables w-100 table-hover" id="table-filter"
                            data-ajax="{{ route('core.customer.ticket.datatable', [$customer->id, $closed]) }}">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width:5%" data-data="DT_RowIndex" data-name="index"
                                        data-orderable="false" data-searchable="false" data-class="text-center">No</th>
                                    <th data-data="subject" data-name="subject">Ticket Subject</th>
                                    <th data-data="created_at" data-name="created_at">Date Submitted | Updated</th>
                                    <th data-data="type" data-name="type">Type</th>
                                    <th data-data="priority" data-name="priority">Priority</th>
                                    <th style="width:10%" data-data="actions" data-name="actions" data-orderable="false"
                                        data-searchable="false">Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal modal-blur fade" id="modal-form-new-ticket" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Submit New Ticket</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('core.customer.ticket.save') }}" method="POST" data-control="form" autocomplete="off"
                novalidate="novalidate">
                <div class="modal-body">
                    <input type="hidden" name="customer_id" value="{{ $customer->id }}">
                    <div class="mb-3">
                        <label class="form-label">Subject</label>
                        <input type="text" name="subject" class="form-control" placeholder="Enter subject ticket">
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Type</label>
                                <select name="type" class="form-select">
                                    <option value="website problem">Website Problem</option>
                                    <option value="server problem">Server Problem</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Priority</label>
                                <select name="priority" class="form-select">
                                    <option value="urgent">Urgent</option>
                                    <option value="high">High</option>
                                    <option value="medium">Medium</option>
                                    <option value="low">Low</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3" x-data="{caracter : 0}" x-init="caracter = $refs.countme.value.length">
                        <label class="form-label">Massage <span class="form-label-description"
                                x-text="`${caracter}/500`"></span></label>
                        <textarea class="form-control" rows="6" maxlength="500" placeholder="Enter your problem.."
                            x-ref="countme" x-on:keyup="caracter = $refs.countme.value.length"
                            name="comment"></textarea>
                    </div>
                    {{-- <div class="mb-3">
                        <input type="file" data-control="dropzone" name="profile" multiple />
                    </div> --}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="save-ticket">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                        stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <line x1="10" y1="14" x2="21" y2="3" />
                        <path d="M21 3l-6.5 18a0.55 .55 0 0 1 -1 0l-3.5 -7l-7 -3.5a0.55 .55 0 0 1 0 -1l18 -6.5" /></svg>
                        Send
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    var url = document.querySelector("#count_status").getAttribute("url");
    document.addEventListener('alpine:init', () => {
        Alpine.data('status', () => ({
            open: false,
            async init() {
                this.status = await this.data();
                this.status.open = this.status.open < 1 ? "(" + this.status.open + ")" : this.status.open;
            },
            status: false,
            data() {
                return new Promise((resolve, reject) => {
                    return $.get(url, (r) => {
                        resolve(r.data);
                    })
                })
            },
        }))
    })
</script>
