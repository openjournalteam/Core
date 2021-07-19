<!-- Tabler Core -->
<script src="{{ asset('vendor/core/js/tabler.min.js') }}"></script>
<!-- Libs JS -->
<script src="{{ asset('vendor/core/libs/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/core/libs/jquery-form/jquery.form.min.js') }}"></script>
<script src="{{ asset('vendor/core/libs/jquery-validate/jquery.validate.min.js') }}"></script>
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
</script>
@yield('scripts')
