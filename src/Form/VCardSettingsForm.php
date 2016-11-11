<?php

namespace Drupal\vcard_d8_port\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

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

      /*if (!_vcard_init()) {
        drupal_set_message(t('The PEAR package Contact_Vcard_Build (required by vcard.module) has not been installed properly, please read INSTALL.txt.'), 'warning');
      }*/
      $options = array('' => t('<Select a property>'));
      //$options = $options + _vcard_properties();
      //$profile_fields = _vcard_profile_fields();
      $form['field_mappings'] = array(
        '#type' => 'fieldset',
        '#title' => t('Field Mappings'),
        //'#description' => !count($profile_fields) ? t('You must first
        // define a few profile fields before you can map them to vCard properties. To do this, go to the !link administration section.', array('!link' => l(t('Profiles'), 'admin/config/people/profile'))) : '',
      );
      /*foreach ($profile_fields as $fid => $title) {
        $form['field_mappings']['vcard_profile_' . $fid] = array(
          '#type' => 'select',
          '#title' => t('Property for %title', array('%title' => $title)),
          '#default_value' => variable_get('vcard_profile_' . $fid, ''),
          '#options' => $options,
        );
      }*/
        return parent::buildForm($form, $form_state);
    }
}
