<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\User;

class MessagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      $gru = User::where('name', 'Gru')->first();
      $bob = User::where('name', 'Bob')->first();
      $kevin = User::where('name', 'Kevin')->first();
      $stuart = User::where('name', 'Stuart')->first();
      $scarlet = User::where('name', 'Scarlet Overkill')->first();

      DB::table('messages')->insert([
        'sender_id' => $gru->id,
        // 'recipient_id' => $stuart->id,
        'subject' => 'Chores for Stuart',
        'body' => 'Please take out the recycling and wash the Grumobile. Thanks!',
        'is_read' => false,
        'is_starred' =>false,
        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
      ]);

      DB::table('messages')->insert([
        'sender_id' => $gru->id,
        // 'recipient_id' => $bob->id,
        'subject' => 'Chores for Bob',
        'body' => 'Please feed Kyle and sweep the secret lab. Thank you!',
        'is_read' => false,
        'is_starred' =>false,
        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
      ]);

      DB::table('messages')->insert([
        'sender_id' => $gru->id,
        // 'recipient_id' => $bob->id,
        'subject' => 'Chores for Kevin',
        'body' => 'Please rake the leaves and charge the laser cannon. I appreciate you!',
        'is_read' => false,
        'is_starred' =>false,
        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
      ]);

      DB::table('messages')->insert([
        'sender_id' => $scarlet->id,
        // 'recipient_id' => $bob->id,
        'subject' => 'Revenge',
        'body' => 'I\'m going to get you, you little yellow weirdo!',
        'is_read' => false,
        'is_starred' =>false,
        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
      ]);

      DB::table('messages')->insert([
        'sender_id' => $gru->id,
        // 'recipient_id' => $scarlet->id,
        'subject' => 'Parking',
        'body' => 'Hello there. I noticed that you left your car in my parking spot again. Even though I am now a Good Guy, the Villain Code still applies (see Article 7). Thank you for keeping this in mind in the future. PS. I have reported you to HQ. Have a nice day.',
        'is_read' => false,
        'is_starred' =>false,
        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
      ]);

      DB::table('messages')->insert([
        'sender_id' => $bob->id,
        // 'recipient_id' => $stuart->id,
        'subject' => 'Bello, buddy!',
        'body' => 'Coopee linda Gelato!',
        'is_read' => true,
        'is_starred' =>true,
        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
      ]);

    }
}
