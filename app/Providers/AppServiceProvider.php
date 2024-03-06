<?php

namespace App\Providers;

use App\Models\Permission;
use App\Repository\EventRepository;
use App\Repository\CategoryRepository;
use App\Repository\Interface\ICategoryRepository;
use App\Repository\Interface\IEventRepository;
use App\Repository\Interface\IRoleRepository;
use App\Repository\Interface\IUserRepository;
use App\Repository\RoleRepository;
use App\Repository\UserRepository;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(IUserRepository::class, UserRepository::class);
        $this->app->bind(ICategoryRepository::class, CategoryRepository::class);
        $this->app->bind(IEventRepository::class, EventRepository::class); 
        $this->app->bind(IRoleRepository::class, RoleRepository::class);
       }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        try {
            Permission::get()->map(function ($permission) {
                Gate::define($permission->name, function ($user) use ($permission) {
                    return $user->hasPermissionTo($permission);
                });
            });
        } catch (\Exception $e) {
            report($e);
        }

        Blade::directive('role', function ($role) {
            return "<?php if(auth()->check() && auth()->user()->hasRole({$role})) : ?>";
        });

        Blade::directive('endrole', function () {
            return "<?php endif; ?>";
        });
        
        Blade::directive('can', function ($permission) {
            return "<?php if(auth()->check() && auth()->user()->can({$permission})) : ?>";
        });

        Blade::directive('endcan', function () {
            return "<?php endif; ?>";
        });
    }
}
