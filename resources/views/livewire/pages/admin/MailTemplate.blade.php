<div class="livewire">
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
                <li class="nav-item" wire:ignore>
                    <a href="#tab-setup" class="nav-link active p-3" data-bs-toggle="tab">Setup</a>
                </li>
                <li class="nav-item" wire:ignore>
                    <a href="#tab-templates" class="nav-link p-3" data-bs-toggle="tab">Email Templates</a>
                </li>
            </ul>
            <div class="card-body">
                <div class="tab-content">
                    <div id="tab-setup" class="tab-pane active show" wire:ignore.self>
                        <form action="">
                            <div class="mb-3">
                                <label class="form-label">Header Email</label>
                                <textarea class="form-control" name="header_email"
                                    wire:model="header.value"></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Footer Email</label>
                                <textarea class="form-control summernote" name="footer_email" wire:ignore></textarea>
                            </div>
                            <div class="d-flex align-items-center">
                                <button type="submit" class="btn btn-primary ms-auto">Save changes</button>
                            </div>
                        </form>
                    </div>
                    <div id="tab-templates" class="tab-pane" wire:ignore.self>

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@section('scripts')
    <script>
        $('.summernote').summernote({
            height: 200
        });
    </script>
@endsection
