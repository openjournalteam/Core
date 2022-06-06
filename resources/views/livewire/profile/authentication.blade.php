<div>
    <div class="card">
        <div class="card-body d-flex align-items-center">
            <div>
                <h3>Password</h3>
                <div class="span">Change your password any time.</div>
            </div>
            <div class="ms-auto">
                <button class="btn btn-primary" data-bs-toggle="modal"
                    data-bs-target="#modal-change-password">Change</button>
            </div>
        </div>
    </div>
    <div class="modal modal-blur fade" id="modal-change-password" tabindex="-1" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Change Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent='changePassword'>
                    <div class="modal-body" x-data="{
                        showPassword: false,
                        showNewPassword: false,
                        togglePassword: function() {
                            this.showPassword = !this.showPassword;
                        },
                        toggleNewPassword: function() {
                            this.showNewPassword = !this.showNewPassword;
                        }
                    }">
                        <div class="mb-3">
                            <div class="d-flex align-items-center mb-2">
                                <label class="form-label mb-0">Old Password</label>
                                <div class="ms-auto">
                                    <a href="#" @@click.prevent="togglePassword" class="form-text">
                                        <div x-show="showPassword">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="icon icon-tabler icon-tabler-eye-off" width="24" height="24"
                                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <line x1="3" y1="3" x2="21" y2="21"></line>
                                                <path d="M10.584 10.587a2 2 0 0 0 2.828 2.83"></path>
                                                <path
                                                    d="M9.363 5.365a9.466 9.466 0 0 1 2.637 -.365c4 0 7.333 2.333 10 7c-.778 1.361 -1.612 2.524 -2.503 3.488m-2.14 1.861c-1.631 1.1 -3.415 1.651 -5.357 1.651c-4 0 -7.333 -2.333 -10 -7c1.369 -2.395 2.913 -4.175 4.632 -5.341">
                                                </path>
                                            </svg>
                                            Hide
                                        </div>
                                        <div x-show="!showPassword">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="icon icon-tabler icon-tabler-eye" width="24" height="24"
                                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <circle cx="12" cy="12" r="2"></circle>
                                                <path
                                                    d="M22 12c-2.667 4.667 -6 7 -10 7s-7.333 -2.333 -10 -7c2.667 -4.667 6 -7 10 -7s7.333 2.333 10 7">
                                                </path>
                                            </svg>
                                            Show
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <input :type="showPassword ? 'text' : 'password'"
                                class="form-control @error('oldPassword') is-invalid @enderror"
                                wire:model.defer='oldPassword' placeholder="Input placeholder">
                            @error('oldPassword')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <div class="d-flex align-items-center mb-2">
                                <label class="form-label mb-0">New Password</label>
                                <div class="ms-auto">
                                    <a href="#" @@click.prevent="toggleNewPassword" class="form-text">
                                        <div x-show="showNewPassword">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="icon icon-tabler icon-tabler-eye-off" width="24" height="24"
                                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <line x1="3" y1="3" x2="21" y2="21"></line>
                                                <path d="M10.584 10.587a2 2 0 0 0 2.828 2.83"></path>
                                                <path
                                                    d="M9.363 5.365a9.466 9.466 0 0 1 2.637 -.365c4 0 7.333 2.333 10 7c-.778 1.361 -1.612 2.524 -2.503 3.488m-2.14 1.861c-1.631 1.1 -3.415 1.651 -5.357 1.651c-4 0 -7.333 -2.333 -10 -7c1.369 -2.395 2.913 -4.175 4.632 -5.341">
                                                </path>
                                            </svg>
                                            Hide
                                        </div>
                                        <div x-show="!showNewPassword">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="icon icon-tabler icon-tabler-eye" width="24" height="24"
                                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <circle cx="12" cy="12" r="2"></circle>
                                                <path
                                                    d="M22 12c-2.667 4.667 -6 7 -10 7s-7.333 -2.333 -10 -7c2.667 -4.667 6 -7 10 -7s7.333 2.333 10 7">
                                                </path>
                                            </svg>
                                            Show
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <input :type="showNewPassword ? 'text' : 'password'"
                                class="form-control @error('newPassword') is-invalid @enderror"
                                wire:model.defer='newPassword' placeholder="Input placeholder">
                            @error('newPassword')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
