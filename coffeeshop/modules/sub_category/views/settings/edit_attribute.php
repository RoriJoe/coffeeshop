<?php if (validation_errors()) : ?>
    <div class="alert alert-block alert-error fade in ">
        <a class="close" data-dismiss="alert">&times;</a>
        <h4 class="alert-heading">Please fix the following errors :</h4>
        <?php echo validation_errors(); ?>
    </div>
<?php endif; ?>
<?php

// Change the css classes to suit your needs
if (isset($sub_category))
{
    $sub_category = (array) $sub_category;
}
$id = isset($sub_category['id']) ? $sub_category['id'] : '';
?>
<div class="admin-box">
    <h3>Sub Category Attribute</h3>
    <?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
    <fieldset>
        <div class="control-group <?php echo form_error('attribute_name') ? 'error' : ''; ?>">
        <?php echo form_label('Attribute Name' . lang('bf_form_label_required'), 'attribute_name', array('class' => "control-label")); ?>
            <div class='controls'>
                <input id="sub_category_name" type="text" name="attribute_name" maxlength="255" value="<?php echo set_value('attribute_name', isset($sub_category['attribute_name']) ? $sub_category['attribute_name'] : ''); ?>"  />
                <span class="help-inline"><?php echo form_error('attribute_name'); ?></span>
            </div>
        </div>
        
        <div class="form-actions">
            <br/>
            <input type="hidden" name="sub_cat_id" id="sub_cat_id" value="<?php echo $this->uri->segment(5); ?>" />
            <input type="hidden" name="id" id="id" value="<?php echo $this->uri->segment(6); ?>" />
            <input type="submit" name="save" class="btn btn-primary" value="Edit Attribute" />
            or <?php echo anchor(SITE_AREA . '/settings/sub_category/attribute_listing/'.$this->uri->segment(5), lang('sub_category_cancel'), 'class="btn btn-warning"'); ?>

        </div>
    </fieldset>
    <?php echo form_close(); ?>
</div>