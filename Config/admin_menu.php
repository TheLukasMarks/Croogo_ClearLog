<?php
/**
 * Admin menu (navigation)
 */
CroogoNav::add('settings.children.clear_log', array(
	'icon' => 'trash',
	'title' => __d('clear_log', 'Clear Log'),
	'url' => array(
		'admin' => true,
		'plugin' => 'clear_log',
		'controller' => 'clear_logs',
		'action' => 'clear'
	),
	'weight' => 200,
	'children' => array(
	),
));