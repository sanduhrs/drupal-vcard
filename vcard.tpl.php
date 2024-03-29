<?php
 
/**
 * @file
 * Render a profile account with hCard microformat markup.
 *
 * Available variables:
 * - $account: The user object belonging to the vCard
 *     Not sanitized, use check_plain() or similar
 * - $show_title: A boolean to trigger the title
 * - $vcard: The raw vCard data
 *     Not sanitized, use check_plain() or similar
 * - $givenname
 * - $familyname
 * - $birthday
 * - $organization
 * - $telephone
 * - $url
 * - $street
 * - $city
 * - $postal
 * - $province
 * - $country
 * - $picture
 *
 * @see template_preprocess()
 * @see template_preprocess_vcard()
 */
?>

<?php if ($show_title) : ?>
  <h3><?php print t('About the author') ?></h3>
<?php endif; ?>

<div id="vcard-<?php print $account->uid ?>" class="vcard">

  <?php if ($user_picture) : ?>
    <?php print $user_picture ?>
  <?php endif; ?>

  <?php if (isset($givenname) && isset($familyname)) : ?>
    <div class="n fn">
      <span class="given-name"><?php print $givenname ?></span>
      <span class="family-name"><?php print $familyname ?></span>
     (<span class="nickname"><?php print check_plain($account->name) ?></span>)
    </div>
  <?php else : ?>
    <div class="fn"><?php print check_plain($account->name) ?></div>
  <?php endif; ?>

  <?php if (isset($mail)) :?>
    <a class="email" href="mailto:<?php print $mail ?>"><?php print $mail ?></a>
  <?php endif; ?>

  <?php if (isset($street) || isset($city) || isset($province) || isset($postal) || isset($country)) : ?>
    <div class="adr">

    <?php if (isset($street)) : ?>
      <div class="street-address"><?php print $street ?></div>
    <?php endif; ?>

    <?php if (isset($city)) : ?>
      <span class="locality"><?php print $city ?></span>
    <?php endif; ?>

    <?php if (isset($province)) : ?>
      <span class="region"><?php print $province ?></span>
    <?php endif; ?>

    <?php if (isset($postal)) : ?>
      <span class="postal-code"><?php print $postal ?></span>
    <?php endif; ?>

    <?php if (isset($country)) : ?>
      <span class="country-name"><?php  print $country  ?></span>
    <?php endif; ?>
    </div>
  <?php endif; ?>

  <?php if (isset($telephone)) : ?>
    <div class="tel"><?php print $telephone ?></div>
  <?php endif; ?>

  <?php if (isset($organization)) : ?>
    <div class="org"><?php print $organization ?></div>
  <?php endif; ?>

</div>