<div id="ispvoice">
<table class="full">
	<tr align="right">
		<td colspan="2"></td>
	</tr>
	<tr>
		<td colspan="2" class="title"><img src="tpl/hostovat/images/plan.png" alt="Hosting" /><strong><?php echo $GLOBALS["hp_name"]; ?></strong></td>
	</tr>
	<tr>
		<td colspan="2" class="content3"><strong><?php echo $lang->tr("Domains"); ?></strong></td>
	</tr>
	<tr>
		<td class="content"><?php echo $lang->tr("Domain aliases"); ?></td>
		<td width="100" style="white-space:nowrap;" class="content2"><?php echo $GLOBALS["hp_als"]; ?></td>
	</tr>
	<tr>
		<td class="content"><?php echo $lang->tr("Subdomains"); ?></td>
		<td style="white-space:nowrap;" class="content2"><?php echo $GLOBALS["hp_sub"]; ?></td>
	</tr>
	<tr>
		<td colspan="2" class="content3"><strong><?php echo $lang->tr("Webspace"); ?></strong></td>
	</tr>
	<tr>
		<td class="content"><?php echo $lang->tr("Data space"); ?></td>
		<td style="white-space:nowrap;" class="content2"><?php echo $GLOBALS["hp_disk"]; ?> MB</td>
	</tr>
	<tr>
		<td class="content"><?php echo $lang->tr("Traffic"); ?></td>
		<td style="white-space:nowrap;" class="content2"><?php echo $GLOBALS["hp_traff"]; ?> MB</td>
	</tr>
	<tr>
		<td colspan="2" class="content3"><span class="content3"><strong><?php echo $lang->tr("Properties"); ?></strong></span></td>
	</tr>
	<tr>
		<td class="content"><?php echo $lang->tr("PHP"); ?></td>
		<td style="white-space:nowrap;" class="content2"><?php echo $lang->tr($GLOBALS["hp_php"]); ?></td>
	</tr>
	<tr>
		<td class="content"><?php echo $lang->tr("CGI"); ?></td>
		<td style="white-space:nowrap;" class="content2"><?php echo $lang->tr($GLOBALS["hp_cgi"]); ?></td>
	</tr>
	<tr>
		<td class="content"><?php echo $lang->tr("DNS"); ?></td>
		<td nowrap="nowrap" class="content2"><?php echo $lang->tr($GLOBALS["hp_dns"]); ?></td>
	</tr>
		<tr>
		<td class="content"><?php echo $lang->tr("Backups"); ?></td>
		<td style="white-space:nowrap;" class="content2"><?php echo $lang->tr($GLOBALS["hp_backup"]); ?></td>
	</tr>
	<tr>
		<td class="content"><?php echo $lang->tr("e-mail acounts"); ?></td>
		<td style="white-space:nowrap;" class="content2"><?php echo $GLOBALS["hp_mail"]; ?></td>
	</tr>
	<tr>
		<td class="content"><?php echo $lang->tr("FTP acounts"); ?></td>
		<td style="white-space:nowrap;" class="content2"><?php echo $GLOBALS["hp_ftp"]; ?></td>
	</tr>
	<tr>
		<td class="content"><?php echo $lang->tr("SQL databases"); ?></td>
		<td style="white-space:nowrap;" class="content2"><?php echo $GLOBALS["hp_sql_db"]; ?></td>
	</tr>
	<tr>
		<td class="content"><?php echo $lang->tr("SQL users"); ?></td>
		<td style="white-space:nowrap;" class="content2"><?php echo $GLOBALS["hp_sql_user"]; ?></td>
	</tr>
	<tr>
		<td colspan="2" class="content3"><strong><?php echo $lang->tr("Standard properties"); ?></strong></td>
	</tr>
	<tr>
		<td class="content"><?php echo $lang->tr("Control panel"); ?></td>
		<td style="white-space:nowrap;" class="content2"><?php echo $lang->tr("Yes"); ?></td>
	</tr>
	<tr>
		<td class="content"><?php echo $lang->tr("Webmail"); ?></td>
		<td style="white-space:nowrap;" class="content2"><?php echo $lang->tr("Yes"); ?></td>
	</tr>
	<tr>
		<td class="content"><?php echo $lang->tr("Web FTP"); ?></td>
		<td style="white-space:nowrap;" class="content2"><?php echo $lang->tr("Yes"); ?></td>
	</tr>
	<tr>
		<td class="content"><?php echo $lang->tr("Statistics"); ?></td>
		<td style="white-space:nowrap;" class="content2"><?php echo $lang->tr("Yes"); ?></td>
	</tr>
	<tr>
		<td class="content"><?php echo $lang->tr("Own error pages"); ?></td>
		<td style="white-space:nowrap;" class="content2"><?php echo $lang->tr("Yes"); ?></td>
	</tr>
	<tr>
		<td class="content"><?php echo $lang->tr("Private areas"); ?></td>
		<td style="white-space:nowrap;" class="content2"><?php echo $lang->tr("Yes"); ?></td>
	</tr>
	<tr>
		<td class="content"><?php echo $lang->tr("Logs"); ?></td>
		<td style="white-space:nowrap;" class="content2"><?php echo $lang->tr("Yes"); ?></td>
	</tr>
	<tr>
		<td colspan="2" class="content3"><strong><?php echo $lang->tr("Enhancements"); ?></strong></td>
	</tr>
	<tr>
		<td class="content"><?php echo $lang->tr("Ticket support"); ?></td>
		<td style="white-space:nowrap;" class="content2"><?php echo $lang->tr("Yes"); ?></td>
	</tr>
	<tr>
		<td class="content"><?php echo $lang->tr("Updates"); ?></td>
		<td style="white-space:nowrap;" class="content2"><?php echo $lang->tr("Yes"); ?></td>
	</tr>
<?php if($GLOBALS["hp_desc"]!="") { ?>
	<tr>
		<td colspan="2" class="content3"><strong><?php echo $lang->tr("Comments"); ?></strong></td>
	</tr>
	<tr>
		<td class="content" colspan="2"><?php echo $GLOBALS["hp_desc"]; ?></td>
	</tr>
<? } ?>
	<tr>
		<td colspan="2" class="content3"><strong><?php echo $lang->tr("Price"); ?></strong></td>
	</tr>
	<tr>
		<td class="content"><?php echo $lang->tr("Price"); ?></td>
		<td style="white-space:nowrap;" class="content2"><strong><?php $price=$money->money($GLOBALS["hp_price"]); echo $price[0].$price[2].$price[1]; ?></strong> / <?php echo $lang->tr("month"); ?></td>
	</tr>
	<tr>
		<td class="content"><?php echo $lang->tr("Setup fee"); ?></td>
		<td style="white-space:nowrap;" class="content2"><?php $price1=$money->money($GLOBALS["hp_setup"]); echo $price1[0].$price1[2].$price1[1]; ?></td>
	</tr>
	<tr align="center">
		<td colspan="2">&nbsp;</td>
	</tr>
	
	<tr align="center">
		<td colspan="2">
      <div style="width: 130px; float: left;"><a href="javascript:history.go(-1);" class="button-back"><?php echo $lang->tr("Back"); ?></a></div>
    <?php if($GLOBALS["hp_status"]==1) { ?>
      <div style="width: 130px; float: left;">
      <form method="post" action="index.php?m=plans&edit=<?php echo htmlspecialchars($_GET["edit"]); ?>">
      <input type="hidden" name="id" value="<?php echo $GLOBALS["hp_id"]; ?>" />
      <input type="hidden" name="name" value="<?php echo $GLOBALS["hp_name"]; ?>" />
      <input type="hidden" name="qty" value="" />
      <input type="submit" name="add-button" value="<?php echo $lang->tr("Order"); ?>" class="button-order" />
      </form>
      </div>
    <?php } ?>
      <div style="clear: both;"></div>
    </td>
	</tr>
</table>
</div>

<?php include(sett::templates."/".sett::template."/_copy.php"); ?>