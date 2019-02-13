<?php
namespace Garderobe\Core\Routing\Middleware;

use Cake\Routing\Middleware\AssetMiddleware as OriginalAssetMiddleware;
use Cake\Core\Configure;
use Cake\Core\Plugin;
use Cake\Utility\Inflector;

class AssetMiddleware extends OriginalAssetMiddleware {

	protected function _getAssetFile($url) {
		$parts = explode('/', $url);
		$asset = array_shift($parts);
		$parts[0] = $asset;
        if(Configure::read('Editorial.shortenUrls')&&($plugin = Configure::read('Editorial.editor'))){
            $path = Plugin::path($plugin). Configure::read('App.webroot'). DS . implode(DS, $parts);
    		if (file_exists($path)) {
    			return $path;
    		}
        }
	}

}
