<?php

namespace Drupal\vcard_d8_port\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Session\AccountInterface;

class VCardD8PortController extends ControllerBase {
  /**
   * VCard for direct download
   *
   * Prints to the browser for direct download, then exits
   */
  public function vcardFetch(AccountInterface $user) {
    $vcard = vcard_get($user);
    $vcard_text = $vcard->fetch();
    if (!empty($vcard_text)) {
      header('Content-type: text/x-vcard');
      header('Content-Disposition: attachment; filename="' . uniqid() . '.vcf"');
      print $vcard_text;
      exit;
    }
    else {
      return t("Error building vcard");
    }
  }
}