<div id="ispvoice">
<table class="full">
		<tr>
			<td colspan="2" class="content3"><strong><?php echo $lang->tr("Thank you"); ?></strong></td>
		</tr>
		<tr>
			<td colspan="2" class="content2">
        <span class="content_fin">
          <?php echo $GLOBALS["text"]; ?><br />
          <?php echo $GLOBALS["text1"]; ?><br /><br />
          <?php echo $lang->tr("Your"); ?> <?php echo ucfirst($GLOBALS["server"]); ?> <?php echo $lang->tr("team"); ?><br /><br />
          <img src="<?php echo sett::templates.sett::template; ?>/images/web.png" alt="Hosting" />
        </span>
      </td>
		</tr>
</table>
</div>

<?php include(sett::templates."/".sett::template."/_copy.php"); ?>