<?php
/**
 * ClearLog
 * Copyright (c) Lukas Marks (http://lumax-web.de/)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Lukas Marks (http://lumax-web.de/)
 * @since         0.1
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('ClearLogsAppController', 'ClearLog.Controller');

class ClearLogsController extends ClearLogsAppController {
	public $uses = array('ClearLog.ClearLog');
	public function admin_clear() {
		$this->ClearLog->delete();
		$this->Session->setFlash(__d('clear_log', 'Log files has been deleted successfully.'), 'flash', array('class' => 'success'));
		$this->redirect(array(
			'plugin' => 'settings',
			'controller' => 'settings',
			'action' => 'dashboard',
		));
	}
}