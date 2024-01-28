<header id="team-header">
    <div class="container mx-auto px-10">
        
        <div id="header-img">
            <img src="https://placehold.co/1000x170" />
        </div>

        <div class="flex flex-row flex-wrap items-center justify-between py-8" id="profile-row">
            <div id="profile-image">
                <img class="rounded-full" src="https://placehold.co/160x160" alt="{{ $user->name }} profile photo" />
            </div>
            <div id="profile-info">
                <p>{{ $user->name }}</p>
                <p><span>@</span>{{ $user->userslug }}</p>
                <p><!-- user description --></p>
                <ul class="flex flex-row flex-wrap gap-3" id="profile-links">
                    <li>Website</li>
                    <li>Instagram</li>
                    <li>Youtube</li>
                    <li>Tiktok</li>
                </ul>
            </div>
            <div class="flex flex-col gap-3" id="profile-tasks">
                <a class="btn" href="#">Message</a>
                <a class="btn" href="#">Follow</a>

                @if( $memberships > 0 )
                    <a class="btn" href="#">Memberships</a>
                @endif
            </div>
        </div>

    </div>
</header>