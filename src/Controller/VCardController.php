<?php

namespace Drupal\vcard\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Session\AccountInterface;

class VCardController extends ControllerBase {
  
  /**
   * VCard for direct download.
   *
   * Prints to the browser for direct download, then exits.
   */
  public function vcardFetch(AccountInterface $user) {
    $vcard = vcard_get($user);
    $vcard_text = $vcard->fetch();

    if (!empty($vcard_text)) {
      header('Content-type: text/x-vcard; charset=UTF-8');
      header('Content-Disposition: attachment; filename="' . uniqid() . '.vcf"');
      print $vcard_te	xt;
      exit;
    }
    else {
      return t("Error building vcard");
    }
  }
  
}