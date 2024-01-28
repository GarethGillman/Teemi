@if( $user->usertype == 'team' || $user->usertype == 'individual' )

    <x-app-layout>
    
        <!-- Profile Header -->
        @include('profile.partials.header-team')

        <!-- Profile Posts / Comments etc -->
        @include('profile.partials.content-team')

    </x-app-layout>

@else

    <x-app-layout>

    </x-app-layout>

@endif

