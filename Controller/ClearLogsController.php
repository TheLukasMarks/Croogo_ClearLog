<?php
/**
 * ClearLog
 *
 * @category Controller
 * @package  ClearLog
 * @version  2.x
 * @author   Lukas Marks <info@lumax-web.de>
 * @link     http://www.lumax-web.de/
 */
App::uses('ClearLogsAppController', 'ClearLog.Controller');

class ClearLogsController extends ClearLogsAppController {
	public $uses = array('ClearLog.ClearLog');
	public function admin_clear() {
		$this->ClearLog->delete();
		$this->Session->setFlash(__d('clear_log', 'Log files has been deleted successfully.'), 'flash', array('class' => 'success'));
		$this->redirect(array('plugin' => 'settings', 'controller' => 'settings', 'action' => 'dashboard'));
	}
}