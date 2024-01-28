@php
$user_verified = auth()->user()->verified;
@endphp

@if( $user_verified  == 'true' )

    @include('partials.dashboard-navigation')

    <main id="content-wrapper">
        <x-widgets.dashboard-menu />

        <section id="main-content">

            <x-widgets.welcome />

        </section>
    </main>

@else

    {{ __("Please verify your account") }}
         
@endif