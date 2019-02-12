<?php
namespace Garderobe\Core;

use Cake\Core\BasePlugin;
use Cake\Core\PluginApplicationInterface;
use Cake\Event\EventManager;

class Plugin extends BasePlugin
{

    public function middleware($middleware)
    {
        $asset = new \Garderobe\Core\Routing\Middleware\AssetMiddleware;
        $middleware->insertBefore(
            'Cake\Routing\Middleware\AssetMiddleware',
            $asset
        );
        return $middleware;
    }

    public function bootstrap(PluginApplicationInterface $app)
    {
        parent::bootstrap($app);

        //App core event with widgets bulk load
        EventManager::instance()->on(
            new \Garderobe\Core\Event\CoreEvent,
            ['priority' => 10]
        );
    }

}
