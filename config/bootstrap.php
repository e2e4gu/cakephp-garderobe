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
use Cake\Event\EventManager;
use Cake\Core\Configure;
use Cake\Routing\DispatcherFactory;

EventManager::instance()->attach(
	new Garderobe\Core\Event\CoreEvent,
    null
);

DispatcherFactory::add('Garderobe/Core.Asset');
