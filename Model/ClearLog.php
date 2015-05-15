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