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
namespace Garderobe\Core\Event;

use Cake\Event\EventListenerInterface;
use Cake\Utility\Inflector;
use Cake\Core\Configure;
use Cake\Log\Log;

class CoreEvent implements EventListenerInterface {

    public function implementedEvents() {
        return array(
	        'Controller.initialize' => array(
                'callable' => 'onControllerInit',
            ),
        );
    }

    public function onControllerInit($event) {
        $controller = $event->subject();

	    $plugins = Configure::read('Garderobe.Plugin');
        foreach ($plugins as $plugin){
            if (isset($plugin['helpers'])&&!empty($plugin['helpers'])){
                foreach ($plugin['helpers'] as $helper=>$options){
                    $controller->helpers[$helper] = $options;
                }
            }
        }
    }
}
