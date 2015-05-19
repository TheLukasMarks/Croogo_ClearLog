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

	/**
	 * Model name
	 *
	 * @var string
	 * @access public
	 */
	public $name = 'ClearLog';
	
	/**
	 * Model table
	 *
	 * @var string
	 * @access public
	 */
	public $useTable = false;

	/**
	 * Removes record for given ID. If no ID is given, the current ID is used. Returns true on success.
	 *
	 * @param int|string $id ID of record to delete
	 * @param bool $cascade Set to true to delete records that depend on this record
	 * @return bool True on success
	 * @triggers Model.beforeDelete $this, array($cascade)
	 * @triggers Model.afterDelete $this
	 * @link http://book.cakephp.org/2.0/en/models/deleting-data.html
	 */
	public function delete($id = null, $cascade = true) {
		
		/**
		 * Constructor.
		 *
		 * @param string $path Path to folder
		 * @param bool $create Create folder if not found
		 * @param string|bool $mode Mode (CHMOD) to apply to created folder, false to ignore
		 * @link http://book.cakephp.org/2.0/en/core-utility-libraries/file-folder.html#Folder
		 */
		$dir = new Folder(TMP . 'logs');
		
		/**
		 * Returns an array of all matching files in current directory.
		 *
		 * @param string $regexpPattern Preg_match pattern (Defaults to: .*)
		 * @param bool $sort Whether results should be sorted.
		 * @return array Files that match given pattern
		 * @link http://book.cakephp.org/2.0/en/core-utility-libraries/file-folder.html#Folder::find
		 */
		$files = $dir->find('.*', true);

		foreach ($files as $file) {
			
			/**
			 * Constructor
			 *
			 * @param string $path Path to file
			 * @param boolean $create Create file if it does not exist (if true)
			 * @param integer $mode Mode to apply to the folder holding the file
			 * @link http://book.cakephp.org/2.0/en/core-utility-libraries/file-folder.html#File
			 */
			$file = new File($dir->pwd() . DS . $file);
			
			/**
			 * Deletes the File.
			 *
			 * @return boolean Success
			 * @link http://book.cakephp.org/2.0/en/core-utility-libraries/file-folder.html#File::delete
			 */
			if ($file->delete()) {
				continue;
			} else {
				return false;
			}
		}
		
		return true;
	}
}