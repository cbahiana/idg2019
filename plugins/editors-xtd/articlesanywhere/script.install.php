<?php
/**
 * @package         Articles Anywhere
 * @version         10.5.1
 * 
 * @author          Peter van Westen <info@regularlabs.com>
 * @link            http://www.regularlabs.com
 * @copyright       Copyright © 2020 Regular Labs All Rights Reserved
 * @license         http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 */

defined('_JEXEC') or die;

require_once __DIR__ . '/script.install.helper.php';

class PlgEditorsXtdArticlesAnywhereInstallerScript extends PlgEditorsXtdArticlesAnywhereInstallerScriptHelper
{
	public $name           = 'ARTICLESANYWHERE';
	public $alias          = 'articlesanywhere';
	public $extension_type = 'plugin';
	public $plugin_folder  = 'editors-xtd';

	public function uninstall($adapter)
	{
		$this->uninstallPlugin($this->extname, 'system');
	}
}
