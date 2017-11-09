<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class MessageRecipientTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      DB::table('message_recipient')->insert([
        'sender_id' => 1,
        'recipient_id' => 4,
        'message_id' => 1,
        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
      ]);

      DB::table('message_recipient')->insert([
        'sender_id' => 1,
        'recipient_id' => 2,
        'message_id' => 2,
        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
      ]);

      DB::table('message_recipient')->insert([
        'sender_id' => 1,
        'recipient_id' => 3,
        'message_id' => 3,
        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
      ]);

      DB::table('message_recipient')->insert([
        'sender_id' => 5,
        'recipient_id' => 1,
        'message_id' => 4,
        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
      ]);

      DB::table('message_recipient')->insert([
        'sender_id' => 5,
        'recipient_id' => 2,
        'message_id' => 4,
        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
      ]);

      DB::table('message_recipient')->insert([
        'sender_id' => 5,
        'recipient_id' => 3,
        'message_id' => 4,
        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
      ]);

      DB::table('message_recipient')->insert([
        'sender_id' => 5,
        'recipient_id' => 4,
        'message_id' => 4,
        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
      ]);
      
      DB::table('message_recipient')->insert([
        'sender_id' => 1,
        'recipient_id' => 5,
        'message_id' => 5,
        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
      ]);

      DB::table('message_recipient')->insert([
        'sender_id' => 2,
        'recipient_id' => 4,
        'message_id' => 6,
        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
      ]);
    }
}
