<?php

use Illuminate\Database\Seeder;
use App\Channel;

class ChannelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $chns = [
            [
                'name'=>'Umum',
                'slug'=>'umum'
            ],[
                'name'=>'Telinga Hidung Tenggorokan (THT)',
                'slug'=>'tht',
            ],[
                'name'=> 'Mata',
                'slug'=>'mata',
            ],[
                'name'=>'Diet',
                'slug'=>'diet'
            ],[
                'name'=>'Kesehatan Anak',
                'slug'=>'kesehatan-anak'
            ]
            ];

            foreach($chns as $ch){
                Channel::create($ch);
            }
    }
}
