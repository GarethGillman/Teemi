<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use App\Models\User;
use App\Models\Memberships;
use App\Models\Subscriptions;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{

    public function profile(Request $request): View
    {
        $profile_user_id = User::where('userslug', '=', $request->id)->pluck('id');
        $profile_user = User::where('userslug', '=', $request->id)->first();

        if( $profile_user ) {
            $memberships = Memberships::where('userid', '=', $profile_user_id)->count();

            if( auth()->check() ) {

                // Logged In
                $logged_user_id = auth()->user()->id;
                $user_following = auth()->user()->following;
                $user_following_array = explode(",", $user_following);
                $user_subscriptions = Subscriptions::where('teamid', '=', $profile_user_id)->count();

                // Set following status
                if( in_array($logged_user_id, $user_following_array) ) {
                    $following_profile = 'true';
                } else {
                    $following_profile = 'false';
                }

                // Check if subsription
                if( $user_subscriptions > 0 ) {
                    if( in_array($logged_user_id, $user_following_array) ) {
                        // Member and Follower
                        $posts = Posts::where('userid', '=', $profile_user_id)
                            ->where('visibility', '=', 'all')
                            ->where('visibility', '=', 'members')
                            ->where('visibility', '=', 'followers')
                            ->get();
                    } else {
                        // Member only
                        $posts = Posts::where('userid', '=', $profile_user_id)
                            ->where('visibility', '=', 'all')
                            ->where('visibility', '=', 'members')
                            ->get();
                    }
                } else {
                    if( in_array($logged_user_id, $user_following_array) ) {
                        // Follower
                        $posts = Posts::where('userid', '=', $profile_user_id)
                            ->where('visibility', '=', 'all')
                            ->where('visibility', '=', 'followers')
                            ->get();
                    } else {
                        // Non Follower
                        $posts = Posts::where('userid', '=', $profile_user_id)
                            ->where('visibility', '=', 'all')
                            ->get();
                    }
                }
                
            } else {
                // Not Logged In
                $following_profile = 'false';

                $posts = Posts::where('userid', '=', $profile_user_id)
                    ->where('visibility', '=', 'all')
                    ->get();
            }            

            return view('profile.view', [
                'user' => $profile_user,
                'memberships' => $memberships,
                'posts' => $posts,
                'following' => $following_profile,
            ]);
        } else {
            return view('profile.error', [
                'user' => $request->id,
            ]);
        }
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    /**
     * Follow a team
     */
    public function follow(Request $request)
    {
        $profile_user = User::where('id', '=', $request->id)->get();
        $logged_user = Auth::user();

        if( $profile_user && $logged_user ) {
            $user_following = $logged_user->following;

            if( !empty( $user_following ) ) {
                $following_ids = $logged_user->following;
                array_push($following_ids, $profile_user->id);
                User::where('id', $logged_user->id)
                    ->update(['following' => $following_ids]);
            } else {
                $following_ids = array();
                array_push($following_ids, $profile_user->id);
                User::where('id', $logged_user->id)
                    ->update(['following' => $following_ids]);
            }
        }
        
        return back()->with('status', 'Now following '. $profile_user->name);
    }

    /**
     * Unfollow a team
     */
    public function unfollow(Request $request)
    {
        $profile_user = User::where('id', '=', $request->id)->get();
        $logged_user = Auth::user();

        if( $profile_user && $logged_user ) {
            $user_following = $logged_user->following;

            if( !empty( $user_following ) ) {
                $following_ids = $logged_user->following;
                array_push($following_ids, $profile_user->id);
                User::where('id', $logged_user->id)
                    ->update(['following' => $following_ids]);

                return back()->with('status', 'Now following '. $profile_user->name);
            } else {
                return back();
            }
        }
    }
}
