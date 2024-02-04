@php
$user_type = auth()->user()->usertype;
$user_id = auth()->user()->id;
@endphp

@if( $user_type  == 'team' || $user_type == 'individual' )

    <x-app-layout>
    
        <div class="container flex flex-col gap-8 mx-auto px-8 lg:flex-row lg:flex-wrap lg:gap-0 lg:justify-between">

            <x-widgets.dashboard-menu />

            <div class="content w-full lg:pl-6 lg:w-4/5">
                <div class="bg-white dark:bg-gray-800 overflow-hidden p-6 shadow-sm sm:rounded-lg">

                    @session('status')
                        <div class="p-4 bg-green-100">
                            {{ $value }}
                        </div>
                    @endsession

                    @session('error')
                        <div class="p-4 bg-red-100">
                            {{ $value }}
                        </div>
                    @endsession
                
                    @if( $posts_count > 0 )

                        <div class="flex flex-row justify-between mb-6">
                            <h3>Posts</h3>
                            <a class="btn" href="{{ route('posts.create') }}">Add Post</a>
                        </div>

                        <table class="text-left w-full">
                            <thead>
                                <th class="hidden md:block">ID</th>
                                <th>Name</th>
                                <th>Type</th>
                                <th class="hidden md:block">Created</th>
                                <th>Status</th>
                                <th></th>
                            </thead>
                            <tbody>
                                @foreach( $posts as $post )
                                    <tr>
                                        <td class="hidden md:block">{{ $post->id }}</td>
                                        <td>{{ $post->title }}</td>
                                        <td>{{ $post->type }}</td>
                                        <td class="hidden md:block">{{ $post->created_at }}</td>
                                        <td>{{ $post->status }}</td>
                                        <td class="flex flex-row justify-between md:gap-4 md:justify-end">
                                            <a class="btn" href="{{ route('posts.edit', ['id' => $post->id]) }}">Edit</a>
                                            <a class="btn" href="{{ route('posts.delete', ['id' => $post->id]) }}">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                                
                            </tbody>
                        </table>

                    @else

                        <p>No Posts</p>
                        <a class="btn" href="{{ route('posts.create') }}">Add Post</a>
                        
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