<?php

use Joomla\CMS\Form\FormHelper;
use Joomla\CMS\HTML\HTMLHelper;

/**
 * @package     Joomla.Site
 * @subpackage  Layout
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('JPATH_BASE') or die;

$data = $displayData;

// Load the form filters
$filters = $data['view']->filterForm->getGroup('filter');
$customfilters =  $data['view']->filters;
?>
<?php if ($filters) : ?>
	<?php foreach ($filters as $fieldName => $field) : ?>
		<?php if ($fieldName !== 'filter_search') : ?>
			<?php $dataShowOn = ''; ?>
			<?php if ($field->showon) : ?>
				<?php HTMLHelper::_('jquery.framework'); ?>
				<?php HTMLHelper::_('script', 'jui/cms.js', array('version' => 'auto', 'relative' => true)); ?>
				<?php $dataShowOn = " data-showon='" . json_encode(FormHelper::parseShowOnConditions($field->showon, $field->formControl, $field->group)) . "'"; ?>
			<?php endif; ?>
			<div class="js-stools-field-filter"<?php echo $dataShowOn; ?>>
				<?php
                $customFilterName = str_replace('filter_', '', $fieldName);
                if (isset($customfilters[$customFilterName]))
                {
	                echo $customfilters[$customFilterName];
                }
                else
                {
	                echo $field->input;
                }
                ?>
			</div>
		<?php endif; ?>
	<?php endforeach; ?>
<?php endif; ?>
