# LaraForum
Laravel forum project

- `composer install`

- `cp .env.example .env`

- `php artisan migrate`

- `php artisan tinker`

- `$threads = factory('App\Thread',50)->create();`

- `$threads->each(function($thread){factory('App\Reply',20)->create(['thread_id'=> $thread->id]);});`