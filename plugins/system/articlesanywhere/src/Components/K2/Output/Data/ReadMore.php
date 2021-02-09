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

namespace RegularLabs\Plugin\System\ArticlesAnywhere\Components\K2\Output\Data;

defined('_JEXEC') or die;

class ReadMore extends \RegularLabs\Plugin\System\ArticlesAnywhere\Output\Data\ReadMore
{
	protected function getUrl()
	{
		return (new Url($this->config, $this->item, $this->values))->getArticleUrl();
	}
}
