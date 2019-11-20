<div id="ispvoice">
<table class="full">
	<tr>
		<td class="content3" colspan="2"><strong><?php echo $lang->tr("Domains"); ?></strong></td>
	</tr>
<?php $list=$domain_list->generate_list();
foreach($list as $item => $value) { ?>
	<tr>
		<td class="content"><a href="index.php?m=domain&extension=<?php echo $value[0]; ?>&edit=<?php echo htmlspecialchars($_GET["edit"]); ?>" class="linkdom"><img src="tpl/hostovat/images/domain.png" alt="Domain" /> <strong><?php echo $value[0]; ?></strong></a></td>
		<td class="content2"><?php $price=$money->money($value[1]); echo $price[0].$price[2].$price[1]; ?> / <?php echo round(($value[2]/12),1); ?> <?php echo $lang->tr("Year"); ?></td>
	</tr>
<?php } ?>
</table>
</div>

<?php include(sett::templates."/".sett::template."/_copy.php"); ?>