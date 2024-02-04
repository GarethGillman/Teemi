<section id="profile-content">
    <div class="container mx-auto">
        
        <!-- Filters -->
        <ul class="border-b-2 flex flex-row flex-wrap gap-6 items-center justify-center pb-3" id="content-filters">
            @if( $posts )
                <li><a class="border-b border-b-blue-500 p-3 hover:bg-gray-300" href="#">Posts</a></li>
            @endif 
            <li><a href="#">Comments</a></li>
        </ul>

        <div id="posts-wrapper">
            @foreach( $posts as $post ) 
                <div class="post-container">
                    {{ $post->title }}

                    {{ $post->created_at }}

                    {{ $post->description }}

                </div>

                <div id="comments-wrapper">
                    @php
                    $comments = DB::table('comments')->where('postid', '=', $post->id)->get();
                    @endphp
                </div>
            @endforeach
        </div>

    </div>
</section>