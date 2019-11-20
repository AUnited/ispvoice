<div id="ispvoice">
<table class="full">
	<tr>
		<td class="content3"><strong><?php echo $lang->tr("Hosting plans"); ?></strong><?php echo showflow(); ?></td>
	</tr>
</table>

<div id="plansdiv">
<?php while($row=mysql_fetch_array($GLOBALS["plan"])) { ?>
<form method="post" action="index.php?m=plans&edit=<?php echo htmlspecialchars($_GET["edit"]); ?>">
					<div class="plans">
            <input type="hidden" name="id" value="<?php echo $row["id"]; ?>" />
            <input type="hidden" name="name" value="<?php echo $row["name"]; ?>" />
            <input type="hidden" name="qty" value="" />
						<ul>
							<li><a href="index.php?m=package_info&id=<?php echo $row["id"]; ?>" class="linkdark"><strong><?php echo $row["name"]; ?></strong></a></li>
							<li><strong><?php echo $lang->tr("Price"); ?>:</strong> <?php $price=$money->money($row["price"]); echo $price[0].$price[2].$price[1]; ?> / <?php echo $lang->tr("month"); ?></li>
							<li><strong><?php echo $lang->tr("Setup fee"); ?>:</strong> <?php if($row["setup_fee"]==0 || $row["setup_fee"]=="") { echo $lang->tr("free"); } else { $price1=$money->money($row["setup_fee"]); echo $price1[0].$price1[2].$price1[1]; } ?></li>
						</ul>
						<center><a href="index.php?m=package_info&id=<?php echo $row["id"]; ?>" class="button-details"><?php echo $lang->tr("Details"); ?></a>
<?php if($row["status"]==1) { ?>
						<input type="submit" name="add-button" value="<?php echo $lang->tr("Order"); ?>" class="button-order" />
<?php } ?>
					</center>
          </div>
					<div style="clear: both;"></div>
</form>
<?php } ?>
</div>
</div>

<?php include(sett::templates."/".sett::template."/_copy.php"); ?>