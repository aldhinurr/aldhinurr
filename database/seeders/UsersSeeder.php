<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserInfo;
use Faker\Generator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Database\Seeders\RolesSeeder;


class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Generator $faker)
    {
        $demoUser = User::create([
            'first_name'        => $faker->firstName,
            'last_name'         => $faker->lastName,
            'email'             => 'demo@demo.com',
            'password'          => Hash::make('demo'),
            'email_verified_at' => now(),
        ]);

        $this->addDummyInfo($faker, $demoUser);

        // User::factory(100)->create()->each(function (User $user) use ($faker) {
        //     $this->addDummyInfo($faker, $user);
        // });

        $role = new RolesSeeder();
        foreach ($role->data() as $dummy) {
            $demoUser = User::create([
                'first_name'        => $dummy['name'],
                'last_name'         => $faker->lastName,
                'email'             => $dummy['name'] . '@demo.com',
                'password'          => Hash::make($dummy['name']),
                'email_verified_at' => now(),
            ]);
            $this->addDummyInfo($faker, $demoUser);
            $demoUser->assignRole($dummy['name']);
        }
    }

    private function addDummyInfo(Generator $faker, User $user)
    {
        $dummyInfo = [
            'company'  => $faker->company,
            'phone'    => $faker->phoneNumber,
            'website'  => $faker->url,
            'language' => $faker->languageCode,
            'country'  => $faker->countryCode,
        ];

        $info = new UserInfo();
        foreach ($dummyInfo as $key => $value) {
            $info->$key = $value;
        }
        $info->user()->associate($user);
        $info->save();
    }
}
