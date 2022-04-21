<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;

use App\Models\User;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
         Event::listen(BuildingMenu::class, function (BuildingMenu $event) {
            // Add some items to the menu...
            $roles=auth()->user()->roles()->get();

            
            
            $event->menu->addBefore('ideas1',strtoupper($roles->first()->name));
            $event->menu->remove('ideas1');

            $event -> menu -> add ([
                'text'    => 'menu',
                'icon'    => 'fas fa-fw fa-bars', 
                'submenu' => [
                    [
                        'text' => 'Mis ideas',
                        'route'  => 'admin.ideas.index',
                        'icon'    => 'far fa-fw fa-lightbulb',
                        'can'=>'admin.home.innovador'
                    ],
                    [
                        'text' => 'Ideas',
                        'icon'    => 'far fa-fw fa-lightbulb',
                        'route'  => 'admin.ideas.index',
                        'can'=>'admin.home.admin'
                    ],
                ],
           ]);
            
        }); 

    }
}
