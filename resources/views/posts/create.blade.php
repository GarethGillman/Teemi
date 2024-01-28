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
            {{ __('Posts') }}
            </h2>
        </x-slot>

        <div class="flex flex-col gap-8 py-12 lg:flex-row lg:flex-wrap lg:gap-0">

<div class="sidebar w-full lg:pr-4 lg:w-4/12">
    <x-widgets.dashboard-menu />
</div>

<div class="content w-full lg:pl-4 lg:w-8/12">
    <div class="bg-white dark:bg-gray-800 overflow-hidden p-6 shadow-sm sm:rounded-lg">
    
        <h3>Create Post</h3>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('posts.save') }}">
            @csrf

            <x-text-input type="hidden" name="userid" value="{{ $user_id }}" />
            <x-text-input type="hidden" name="type" value="text" />

            <div>
                <x-input-label for="title" :value="__('Post Title')" />
                <x-text-input type="text" name="title" placeholder="Enter a title" required />
            </div>

            <div>
                <x-input-label for="description" :value="__('Post Content')" />
                <textarea name="description"></textarea>
            </div>

            <div>
                <x-input-label for="scheduled" :value="__('Scheduled Start Date')" />
                <input type="datetime-local" name="scheduled" value="{{ $date_time }}" min="{{ $date_time }}" />
            </div>

            <div>
                <x-input-label for="excerpt" :value="__('Post Excerpt')" />
                <textarea name="excerpt"></textarea>
            </div>

            <div>
                <x-input-label for="visibility" :value="__('Post Visibility')" />
                <select name="visibility">
                    <option selected value="all" >all</option>
                    <option value="members">Members</option>
                </select>
            </div>

            <div>
                <x-input-label for="status" :value="__('Post Status')" />
                <select name="status">
                    <option selected value="draft" >Draft</option>
                    <option value="scheduled">Scheduled</option>
                    <option value="published">Published</option>
                </select>
            </div>

            <div>
                <x-input-label for="commenting" :value="__('Comments')" />
                <select name="commenting">
                    <option selected value="on" >On</option>
                    <option value="members">Members Only</option>
                    <option value="off">Off</option>
                </select>
            </div>

            <!-- SEO -->
            <div>
                <x-input-label for="seotitle" :value="__('Post SEO Title')" />
                <x-text-input type="text" name="seotitle" placeholder="Enter a title" />
            </div>

            <div>
                <x-input-label for="slug" :value="__('Post SEO Slug')" />
                <x-text-input type="text" name="slug" placeholder="" required />
            </div>

            <div>
                <x-input-label for="seodesc" :value="__('Post SEO Description')" />
                <textarea name="seodesc"></textarea>
            </div>

            <x-primary-button type="submit">Create</x-primary-button>

        </form>

    </div>
</div>
</div>
    </x-app-layout>

@else

    <x-app-layout>
        <h1>Permissions not found</h1>
    </x-app-layout>

@endif