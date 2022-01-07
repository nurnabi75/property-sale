<?php

namespace Database\Seeders;

use App\Models\NewProperty;
use App\Models\Page;
use App\Models\User;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $page = new Page();
        $page->name = 'Contact us';
        $page->slug = 'contuct-us';
        $page->content = 'lorem';
        $page->save();
        
        $page = new Page();
        $page->name = 'About us';
        $page->slug = 'about-us';
        $page->content = 'lorem';
        $page->save();

        $user = new User();
        $user->name = 'Nurnabi Islam';
        $user->email = 'nurnabi@website.com';
        $user->email_verified_at = now();
        $user->password = Hash::make('nurnabi@website.com');
        $user->remember_token = Str::random(10);
        $user->save();


        \App\Models\Location::factory(10)->create();
        NewProperty::factory(30)->create();
        \App\Models\Media::factory(500)->create();
    }
}
