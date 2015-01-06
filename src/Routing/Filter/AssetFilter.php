<?php
/**
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) MindForce Team (http://mindforce.me)
 * @link          http://mindforce.me Garderobe CakePHP 3 UI Plugin
 * @since         0.0.1
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace Garderobe\Core\Routing\Filter;

use Cake\Routing\Filter\AssetFilter as BaseAssetFilter;
use Cake\Core\Configure;
use Cake\Core\Plugin;
use Cake\Utility\Inflector;

/**
 * Filters a request and tests whether it is a file in the webroot folder or not and
 * serves the file to the client if appropriate.
 *
 */
class AssetFilter extends BaseAssetFilter {

/**
 * Default priority for all methods in this filter
 * This filter should run before the request gets parsed by router
 *
 * @var int
 */
	protected $_priority = 8;

/**
 * Builds asset file path based off url
 *
 * @param string $url Asset URL
 * @return string Absolute path for asset file
 */
	protected function _getAssetFile($url) {
        $parts = explode('/', $url);
		$fileFragment = implode(DS, $parts);
		$plugins = Configure::read('Garderobe.Plugin');
        foreach($plugins as $plugin){
            $pluginWebroot = Plugin::path($plugin['name']) . Configure::read('App.webroot') . DS;
            if (preg_match("/(css|js|woff|ttf)$/i", $fileFragment)) {
                if(Configure::read('debug') == 0){
                    $path = $pluginWebroot . preg_replace("/(css|js)$/i", "min.$1", $fileFragment);
                    if (file_exists($path)) {
                        return $path;
                    }
                }
                $path = $pluginWebroot . $fileFragment;
                if (file_exists($path)) {
                    return $path;
                }
            }
        }
	}

}
