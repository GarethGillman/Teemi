<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        @php
        $account_type = request()->account;
        @endphp

        <!-- Name -->
        <div>
            @if( $account_type == 'team' )
                <x-input-label for="name" :value="__('Team Name')" />
            @else
                <x-input-label for="name" :value="__('Name')" />
            @endif
                
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                type="password"
                name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>
        
        @if( $account_type == 'team' || $account_type == 'individual' )

            <x-text-input name="firstlogin" type="hidden" value="true" />
            <x-text-input name="verified" type="hidden" value="false" />

            @if( $account_type == 'team' )
                <x-text-input name="usertype" type="hidden" value="team" />
            @elseif( $account_type == 'individual' )
                <x-text-input name="usertype" type="hidden" value="individual" />
            @endif

            @php
            $sports_list = array(
                'football',
                'usafootball',
                'baseball',
                'basketball',
                'boxing',
                'cricket',
                'icehockey',
                'rugby',
                'tennis'
            );
            @endphp

            <div class="input-wrapper">
                <x-input-label for="sport" value="{{ __('Sport') }}" />
                <select name="sport">
                    <option value="" selected hidden disabled>Select a sport</option>
                    @foreach( $sports_list as $sport )
                        <option value="{{ $sport }}">{{ $sport }}</option>
                    @endforeach
                </select>
            </div>
        @else
            <x-text-input name="usertype" type="hidden" value="fan" />
            <x-text-input name="verified" type="hidden" value="true" />
            <x-text-input name="sport" type="hidden" value="n/a" />
            <x-text-input name="firstlogin" type="hidden" value="true" />
        @endif

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
