<?php
// $Id$

/**
 * @file render a profile account with hCard microformat markup.
 * 
 * @param $account
 */

  // Configure some values first.
  if (variable_get('user_pictures', 0)) {
    if ($account->picture && file_exists($account->picture)) {
      $picture = file_create_url($account->picture);
    }
    elseif (variable_get('user_picture_default', '')) {
      $picture = variable_get('user_picture_default', '');
    }
  }

  // name
  $firstname = vcard_get_field('givenname', $account);
  $lastname = vcard_get_field('familyname', $account);

  $street   = vcard_get_field('street', $account);
  $city     = vcard_get_field('city', $account);
  $province = vcard_get_field('province', $account);
  $postal   = vcard_get_field('postal', $account);
  $country  = vcard_get_field('country', $account);
?>

<div class="vcard">

  <?php if ($picture) { ?>
    <img class="photo" src="<?php echo $picture; ?>" alt="photo" />
  <?php } ?>


  <?php if ($firstname && $lastname) { ?>
    <div class="n fn">
    <span class="given-name"><?php echo $firstname; ?></span>
    <span class="family-name"><?php echo $lastname; ?></span>
    (<span class="nickname"><?php echo $account->name; ?></span>)
    </div>
  <?php } else { ?>
    <div class="fn"><?php echo $account->name; ?></div>
  <?php } ?>

  <?php if ($street || $city || $province || $postal || $country ) {  ?>  
    <div class="adr">
      <?php if ($street) {   ?> <div class="street-address"><?php echo $street;   ?></div><?php  } ?>
      <?php if ($city) {     ?> <span class="locality"><?php      echo $city;     ?></span><?php } ?>
      <?php if ($province) { ?> <span class="region"><?php        echo $province; ?></span><?php } ?>
      <?php if ($postal) {   ?> <span class="postal-code"><?php   echo $postal;   ?></span><?php } ?>
      <?php if ($country) {  ?> <span class="country-name"><?php  echo $country;  ?></span><?php } ?>
    </div>
  <? } ?>
  
  <?php if ($telephone = vcard_get_field('telephone', $account)) { ?>
    <div class="tel"><?php echo $telephone; ?></div>
  <?php } ?>

  <?php if ($org = vcard_get_field('organization', $account)) { ?>
    <div class="org"><?php echo $org; ?></div>
  <?php } ?>

  <br class="clear" />
</div>