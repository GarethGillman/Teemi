@php
$user_type = auth()->user()->usertype;
$user_id = auth()->user()->id;
@endphp

@if( $user_type  == 'team' || $user_type == 'individual' )

    <x-app-layout>
    
        <x-widgets.dashboard-menu />

            <div class="content w-full lg:pl-4 lg:w-8/12">
                <div class="bg-white dark:bg-gray-800 overflow-hidden p-6 shadow-sm sm:rounded-lg">
                
                    @if( $staff_count > 0 )
                        <p>{{ $staff_count }} Current Staff Members</p>
                        <a class="btn" href="{{ route('staff.create') }}">Add Staff</a>

                        <table>
                            <thead>
                                <th>User Name</th>
                                <th>Email Address</th>
                                <th></th>
                            </thead>
                            <tbody>
                                @foreach( $staff_list as $staff )
                                    <tr>
                                        <td>{{ $staff->name }}</td>
                                        <td>{{ $staff->email }}</td>
                                        <td><a href="{{ url('dashboard/staff/remove', ['staff' => $staff->id]) }}">Remove</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    @else

                        <p>No Staff found</p>
                        <a class="btn" href="{{ route('staff.add') }}">Add Staff</a>
                    
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