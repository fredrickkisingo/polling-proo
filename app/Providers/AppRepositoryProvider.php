<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppRepositoryProvider extends ServiceProvider {

    public function boot() {}

    public function register() {

        $models = array(
            'Poll',
            'QuestionAnswer',
        );
        foreach ($models as $model) {
            $this->app->bind("App\Interfaces\\{$model}RepositoryInterface", "App\Repositories\\{$model}Repository");
        }

    }
}
