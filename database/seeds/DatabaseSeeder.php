<?php

use Illuminate\Database\Seeder;
use App\Message;
use App\User;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $spec = [
            [
                'name'=>'Dokter Umum',
                'title_start'=> 'dr.',
                "title_end"=>null,
            ],[
                'name'=>"Spesialis Kebidanan Kandungan",
                'title_start'=>"dr.",
                'title_end'=>"Sp.OG",
            ],[
                "name"=>"Spesialis Anak",
                "title_start"=>"dr.",
                "title_end"=>"Sp.A",
            ],[
                "name"=>"Spesialis penyakit mulut",
                "title_start"=>"drg.",
                "title_end"=>"Sp.PM"
            ],[
                "name"=>"Dokter Gigi",
                "title_start"=>"drg.",
                "title_end"=>null,
            ]
        ];

        DB::table("specializations")->insert($spec);

        
        factory(User::class, 10)->create([
            'type'=>"doctor",
        ]);
        factory(User::class, 10)->create([
            'type'=>"user",
        ]);
        factory(Message::class, 100)->create();
    }
}