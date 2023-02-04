<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Menu;
use App\Models\Sale;
use App\Models\User;
use App\Models\Table;
use App\Models\Servant;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Database\Seeders\CategorySeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        
         \App\Models\User::factory(10)->create();
         \App\Models\Category::factory(10)->create();
         \App\Models\Menu::factory(10)->create();
        //  \App\Models\Sale::factory(10)->create();
         \App\Models\Servant::factory(10)->create();
         \App\Models\Table::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // $this->call(CategorySeeder::class);
        // $this->call(MeuSeeder::class);
        // $this->call(ServantSeeder::class);
        // $this->call(TableSeeder::class); 
        
    }
}
