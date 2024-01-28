@php
$user_type = auth()->user()->usertype;
$user_id = auth()->user()->id;
@endphp

@if( $user_type  == 'team' || $user_type == 'individual' )

    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Staff') }}
            </h2>
        </x-slot>

        <div class="flex flex-col gap-8 py-12 lg:flex-row lg:flex-wrap lg:gap-0">

            <div class="sidebar w-full lg:pr-4 lg:w-4/12">
                <x-widgets.dashboard-menu />
            </div>

            <div class="content w-full lg:pl-4 lg:w-8/12">
                <div class="bg-white dark:bg-gray-800 overflow-hidden p-6 shadow-sm sm:rounded-lg">
                
                    @if( $users_count > 0 )

                        <form method="POST" action="{{ route('staff.save') }}">
                            @csrf

                            <x-text-input type="hidden" name="user_id" value="{{ $user_id }}" />

                            <datalist id="users">
                                @foreach( $users as $user )
                                    <option value="{{ $user->email }}">{{ $user->email }}</option>
                                @endforeach
                            </datalist>

                            <x-text-input type="text" name="user" list="users" required />

                            <x-primary-button type="submit">Add User</x-primary-button>

                        </form>

                    @else

                    @endif

                </div>
            </div>
        </div>

    </x-app-layout>

@else

    <x-app-layout>
        <h1>No permission to view this content</h1>
    </x-app-layout>

@endif