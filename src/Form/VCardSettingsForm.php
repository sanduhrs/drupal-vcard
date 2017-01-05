<?php

namespace Drupal\vcard_d8_port\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\user\Entity\User;

/**
 * Configure download count settings.
 */
class VCardSettingsForm extends ConfigFormBase {
  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'vcard_admin_settings_form';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['vcard_d8_port.settings'];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('vcard_d8_port.settings');
    if (!_vcard_init()) {
      drupal_set_message(t('The PEAR package Contact_Vcard_Build (required by vcard.module) has not been installed properly, please read INSTALL.txt.'), 'warning');
    }

    $form['display'] = array(
      '#type' => 'fieldset',
      '#title' => t('Display Settings'),
    );
    $form['display']['vcard_display_profile_link'] = array(
      '#type' => 'checkbox',
      '#title' => t("Show vCard download link on user's profile"),
      '#default_value' => $config->get('vcard_display_profile_link', 1),
    );
    $form['display']['vcard_display_profile_hcard'] = array(
      '#type' => 'checkbox',
      '#title' => t("Show hCard on user's profile"),
      '#default_value' => $config->get('vcard_display_profile_hcard', 1),
    );

    $user = User::load(\Drupal::currentUser()->id());
    $user_fields = $user->getFieldDefinitions('user', 'user');
    $options = array('' => 'Select a property');
    $options = $options + _vcard_properties();

    $form['field_mappings'] = array(
      '#type' => 'fieldset',
      '#title' => t('Field Mappings'),
      '#description' => t('You must first define a few profile fields before you can map them to vCard properties.'),
    );

    foreach ($user_fields as $field_name => $field_definition) {
      if ($field_definition->getFieldStorageDefinition()->isBaseField() == FALSE) {
        $form['field_mappings']['vcard_user_fields_'. $field_name] =
          array(
            '#type' => 'select',
            '#title' => $field_definition->getLabel(),
            '#default_value' => $config->get('vcard_user_fields_'. $field_name, ''),
            '#options' => $options,
          );
      }
    }

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   * Implments submit callback for vCard
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $config = \Drupal::service('config.factory')->getEditable('vcard_d8_port.settings');
    //Savng User Mapping Field
    $user_fields = vcard_d8_port_get_user_fields();
    foreach ($user_fields as $key => $value) {
      $user_field_mapping = $form_state->getValue('vcard_user_fields_'.$key);
      $config->set('vcard_user_fields_'.$key, $user_field_mapping)->save();
    }
    //Savng Display settings for vCard
    $display_settings_vcard = $form_state->getValue('vcard_display_profile_link');
    $config->set('vcard_display_profile_link', $display_settings_vcard)->save();

    //Savng Display settings for hCard
    $display_settings_hcard = $form_state->getValue('vcard_display_profile_hcard');
    $config->set('vcard_display_profile_hcard', $display_settings_hcard)->save();

    drupal_set_message(t('Configurations have been saved.'));
  }
}
