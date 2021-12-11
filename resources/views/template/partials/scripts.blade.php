<script>
    @if (config('core.path'))
        const baseUrl = "{{ url('/') . '/' . config('core.path') }}";
        const apiUrl = baseUrl.replace("/{{config('core.path') }}", '') + '/api/v1';
    @else
        const baseUrl = "{{ url('/') }}";
        const apiUrl = baseUrl + '/api/v1';
    @endif

    const adminUrl = baseUrl;
</script>

<!-- Tabler Core -->
<script src="{{ asset('vendor/core/js/tabler.min.js') }}"></script>
<!-- Libs JS -->
<script src="{{ asset('vendor/core/libs/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/core/libs/jquery-form/jquery.form.min.js') }}"></script>
<script src="{{ asset('vendor/core/libs/jquery-validate/jquery.validate.min.js') }}"></script>
<script src="{{ asset('vendor/core/libs/pusher/pusher.min.js') }}"></script>

<script>

    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('b7d9914eb73974f7c387', {
      cluster: 'ap1'
    });

    var channel = pusher.subscribe('my-channel');
    channel.bind('my-event', function(data) {
      alert(JSON.stringify(data));
    });
  </script>
  
@livewireScripts

{!! Core::renderScript() !!}

@yield('scripts')
