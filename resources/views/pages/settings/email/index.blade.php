<div class="container">
    <div class="page-header d-print-none">
        <div class="row align-items-center">
            <div class="col">
                <div class="page-pretitle">
                    Settings
                </div>
                <h2 class="page-title">
                    Email
                </h2>
            </div>
            <div class="col-auto ms-auto d-print-none">
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="card" id="menu-component">
            <ul class="nav nav-tabs nav-tabs-alt">
                <li class="nav-item">
                    <a href="#tab-setup" class="nav-link active p-3" data-bs-toggle="tab">Setup</a>
                </li>
                <li class="nav-item">
                    <a href="#tab-templates" class="nav-link p-3" data-bs-toggle="tab">Email Templates</a>
                </li>
            </ul>
            <div class="card-body">
                <div class="tab-content">
                    <div id="tab-setup" class="tab-pane active show">
                        <form action="{{ route('core.admin.email.save_setup') }}" data-control="form">
                            <div class="mb-3">
                                <label class="form-label">Header Email</label>
                                <textarea class="form-control" data-control="summernote"
                                    name="emailHeader">{{ $emailHeader->value }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Footer Email</label>
                                <textarea class="form-control" data-control="summernote"
                                    name="emailFooter">{{ $emailFooter->value }}</textarea>
                            </div>
                            <div class="d-flex align-items-center">
                                <button type="submit" class="btn btn-primary ms-auto">Save changes</button>
                            </div>
                        </form>
                    </div>
                    <div id="tab-templates" class="tab-pane">
                        <div class="d-flex justify-content-end pb-2">
                            <a href="#" class="btn btn-outline-primary" href="#" data-bs-toggle="modal"
                                data-bs-target="#modal-form-email-template">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <rect x="4" y="4" width="16" height="4" rx="1" />
                                    <rect x="4" y="12" width="6" height="8" rx="1" />
                                    <line x1="14" y1="12" x2="20" y2="12" />
                                    <line x1="14" y1="16" x2="20" y2="16" />
                                    <line x1="14" y1="20" x2="20" y2="20" />
                                </svg>
                                Add Template
                            </a>
                        </div>
                        <table class="table table-borderless datatables w-100 table-template"
                            data-ajax="{{ route('core.admin.email.index') }}">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width:5%" data-data="DT_RowIndex" data-name="index"
                                        data-orderable="false" data-searchable="false"
                                        data-class="text-center font-weight-bold">No
                                    </th>
                                    <th data-data="key" class="font-weight-bold">Email Templates
                                    </th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="modal-form-email-template" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="{{ route('core.admin.email.save_template') }}" method="POST" data-control="form"
                autocomplete="off">
                <div class="modal-header">
                    <h5 class="modal-title">Form Email Template</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id">
                    <input type="hidden" name="key" value="SUBSCRIPTION_MAIL">
                    <input type="hidden" name="mailable" value="App\Modules\Shop\Mail\Order\SubscriptionMail">
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <input name="description" type="text" class="form-control" disabled>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Subject</label>
                        <input name="subject" type="text" class="form-control" placeholder="Enter subject" required>
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-9 pt-2">
                                <label class="form-label">Body</label>
                            </div>
                            <div class="col-3 pb-2 text-end">
                                <select class="form-select">
                                    <option selected disabled>Variable</option>
                                    <option value="name">Name</option>
                                    <option value="domain">Domain</option>
                                  </select>
                            </div>
                        </div>
                        <textarea name="html_template" type="text" class="form-control" data-control="summernote"
                            placeholder="Enter body"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
