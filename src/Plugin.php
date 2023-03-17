<?php
namespace Garderobe\Core;

use Cake\Core\BasePlugin;
use Cake\Core\PluginApplicationInterface;
use Cake\Event\EventManager;
use Cake\Http\MiddlewareQueue;

class Plugin extends BasePlugin
{

    public function middleware($middleware): MiddlewareQueue
    {
    /*
        $namespaces=array();
foreach(get_declared_classes() as $name) {
    if(preg_match_all("@[^\\\]+(?=\\\)@iU", $name, $matches)) {
        $matches = $matches[0];
        $parent =&$namespaces;
        while(count($matches)) {
            $match = array_shift($matches);
            if(!isset($parent[$match]) && count($matches))
                $parent[$match] = array();
            $parent =&$parent[$match];

        }
    }
}

debug($namespaces);
exit();
*/
        $asset = new \Garderobe\Core\Routing\Middleware\AssetMiddleware;
        //$middleware->insertBefore(
        //    'Cake\Routing\Middleware\AssetMiddleware',
        //    $asset
        //);
        return $middleware;
    }

    public function bootstrap(PluginApplicationInterface $app): void
    {
        parent::bootstrap($app);

        //App core event with widgets bulk load
        EventManager::instance()->on(
            new \Garderobe\Core\Event\CoreEvent,
            ['priority' => 10]
        );
    }

}
