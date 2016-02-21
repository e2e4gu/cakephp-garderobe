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

use Cake\Composer\Installer\ComponentInstallerConfigureTrait;
use Cake\Core\Configure;
use Cake\Core\Plugin;
use Cake\Network\Request;
use Cake\Network\Response;
use Cake\Routing\Filter\AssetFilter as BaseAssetFilter;

/**
 * Filters a request and tests whether it is a file in the webroot folder or not and
 * serves the file to the client if appropriate.
 *
 */
class AssetFilter extends BaseAssetFilter {

	use ComponentInstallerConfigureTrait;


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
		//Brood unload hack cause vendor plugin loaded for some reason
		Plugin::unload('Garderobe');

        $parts = explode('/', $url);
		$fileType = array_shift($parts);
		$fileFragment = implode(DS, $parts);
		$allowedExtensions = ComponentInstallerConfigureTrait::getSupportedExtensions();
		$registeredComponents = require ROOT . DS . 'vendor' . DS . 'cakephp-components.php';
        foreach($registeredComponents as $component){
			$extensions = implode('|', $allowedExtensions);
			if (preg_match("/($extensions)$/i", $fileFragment)) {
				foreach($component as $type=>$chunk){
					if($fileType != $type){
						continue;
					}
					$path = ROOT . DS . Configure::read('App.webroot') . DS . $chunk. DS;
					if((Configure::read('debug') == false)&&!strpos($fileFragment, 'min')){
	                    $fileFragment =  preg_replace("/(css|js)$/i", "min.$1", $fileFragment);
	                }
	                if (file_exists($path. $fileFragment)) {
						return $path.$fileFragment;
	                }
				}
			}
        }
	}

}
