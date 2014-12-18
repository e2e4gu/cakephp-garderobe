<?php
/**
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) iTeam s.r.o. (http://iteam-pro.com)
 * @link          http://iteam-pro.com SbAdmin2 CakePHP 3 Theme
 * @since         0.0.1
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace Garderobe\View\Helper;

use Cake\View\Helper\FormHelper;
use Cake\Utility\Inflector;

/**
 * Bootstrap3FormHelper helper
 */
class Bootstrap3FormHelper extends FormHelper {

/**
 * Other helpers used by FormHelper
 *
 * @var array
 */
	public $helpers = [
		'Url',
		'Html' => [
			'className' => 'Garderobe.Bootstrap3Html',
			'templates' => 'Garderobe.Bootstrap3/html.php',
		]
	];

/**
 * Creates a `<button>` tag.
 *
 * The type attribute defaults to `type="submit"`
 * You can change it to a different value by using `$options['type']`.
 *
 * ### Options:
 *
 * - `escape` - HTML entity encode the $title of the button. Defaults to false.
 *
 * @param string $title The button's caption. Not automatically HTML encoded
 * @param array $options Array of options and HTML attributes.
 * @return string A HTML button tag.
 * @link http://book.cakephp.org/2.0/en/core-libraries/helpers/form.html#FormHelper::button
 */
	public function button($title, array $options = array()) {
		if(isset($options['icon'])){
			$title = $this->Html->icon('', ['class' => $options['icon']]).' '.$title;
			unset($options['icon']);
			$options['escape'] = false;
		}
		return parent::button($title, $options);
	}

}
