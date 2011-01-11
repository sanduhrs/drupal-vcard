<?php
// $Id$ 

/**
 * @file
 * vCard - Administration UI
 */

/**
 * Callback for administration page.
 */
function vcard_admin_settings() {
  if (!_vcard_init()) {
    drupal_set_message(t('The PEAR package File_IMC or Contact_Vcard_Build (required by vcard.module) has not been installed properly, please read INSTALL.txt.'), 'error');
  }

  $form['display'] = array(
    '#type' => 'fieldset',
    '#title' => t('Display Settings'),
  );
  $form['display']['vcard_display_profile_link'] = array(
    '#type' => 'checkbox',
    '#title' => t("Show vCard download link on user's profile"),
    '#default_value' => variable_get('vcard_display_profile_link', 1),
  );
  $form['display']['vcard_display_profile_hcard'] = array(
    '#type' => 'checkbox',
    '#title' => t("Show hCard on user's profile"),
    '#default_value' => variable_get('vcard_display_profile_hcard', 1),
  );

  $options = array('' => t('<Select a property>'));
  $options = $options + _vcard_properties();
  $profile_fields = _vcard_profile_fields();
  $form['field_mappings'] = array(
    '#type' => 'fieldset',
    '#title' => t('Field Mappings'),
    '#description' => !count($profile_fields) ? t('You must first define a few profile fields before you can map them to vCard properties. To do this, go to the !link administration section.', array('!link' => l(t('Profiles'), 'admin/config/people/profile'))) : '',
  );
  foreach ($profile_fields as $fid => $title) {
    $form['field_mappings']['vcard_profile_' . $fid] = array(
      '#type' => 'select',
      '#title' => t('Property for %title', array('%title' => $title)),
      '#default_value' => variable_get('vcard_profile_' . $fid, ''),
      '#options' => $options,
    );
  }

  return system_settings_form($form);
}
