<?php
/**
 * ClearLog
 *
 * @category Model
 * @package  ClearLog
 * @version  2.x
 * @author   Lukas Marks <info@lumax-web.de>
 * @link     http://www.lumax-web.de/
 */
App::uses('ClearLogAppModel', 'ClearLog.Model');

class ClearLog extends ClearLogAppModel {

	public $name = 'ClearLog';
	public $useTable = false;

	public function delete($path = null, $recursive = true) {
		if (!$path) $path = TMP . 'logs' . DS;

		$dirItems = scandir($path);
		$ignore = array('.', '..');

		foreach ($dirItems AS $dirItem) {
			if (in_array($dirItem, $ignore)) continue;
			if (is_dir($path . $dirItem) && $recursive) {
				$this->delete($path . $dirItem . DS);
			} elseif (substr($dirItem, 0, 5) == 'debug') {
				unlink($path . $dirItem);
			} elseif (substr($dirItem, 0, 5) == 'error') {
				unlink($path . $dirItem);
			}
		}
	}
}