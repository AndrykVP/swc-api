<?php

namespace AndrykVP\Rancor\Database\Seeders;

use Illuminate\Database\Seeder;
use AndrykVP\Rancor\Structure\Models\Award;
use AndrykVP\Rancor\Structure\Models\Department;
use AndrykVP\Rancor\Structure\Models\Faction;
use AndrykVP\Rancor\Structure\Models\Rank;
use AndrykVP\Rancor\Structure\Models\Type;
use AndrykVP\Rancor\News\Models\Article;
use AndrykVP\Rancor\News\Models\Tag;
use AndrykVP\Rancor\Holocron\Models\Collection;
use AndrykVP\Rancor\Holocron\Models\Node;
use AndrykVP\Rancor\Forums\Models\Board;
use AndrykVP\Rancor\Forums\Models\Category;
use AndrykVP\Rancor\Forums\Models\Discussion;
use AndrykVP\Rancor\Forums\Models\Group;
use AndrykVP\Rancor\Forums\Models\Reply;
use AndrykVP\Rancor\Scanner\Models\Entry;
use App\Models\User;

class TestSeeder extends Seeder
{
   /**
    * Run the database seeds.
    *
    * @return void
    */
   public function run()
   {
      /** 
       * Structure Seeding
       */
      $factions = Faction::factory()->count(4)->create();
      $departments = Department::factory()->count(10)->for($factions->random())->create();
      $ranks = Rank::factory()->count(36)->for($departments->random())->create();

      $types = Type::factory()
                     ->count(4)
                     ->has(Award::factory()->count(8))
                     ->create();

      $users = User::factory()->count(20)->for($ranks->random())->create();

      /**
       * News Seeding
       */
      $tags = Tag::factory()
               ->count(12)
               ->has(Article::factory()
                     ->count(35)
                     ->for($users->random(), 'author')
               )->create();

      /**
       * Holocron Seeding
       */
      $collections = Collection::factory()
                     ->count(12)
                     ->has(Node::factory()
                           ->count(15)
                           ->for($users->random(), 'author')
                     )->create();

      /**
       * Forum Seeding
       */
      $groups = Group::factory()
                     ->count(5)
                     ->has(Category::factory()
                           ->count(2)
                           ->has(Board::factory()
                                 ->count(3)
                                 ->has(Discussion::factory()
                                       ->count(6)
                                       ->for($users->random(), 'author')
                                       ->has(Reply::factory()
                                             ->count(50)
                                             ->for($users->random(), 'author')
                                       )
                                 )
                           )
                     )
                     ->create();

      /**
       * Scanner Seeding
       */
      $entries = Entry::factory()->count(2000)->for($users->random(), 'contributor')->create();
      
   }
}