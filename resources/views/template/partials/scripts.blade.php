<!-- Tabler Core -->
<script src="{{ asset('vendor/core/js/tabler.min.js') }}"></script>
<!-- Libs JS -->
<script src="{{ asset('vendor/core/libs/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/core/libs/jquery-form/jquery.form.min.js') }}"></script>
<script src="{{ asset('vendor/core/libs/jquery-validate/jquery.validate.min.js') }}"></script>

@livewireScripts

{!! Core::renderScript() !!}

<script>
    @if (config('core.path'))
        const baseUrl = "{{ url('/') . '/' . config('core.path') }}";
    @else
        const baseUrl = "{{ url('/') }}";
    @endif

    const adminUrl = baseUrl + '/admin';

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Enable pusher logging - don't include this in production

    @auth
        @if (config('app.debug'))
            Pusher.logToConsole = true;
        @endif
        var pusher = new Pusher('{{ config('broadcasting.connections.pusher.key') }}', {
        cluster: '{{ config('broadcasting.connections.pusher.options.cluster') }}'
        });
    @endauth

    // Example of a channel subscription
    // var channel = pusher.subscribe('new-customer');
    // channel.bind('OpenJournalTeam\\Master\\Events\\NewCustomer', function(data) {
    //     Toast.fire({
    //         icon: 'info',
    //         title: 'New Customer',
    //         text: `New Customer ${data.customer.name}`
    //     })
    // });
</script>
@yield('scripts')
