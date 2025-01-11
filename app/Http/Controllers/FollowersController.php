<?php

namespace App\Http\Controllers;

use App\Models\Followers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FollowersController extends Controller
{
    public function follower()
    {
        $user = Auth::user();
        $userToFollowId = request('id');
        $userToFollow = User::find($userToFollowId);
        $userFollowers = $userToFollow->followers;

        if ($userFollowers) {
            $userAlreadyFollow = $userToFollow->alreadyFollowing();
            if ($userAlreadyFollow) {
                $userAlreadyFollow->delete();
                return back()->withInput();
            }
        }

        $follow = new Followers();
        $follow->followers()->associate($user);
        $follow->following()->associate($userToFollow);
        $follow->save();

        return back()->withInput();
    }

    public function showFollowLists(Request $request)
    {
        $user = Auth::user();
        $userId = request('id');
        $user = User::find($userId);
        $followersCount = $user->followers()->count();
        $followingCount = $user->following()->count();
        $postsCount = $user->posts()->count();

        $followers = DB::table('followers')
            ->join('users', 'followers.follower_id', '=', 'users.id')
            ->where('followers.following_id', $user->id)
            ->select('users.name', 'users.id', 'users.avatar', 'users.email')
            ->get();

        $following = DB::table('followers')
            ->join('users', 'followers.following_id', '=', 'users.id')
            ->where('followers.follower_id', $user->id)
            ->select('users.name', 'users.id', 'users.avatar', 'users.email')
            ->get();

        return view('profile.follows', ["user" => $user, 'followersCount' => $followersCount, 'followingCount' => $followingCount, 'postsCount' => $postsCount,], compact('user', 'followers', 'following'));
    }
}
