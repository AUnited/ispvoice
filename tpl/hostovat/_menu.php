<div class="menu-navigation">
<ul>
  <li><a href="index.php?m=domain" class="toplink"><?php echo $lang->tr("Choose domain"); ?></a></li>
  <li><a href="index.php?m=domain_list" class="toplink"><?php echo $lang->tr("Domain prices"); ?></a></li>
  <li><a href="index.php?m=plans" class="toplink"><?php echo $lang->tr("Hostings"); ?></a></li>
  <li><a href="<?php echo sett::webadmin_path; ?>" class="toplink_admin"><strong><?php echo $lang->tr("Webadmin"); ?></strong><img src="<?php echo sett::templates.sett::template; ?>/images/webadmin.png" alt="WA" /></a></li>
  <li>
    <a href="#"><img src="<?php echo sett::templates.sett::template; ?>/images/language.png" alt="" /></a>
    <ul>
      <li><a href="<?php echo $_SERVER["PHP_SELF"]; ?>?m=<?php echo $GLOBALS["m"]; ?>&l=en_US&curr=en-us&id=<?php echo htmlspecialchars($_GET["id"]); ?>" class="toplink" title="<?php echo $lang->tr("English"); ?>"><img src="<?php echo sett::templates.sett::template; ?>/images/usa.png" alt="<?php echo $lang->tr("English"); ?>" /> <?php echo $lang->tr("English"); ?></a></li>
      <li><a href="<?php echo $_SERVER["PHP_SELF"]; ?>?m=<?php echo $GLOBALS["m"]; ?>&l=ru_RU&curr=ru-ru&id=<?php echo htmlspecialchars($_GET["id"]); ?>" class="toplink" title="<?php echo $lang->tr("Russian"); ?>"><img src="<?php echo sett::templates.sett::template; ?>/images/russia.png" alt="<?php echo $lang->tr("Russian"); ?>" /> <?php echo $lang->tr("Russian"); ?></a></li>
      <li><a href="<?php echo $_SERVER["PHP_SELF"]; ?>?m=<?php echo $GLOBALS["m"]; ?>&l=sk_SK&curr=sk-sk&id=<?php echo htmlspecialchars($_GET["id"]); ?>" class="toplink" title="<?php echo $lang->tr("Slovak"); ?>"><img src="<?php echo sett::templates.sett::template; ?>/images/slovakia.png" alt="<?php echo $lang->tr("Slovak"); ?>" /> <?php echo $lang->tr("Slovak"); ?></a></li>
    </ul>
  </li>
  <li>
    <a href="#"><img src="<?php echo sett::templates.sett::template; ?>/images/money.png" alt="" /></a>
    <ul>
      <li><a href="<?php echo $_SERVER["PHP_SELF"]; ?>?m=<?php echo $GLOBALS["m"]; ?>&curr=sk-sk&id=<?php echo htmlspecialchars($_GET["id"]); ?>" class="toplink"><?php echo $lang->tr("€ (EUR)"); ?></a></li>
      <li><a href="<?php echo $_SERVER["PHP_SELF"]; ?>?m=<?php echo $GLOBALS["m"]; ?>&curr=cs-cz&id=<?php echo htmlspecialchars($_GET["id"]); ?>" class="toplink"><?php echo $lang->tr("Kč (CZK)"); ?></a></li>
      <li><a href="<?php echo $_SERVER["PHP_SELF"]; ?>?m=<?php echo $GLOBALS["m"]; ?>&curr=ru-ru&id=<?php echo htmlspecialchars($_GET["id"]); ?>" class="toplink"><?php echo $lang->tr("руб (RUB)"); ?></a></li>
      <li><a href="<?php echo $_SERVER["PHP_SELF"]; ?>?m=<?php echo $GLOBALS["m"]; ?>&curr=en-us&id=<?php echo htmlspecialchars($_GET["id"]); ?>" class="toplink"><?php echo $lang->tr("$ (USD)"); ?></a></li>
      <li><a href="<?php echo $_SERVER["PHP_SELF"]; ?>?m=<?php echo $GLOBALS["m"]; ?>&curr=en-gb&id=<?php echo htmlspecialchars($_GET["id"]); ?>" class="toplink"><?php echo $lang->tr("£ (GBP)"); ?></a></li>
    </ul>
  </li>
</ul>
</div>