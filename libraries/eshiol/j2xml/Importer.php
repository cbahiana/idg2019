<?php
/**
 * @package		J2XML
 * @subpackage	lib_j2xml
 *
 * @author		Helios Ciancio <info (at) eshiol (dot) it>
 * @link		http://www.eshiol.it
 * @copyright	Copyright (C) 2010 - 2020 Helios Ciancio. All Rights Reserved
 * @license		http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL v3
 * J2XML is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */
namespace eshiol\J2xml;

// no direct access
defined('_JEXEC') or die('Restricted access.');

use eshiol\J2xml\Table\Category;
use eshiol\J2xml\Table\Contact;
use eshiol\J2xml\Table\Content;
use eshiol\J2xml\Table\Field;
use eshiol\J2xml\Table\Fieldgroup;
use eshiol\J2xml\Table\Image;
use eshiol\J2xml\Table\Tag;
use eshiol\J2xml\Table\User;
use eshiol\J2xml\Table\Usernote;
use eshiol\J2xml\Table\Viewlevel;
use eshiol\J2xml\Table\Weblink;
use eshiol\J2xml\Version;
\JLoader::import('eshiol.J2xml.Table.Category');
\JLoader::import('eshiol.J2xml.Table.Contact');
\JLoader::import('eshiol.J2xml.Table.Content');
\JLoader::import('eshiol.J2xml.Table.Field');
\JLoader::import('eshiol.J2xml.Table.Fieldgroup');
\JLoader::import('eshiol.J2xml.Table.Image');
\JLoader::import('eshiol.J2xml.Table.Tag');
\JLoader::import('eshiol.J2xml.Table.User');
\JLoader::import('eshiol.J2xml.Table.Usernote');
\JLoader::import('eshiol.J2xml.Table.Viewlevel');
\JLoader::import('eshiol.J2xml.Table.Weblink');
\JLoader::import('eshiol.J2xml.Version');

\JTable::addIncludePath(JPATH_ADMINISTRATOR . '/components/com_weblinks/tables');
\JTable::addIncludePath(JPATH_ADMINISTRATOR . '/components/com_contact/tables');

// jimport('joomla.filesystem.folder');
jimport('joomla.filesystem.file');
jimport('joomla.user.helper');

/**
 * Importer
 *
 * @version 20.5.348
 * @since 1.6.0
 */
class Importer
{

	protected $_nullDate;

	protected $_user_id;

	protected $_now;

	protected $_option;

	protected $_usergroups;

	function __construct ()
	{
		// Merge the default translation with the current translation
		$jlang = \JFactory::getLanguage();
		$jlang->load('lib_j2xml', JPATH_SITE, 'en-GB', true);
		$jlang->load('lib_j2xml', JPATH_SITE, $jlang->getDefault(), true);
		$jlang->load('lib_j2xml', JPATH_SITE, null, true);

		$this->_db = \JFactory::getDBO();
		$this->_user = \JFactory::getUser();

		$this->_nullDate = $this->_db->getNullDate();
		$this->_user_id = $this->_user->get('id');
		$this->_now = \JFactory::getDate()->format("%Y-%m-%d-%H-%M-%S");
		$this->_option = (PHP_SAPI != 'cli') ? \JFactory::getApplication()->input->getCmd('option') : 'cli_' .
				 strtolower(get_class(\JApplicationCli::getInstance()));
	}

	/**
	 * Import data
	 *
	 * @param \SimpleXMLElement $xml
	 *        	xml
	 * @param \JRegistry $options
	 *        	An optional associative array of settings.
	 *        	@option boolean 'import_content' import articles
	 *        	@option int 'default_category'
	 *        	@option int 'content_category'
	 *        
	 * @throws
	 * @return boolean
	 * @access public
	 *        
	 * @since 1.6.0
	 */
	function import ($xml, $params)
	{
		\JFactory::getLanguage()->load('lib_j2xml', JPATH_SITE, null, false, true);

		$import_viewlevels = $params->get('viewlevels');
		if ($import_viewlevels)
		{
			Viewlevel::import($xml, $params);
		}

		$version = new \JVersion();
		if ($version->isCompatible('3.7'))
		{
			$import_fields = $params->get('fields');
			if ($import_fields)
			{
				Fieldgroup::import($xml, $params);
				Field::import($xml, $params);
			}
		}

		$import_users = $params->get('users');
		if ($import_users)
		{
			User::import($xml, $params);
		}

		if ($version->isCompatible('3.1'))
		{
			$import_tags = $params->get('tags');
			if ($import_tags)
			{
				Tag::import($xml, $params);
			}
		}

		$import_content = $params->get('content');
		if ($import_content)
		{
			Content::import($xml, $params);
		}

		$import_images = $params->get('images');
		if ($import_images)
		{
			Image::import($xml, $params);
		}

		$import_usernotes = $params->get('usernotes');
		if ($import_usernotes)
		{
			Usernote::import($xml, $params);
		}

		$import_contacts = $params->get('contacts');
		if ($import_contacts)
		{
			Contact::import($xml, $params);
		}

		$import_weblinks = $params->get('weblinks');
		if ($import_weblinks)
		{
			Weblink::import($xml, $params);
		}

		if ($params->get('fire', 1))
		{
			\JPluginHelper::importPlugin('j2xml');
			$dispatcher = \JEventDispatcher::getInstance();
			// Trigger the onAfterImport event.
			$dispatcher->trigger('onAfterImport', array(
					'com_j2xml.import',
					&$xml,
					$params
			));
		}

		return true;
	}
}
