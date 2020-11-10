<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class MoreUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            'Mark Ranlargent' => User::create([
                'firstname' => 'Mark',
                'lastname' => 'Ranlargent',
                'username' => 'Fillon',
                'email' => 'fillon@example.com',
                'password' => Hash::make('root'),
                'email_verified_at' => now(),
            ]),

            'Dustin Ragequitz' => User::create([
                'firstname' => 'Dustin',
                'lastname' => 'Ragequitz',
                'username' => 'Balkany',
                'email' => 'balkany@example.com',
                'password' => Hash::make('root'),
                'email_verified_at' => now(),
            ]),

            'Chris Oof ' => User::create([
                'firstname' => 'Chris',
                'lastname' => 'Oof',
                'username' => 'Cahuzac',
                'email' => 'cahuzac@example.com',
                'password' => Hash::make('root'),
                'email_verified_at' => now(),
            ]),
        ];

        $post = new Post([
            'user_id'     => $users['Mark Ranlargent'] -> id,
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec dignissim nibh a lectus egestas bibendum. Morbi in odio porttitor, venenatis quam eu, ultrices nisl. Nunc erat risus, gravida eu iaculis et, porttitor eu enim. Cras sollicitudin leo eu augue faucibus, efficitur vulputate tellus accumsan. Pellentesque pellentesque eu mauris quis blandit. Etiam suscipit tellus et dolor placerat, et pretium dui rutrum. Nulla malesuada eros est, efficitur feugiat diam pulvinar et. Nullam mattis mi arcu, a dapibus ex semper vitae. Nullam bibendum ligula ac enim fermentum facilisis. Fusce nisl turpis, pharetra ac sagittis at, lacinia blandit tortor. Suspendisse quis blandit nisi. Cras gravida at lacus gravida dapibus. Proin ac mauris consectetur est egestas condimentum. Phasellus scelerisque lacus eget tellus malesuada interdum.
                              Nam hendrerit enim ac sollicitudin sodales. Nullam eget bibendum neque. Vivamus rutrum porttitor commodo. Donec a sapien et purus tincidunt aliquet. Phasellus facilisis massa aliquam, finibus nulla sed, malesuada nisl. Etiam eros nulla, facilisis vel tellus et, viverra elementum lectus. Maecenas sit amet finibus nibh. Praesent hendrerit, sem et lacinia tincidunt, urna ante ullamcorper enim, vel imperdiet lacus quam ac libero. Pellentesque et dictum leo. In hac habitasse platea dictumst. Pellentesque porttitor magna ac convallis rhoncus. Nullam cursus lectus interdum tempus.'
        ]);

        $post->save();

        unset($users['Mark Ranlargent']);

        foreach($users as $key => $user)
        {
            $comment = new Comment([
                'comment'   => 'Ceci est un commentaire de la part de ' . $key,
                'author_id' => $user->id,
                'post_id'   => $post->id,
            ]);

            $comment->save();
        }

	}
}
