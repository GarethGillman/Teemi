@php
$user_type = auth()->user()->usertype;
$user_id = auth()->user()->id;
@endphp

@if( $user_type  == 'team' || $user_type == 'individual' )

    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Posts') }}
            </h2>
        </x-slot>

        <div class="flex flex-col gap-8 py-12 lg:flex-row lg:flex-wrap lg:gap-0">

            <div class="sidebar w-full lg:pr-4 lg:w-4/12">
                <x-widgets.dashboard-menu />
            </div>

            <div class="content w-full lg:pl-4 lg:w-8/12">
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
                        <h3>Posts</h3>
                        <a class="btn" href="{{ route('posts.create') }}">Add Post</a>

                        <table>
                            <thead>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Type</th>
                                <th>Created</th>
                                <th>Status</th>
                                <th></th>
                            </thead>
                            <tbody>
                                @foreach( $posts as $post )
                                    <tr>
                                        <td>{{ $post->id }}</td>
                                        <td>{{ $post->title }}</td>
                                        <td>{{ $post->type }}</td>
                                        <td>{{ $post->created_at }}</td>
                                        <td>{{ $post->status }}</td>
                                        <td>
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