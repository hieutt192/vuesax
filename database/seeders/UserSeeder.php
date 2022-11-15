<?php

namespace Database\Seeders;

use App\Models\Role;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('role_users')->truncate();
        DB::table('users')->truncate();
        DB::table('roles')->truncate();
        $roles = [
            [
                'name' => 'Admin',
                'slug' => 'admin',
            ],
            [
                'name' => 'Editor',
                'slug' => 'editor',
            ],
            [
                'name' => 'User',
                'slug' => 'user',
            ],
        ];

        Role::insert($roles);

        $users = [
            [
                'first_name' => fake()->name(),
                'email' => 'admin@example.com',
                'phone' => fake()->phoneNumber(),
                'birthday' => fake()->date(),
                'address' => fake()->address(),
            ],
            [
                'first_name' => fake()->name(),
                'email' => 'editor@example.com',
                'phone' => fake()->phoneNumber(),
                'birthday' => fake()->date(),
                'address' => fake()->address(),
            ],
            [
                'first_name' => fake()->name(),
                'email' => 'user@example.com',
                'phone' => fake()->phoneNumber(),
                'birthday' => fake()->date(),
                'address' => fake()->address(),
            ],
            [
                'first_name' => fake()->name(),
                'email' => 'use1r@example.com',
                'phone' => fake()->phoneNumber(),
                'birthday' => fake()->date(),
                'address' => fake()->address(),
            ],
            [
                'first_name' => fake()->name(),
                'email' => 'user2@example.com',
                'phone' => fake()->phoneNumber(),
                'birthday' => fake()->date(),
                'address' => fake()->address(),
            ],
            [
                'first_name' => fake()->name(),
                'email' => 'user3@example.com',
                'phone' => fake()->phoneNumber(),
                'birthday' => fake()->date(),
                'address' => fake()->address(),
            ],
            [
                'first_name' => fake()->name(),
                'email' => 'user4@example.com',
                'phone' => fake()->phoneNumber(),
                'birthday' => fake()->date(),
                'address' => fake()->address(),
            ],
            [
                'first_name' => fake()->name(),
                'email' => 'user5@example.com',
                'phone' => fake()->phoneNumber(),
                'birthday' => fake()->date(),
                'address' => fake()->address(),
            ],
            [
                'first_name' => fake()->name(),
                'email' => 'user6@example.com',
                'phone' => fake()->phoneNumber(),
                'birthday' => fake()->date(),
                'address' => fake()->address(),
            ],
            [
                'first_name' => fake()->name(),
                'email' => 'user7@example.com',
                'phone' => fake()->phoneNumber(),
                'birthday' => fake()->date(),
                'address' => fake()->address(),
            ],
            [
                'first_name' => fake()->name(),
                'email' => 'user8@example.com',
                'phone' => fake()->phoneNumber(),
                'birthday' => fake()->date(),
                'address' => fake()->address(),
            ],
            [
                'first_name' => fake()->name(),
                'email' => 'user9@example.com',
                'phone' => fake()->phoneNumber(),
                'birthday' => fake()->date(),
                'address' => fake()->address(),
            ],
            [
                'first_name' => fake()->name(),
                'email' => 'user10@example.com',
                'phone' => fake()->phoneNumber(),
                'birthday' => fake()->date(),
                'address' => fake()->address(),
            ],
        ];

        foreach ($users as $userItem)
        {
            //$user  =  \App\Models\User::factory()->create($userItem);
            $userItem['password'] = '1234567@';
            $user = Sentinel::registerAndActivate($userItem);
            switch ($userItem['email'])
            {
                case 'admin@example.com':
                    $role = Sentinel::findRoleBySlug('admin');
                    $role->users()->attach($user);
                    break;
                case 'editor@example.com':
                    $role = Sentinel::findRoleBySlug('editor');
                    $role->users()->attach($user);
                    break;
                case 'user@example.com':
                    $role = Sentinel::findRoleBySlug('user');
                    $role->users()->attach($user);
                    break;
                // case 'user1@example.com':
                //     $role = Sentinel::findRoleBySlug('user');
                //     $role->users()->attach($user);
                //     break;
                // case 'user2@example.com':
                //     $role = Sentinel::findRoleBySlug('user');
                //     $role->users()->attach($user);
                //     break;
                // case 'user3@example.com':
                //     $role = Sentinel::findRoleBySlug('user');
                //     $role->users()->attach($user);
                //     break;
                // case 'user4@example.com':
                //     $role = Sentinel::findRoleBySlug('user');
                //     $role->users()->attach($user);
                //     break;
                // case 'user5@example.com':
                //     $role = Sentinel::findRoleBySlug('user');
                //     $role->users()->attach($user);
                //     break;
                // case 'user6@example.com':
                //     $role = Sentinel::findRoleBySlug('user');
                //     $role->users()->attach($user);
                //     break;
                // case 'user7@example.com':
                //     $role = Sentinel::findRoleBySlug('user');
                //     $role->users()->attach($user);
                //     break;
                // case 'user8@example.com':
                //     $role = Sentinel::findRoleBySlug('user');
                //     $role->users()->attach($user);
                //     break;
                // case 'user9@example.com':
                //     $role = Sentinel::findRoleBySlug('user');
                //     $role->users()->attach($user);
                //     break;
                // case 'user10@example.com':
                //     $role = Sentinel::findRoleBySlug('user');
                //     $role->users()->attach($user);
                //     break;
            }
        }
    }
}
