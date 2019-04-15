<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_users
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::_('behavior.keepalive');
JHtml::_('behavior.formvalidator');


// Load user_profile plugin language
$lang = JFactory::getLanguage();
$lang->load('plg_user_profile', JPATH_ADMINISTRATOR);

?>
<div class="profile-edit<?php echo $this->pageclass_sfx; ?>">
	<?php if ($this->params->get('show_page_heading')) : ?>
		<div class="page-header">
			<h1>
				<?php echo $this->escape($this->params->get('page_heading')); ?>
			</h1>
		</div>
	<?php endif; ?>
	
	<form id="member-profile" action="<?php echo JRoute::_('index.php?option=com_users&task=profile.save'); ?>" method="post" class="form-validate form-horizontal well" enctype="multipart/form-data">
		<?php foreach ($this->form->getFieldsets() as $group => $fieldset) : ?>
			<?php $fields = $this->form->getFieldset($group); ?>
			<?php if (count($fields) && $fieldset->label == "COM_USERS_PROFILE_DEFAULT_LABEL") : ?>
				<fieldset>
					<?php if (isset($fieldset->label)) : ?>
						<legend><?php echo JText::_($fieldset->label); ?></legend>
					<?php endif; ?>
					<?php echo $this->form->renderFieldset($fieldset->name); ?>
				</fieldset>
			<?php endif; ?>
		<?php endforeach; ?>
		
		<div class="control-group">
			<div class="controls">
				<button type="submit" class="btn btn-primary validate">
					<?php echo JText::_('JSUBMIT'); ?>
				</button>
				<a class="btn" href="<?php echo JRoute::_('index.php?option=com_users&view=profile'); ?>" title="<?php echo JText::_('JCANCEL'); ?>">
					<?php echo JText::_('JCANCEL'); ?>
				</a>
				<input type="hidden" name="option" value="com_users" />
				<input type="hidden" name="task" value="profile.save" />
			</div>
		</div>
		<?php echo JHtml::_('form.token'); ?>
	</form>
</div>

<script type="text/javascript">

	jQuery(document).ready(function (){		
		jQuery('#jform_state').change(function(){  
			Estado(false, false);
		});
		
		jQuery('#jform_club_office').change(function(){  
			MostrarOutro(this, jQuery('#jform_club_other'));
		});
		
		jQuery('#jform_district_office').change(function(){  
			MostrarOutro(this, jQuery('#jform_district_other'));
		});
		
	});

	function Submeter(){
		jQuery("#btn_submit").attr("disabled", "disabled");
		jQuery("#btn_submit").find("i").show();
		jQuery("#btn_cancel").hide();
	}

	function Estado(cidade, clube) {

        jQuery.post('../../components/com_users/formulario/auxi/cidades.php', {estado: jQuery('#jform_state').val()},
        function(resposta) {
            jQuery('#jform_city').html(resposta);
            if (cidade) {
                Selecionar('jform_city', cidade);
            }
        });
        
        jQuery.post('../../components/com_users/formulario/auxi/clubes.php', {estado: jQuery('#jform_state').val()},
        function(resposta) {
            jQuery('#jform_club').html(resposta);
            if (clube) {
                Selecionar('jform_club', clube);
            }
        });
    }

    function Selecionar(selecionar , Option){

		var Select = document.getElementById(selecionar); 
		for ( i =0; i < Select.length; i++){
			if (Select[i].value == Option){
				Select[i].selected = true;
			} 
		} 
	}

	function MostrarOutro(select, other){

		if (jQuery(select).val() == "OUTRO")
			jQuery(other).parent().parent().show();		
		else
			jQuery(other).parent().parent().hide();		
	 }

	 Estado(<?php echo "'" . $this->form->getData()->get("city") . "','" . $this->form->getData()->get("club") . "'" ?>);
	 MostrarOutro(jQuery('#jform_district_office'), jQuery('#jform_district_other'));
	 MostrarOutro(jQuery('#jform_club_office'), jQuery('#jform_club_other'));
</script>
<style type="text/css">
	.optional{
		display: none;
	}	
</style>
