<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class FollowersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();
        $user = $users->first();
        $user_id = $user->id;

        // 除了1号外的人员
        $followers = $users->slice(1);
        $follower_ids = $followers->pluck('id')->toArray();

        // 1号关注其他人
        $user->follow($follower_ids);

        // 其他人关注1号
        foreach($followers as $follower)
        {
            $follower->follow($user_id);
        }
    }
}
