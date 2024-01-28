@php
$user_type = auth()->user()->usertype;
@endphp

<aside id="sidebar">
            
    @if( $user_type == 'team' || $user_type == 'individual' )
        <ul>
            <li><a href="{{ route('posts.index') }}">Posts</a></li>
            <li><a href="{{ route('memberships.index') }}">Memberships</a></li>
            <li><a href="{{ route('staff.index') }}">Staff</a></li>
            <li><a href="#">Settings</a></li>
        </ul>
    @elseif( $user_type == 'staff' )
                    
    @else

    @endif

</aside>