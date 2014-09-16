<?php

namespace Garderobe\Routing\Filter;

use Cake\Routing\Filter\AssetFilter;
use Cake\Core\Configure;
use Cake\Core\Plugin;
use Cake\Utility\Inflector;

/**
 * Filters a request and tests whether it is a file in the webroot folder or not and
 * serves the file to the client if appropriate.
 *
 */
class GarderobeAssetFilter extends AssetFilter {

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
		$style = Inflector::underscore(Configure::read('Garderobe.style'));
		$pluginWebroot = Plugin::path('Garderobe') . 'webroot' . DS . $style . DS;

		if ((Configure::read('debug') == 0)&&preg_match("/(css|js)$/i", $fileFragment)) {
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
