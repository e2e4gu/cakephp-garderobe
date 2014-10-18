<?php
/**
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) iTeam s.r.o. (http://iteam-pro.com)
 * @link          http://iteam-pro.com Garderobe CakePHP 3 UI Plugin
 * @since         0.0.1
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace Garderobe\Event;

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

	    $style = Configure::read('Garderobe.style');
	    $controller->helpers['Form'] = [
			'className' => 'Garderobe.'.$style.'Form',
			'errorClass' => 'has-error',
		    'widgets' => 'Garderobe.'.$style.DS.'widgets.php',
			'templateClass' => 'Garderobe\View\ExtendedStringTemplate',
			'templates' => 'Garderobe.'.$style.DS.'form.php',
	    ];
	    $controller->helpers['Html'] = [
		    'className' => 'Garderobe.'.$style.'Html',
		    'templates' => 'Garderobe.'.$style.DS.'html.php',
	    ];
	    $controller->helpers['Paginator'] = [
		    'templates' => 'Garderobe.'.$style.DS.'paginator.php',
	    ];
    }
}