@php
$user_type = auth()->user()->usertype;
$user_id = auth()->user()->id;
$today_date = date('Y-m-d');
$today_time = date('H:i');
$date_time = $today_date.'T'.$today_time;
@endphp

@if( $user_type  == 'team' || $user_type == 'individual' )

    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Memberships') }}
            </h2>
        </x-slot>

        <div class="flex flex-col gap-8 py-12 lg:flex-row lg:flex-wrap lg:gap-0">

            <div class="sidebar w-full lg:pr-4 lg:w-4/12">
                <x-widgets.dashboard-menu />
            </div>

            <div class="content w-full lg:pl-4 lg:w-8/12">
                <div class="bg-white dark:bg-gray-800 overflow-hidden p-6 shadow-sm sm:rounded-lg">
                
                    <h3>Create Membership</h3>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('memberships.save') }}">
                        @csrf

                        <x-text-input type="hidden" name="userid" value="{{ $user_id }}" />

                        <div>
                            <x-input-label for="name" :value="__('Membership Name')" />
                            <x-text-input type="text" name="name" required />
                        </div>

                        <div>
                            <x-input-label for="description" :value="__('Membership Description')" />
                            <textarea name="description" required></textarea>
                        </div>

                        <div>
                            <x-input-label for="starts" :value="__('Start Date / Time')" />
                            <input type="datetime-local" name="starts" value="{{ $date_time }}" min="{{ $date_time }}" />
                        </div>

                        <div>
                            <x-input-label for="ends" :value="__('End Date / Time')" />
                            <input type="datetime-local" name="ends" value="{{ $date_time }}" min="{{ $date_time }}" />
                        </div>

                        <div>
                            <x-input-label for="limit" :value="__('Membership Limit')" />
                            <p>0 is unlimited</p>
                            <input type="number" name="limit" value="0" min="0" />  
                        </div>

                        <div>
                            <x-input-label for="price" :value="__('Monthly Price')" />
                            <input type="number" name="price" step="0.01" value="0.00" min="0.00" />
                        </div>

                        <div>
                            <x-input-label for="name" :value="__('Membership Status')" />
                            <select name="status">
                                <option selected value="active" >Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>

                        <x-primary-button type="submit">Create</x-primary-button>

                    </form>

                </div>
            </div>
        </div>

    </x-app-layout>

@else

    <x-app-layout>
        <h1>No permission to view this content</h1>
    </x-app-layout>

@endif