<?php
/**
 * @package     Joomla.Site
 * @subpackage  Layout
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('JPATH_BASE') or die;

use Joomla\CMS\Language\Text;
use Joomla\CMS\HTML\HTMLHelper;

$displayData = (!isset($displayData)) ? $displayData = array() : $displayData;

$item = $displayData['data'];

$display = $item->text;

switch ((string) $item->text)
{
	// Check for "Start" item
	case Text::_('JLIB_HTML_START') :
		$icon = "icon-backward";
		break;

	// Check for "Prev" item
	case $item->text == Text::_('JPREV') :
		$item->text = Text::_('JPREVIOUS');
		$icon       = "icon-step-backward";
		break;

	// Check for "Next" item
	case Text::_('JNEXT') :
		$icon = "icon-step-forward";
		break;

	// Check for "End" item
	case Text::_('JLIB_HTML_END') :
		$icon = "icon-forward";
		break;

	default:
		$icon = null;
		break;
}

if ($icon !== null)
{
	$display = '<i class="' . $icon . '"></i>';
}

if ($displayData['active'])
{
	if ($item->base > 0)
	{
		$limit = 'limitstart.value=' . $item->base;
	}
	else
	{
		$limit = 'limitstart.value=0';
	}

	$cssClasses = array();

	$title = '';

	if (!is_numeric($item->text))
	{
		// Always Joomla 3+
		HTMLHelper::_('bootstrap.tooltip');
		$cssClasses[] = 'hasTooltip';
		$title        = ' title="' . $item->text . '" ';
	}

	$onClick = 'document.adminForm.' . $item->prefix . 'limitstart.value=' . ($item->base > 0 ? $item->base : '0') . '; Joomla.submitform();return false;';
}
else
{
	$class = (property_exists($item, 'active') && $item->active) ? 'active' : 'disabled';
}
?>
<?php if ($displayData['active']) : ?>
	<li>
		<a class="<?php echo implode(' ', $cssClasses); ?>" <?php echo $title; ?> href="<?php echo $item->link; ?>">
			<?php echo $display; ?>
		</a>
	</li>
<?php else : ?>
	<li class="<?php echo $class; ?>">
		<span><?php echo $display; ?></span>
	</li>
<?php endif;
