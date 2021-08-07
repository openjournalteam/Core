<!doctype html>
<html lang="en">
@include('core::template.partials.header')



<body class="antialiased">

    @auth

        @php
            $user = Auth::user();
            $unreadNotifications = $user
                ->unreadNotifications()
                ->limit(5)
                ->get();
        @endphp

        <div class="wrapper">
            @include('core::template.partials.aside')
            @include('core::template.partials.nav')
            <div class="page-wrapper" style="min-height: 92vh;">
                <div class="container-fluid">

                    {{ apply_filters('core::template::default::content::before', false) }}

                    @if ($view)
                        {{ view($view, $data, $mergeData) }}
                    @endif

                    {{ apply_filters('core::template::default::content::after', false) }}

                </div>
                @include('core::template.partials.footer')

            </div>
        </div>
    @endauth

    @guest
        <div class="page-wrapper" style="min-height: 100vh;">
            {{ view($view, $data, $mergeData) }}
        </div>
    @endguest


    @include('core::template.partials.scripts')
</body>

</html>
