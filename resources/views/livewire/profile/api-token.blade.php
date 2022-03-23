<div>
    @if (!$createToken)
        <div class="d-flex align-items-center mb-3">
            <h3 class="mb-0">API Tokens</h3>
            <a href="#" class="btn btn-sm btn-primary ms-auto" wire:click="$set('createToken', true)">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                    stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <circle cx="9" cy="7" r="4"></circle>
                    <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                    <path d="M16 11h6m-3 -3v6"></path>
                </svg>
                Create Token
            </a>
        </div>
        @if (session('newToken'))
            <div class="alert alert-success" role="alert">
                <div class="d-flex">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24"
                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M5 12l5 5l10 -10"></path>
                        </svg>
                    </div>
                    <div>
                        <h4 class="alert-title">
                            <span>
                                Your new token : {{ session('newToken') }}
                            </span>
                            <span x-data @@click="$clipboard('{{ session('newToken') }}')" data-bs-toggle="tooltip"
                                data-bs-placement="top" title="Copy">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-copy"
                                    width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                    fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <rect x="8" y="8" width="12" height="12" rx="2"></rect>
                                    <path d="M16 8v-2a2 2 0 0 0 -2 -2h-8a2 2 0 0 0 -2 2v8a2 2 0 0 0 2 2h2"></path>
                                </svg>
                            </span>
                        </h4>
                        <div class="text-muted">Make sure to copy your personal access token now. You won't be able
                            to see it again!</div>
                    </div>
                </div>
            </div>
        @endif

        <div class="card">
            @if ($tokens->count() > 0)
                <div class="table-responsive">
                    <table class="table table-vcenter">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th class="w-1">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tokens as $token)
                                <tr>
                                    <td>{{ $token->name }}</td>
                                    <td>
                                        <button class="btn btn-danger"
                                            wire:click='deleteToken("{{ $token->id }}")'>Delete</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="empty">
                    <div class="empty-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-key" width="24"
                            height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <circle cx="8" cy="15" r="4"></circle>
                            <line x1="10.85" y1="12.15" x2="19" y2="4"></line>
                            <line x1="18" y1="5" x2="20" y2="7"></line>
                            <line x1="15" y1="8" x2="17" y2="10"></line>
                        </svg>
                    </div>
                    <p class="empty-title">Oops.</p>
                    <p class="empty-subtitle text-muted">
                        No token found, please create one first
                    </p>
                </div>
            @endif
        </div>
    @else
        <div class="d-flex align-items-center mb-3">
            <h3 class="mb-0">Create Token</h3>
            <a href="#" class="btn btn-sm btn-outline-secondary ms-auto" wire:click="$set('createToken', false)">
                << Back </a>
        </div>
        <div class="card">
            <form wire:submit.prevent='createToken'>
                <div class="card-body">
                    <div class="">
                        <label class="form-label">Name</label>
                        <input wire:model="tokenName" type="text" class="form-control" placeholder="Enter Token Name">
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>
            </form>
        </div>
    @endif
</div>
