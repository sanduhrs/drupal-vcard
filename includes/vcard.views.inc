<?php

/**
 * @file
 * Provides support for the Views module.
 *
 * @author
 * Stefan Auditor <stefan.auditor@erdfisch.de>
 */

/**
 * Implementation of hook_views_data().
 */
function vcard_views_data() {
  $data['users']['download_vcard'] = array(
    'field' => array(
      'group' => t('vCard'),
      'title' => t('Download vCard'),
      'help' => t("Provide a simple link to download the user's vCard."),
      'handler' => 'views_handler_field_vcard_link',
    ),
  );
  $data['users']['display_hcard'] = array(
    'field' => array(
      'group' => t('vCard'),
      'title' => t('Display hCard'),
      'help' => t("Provide hCard markup of a user's vCard."),
      'handler' => 'views_handler_field_vcard_hcard',
    ),
  );
  return $data;
}

/**
 * Implements hook_views_handlers().
 */
function vcard_views_handlers() {
  return array(
    'info' => array(
      'path' => drupal_get_path('module', 'vcard') . '/includes',
    ),
    'handlers' => array(
      'views_handler_field_vcard_link' => array(
        'parent' => 'views_handler_field',
        'file' => 'views_handler_field_vcard_link.inc',
      ),
      'views_handler_field_vcard_hcard' => array(
        'parent' => 'views_handler_field',
        'file' => 'views_handler_field_vcard_hcard.inc',
      ),
    ),
  );
}
