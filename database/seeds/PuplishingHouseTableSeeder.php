<?php

use Illuminate\Database\Seeder;
use App\Models\Puplisher;
use Faker\Factory as Faker;
class PuplishingHouseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $puplisher = new Puplisher();
        $puplisher->name = 'YAPI KREDİ YAYINLARI';
        $puplisher->info =  $faker->text(50);
        $puplisher->save();


        $puplisher = new Puplisher();
        $puplisher->name = 'CAN YAYINLARI';
        $puplisher->info =  $faker->text(50);
        $puplisher->save();


        $puplisher = new Puplisher();
        $puplisher->name = 'İTHAKİ YAYINLARI';
        $puplisher->info =  $faker->text(50);
        $puplisher->save();


        $puplisher = new Puplisher();
        $puplisher->name = 'İNDİGO KİTAP';
        $puplisher->info =  $faker->text(50);
        $puplisher->save();

        $puplisher = new Puplisher();
        $puplisher->name = 'SEL YAYINCILIK';
        $puplisher->info =  $faker->text(50);
        $puplisher->save();

    }
}
