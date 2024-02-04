@php
$user_id = auth()->user()->id;
@endphp

<div class="comment-form">
    
    <h3>Post Comment</h3>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('comments.save') }}">
        @csrf

        <x-text-input type="hidden" name="userid" value="{{ $user_id }}" />

        <div>
            <x-input-label for="comment" :value="__('Comment')" />
            <textarea name="comment"></textarea>
        </div>

        <x-primary-button type="submit">Submit</x-primary-button>

    </form>
</div>