<div id="ispvoice">
	<table class="full">
		<tr>
			<td colspan="2" class="content3"><strong><?php echo $lang->tr("Summary"); ?></strong><?php echo showflow(); ?></td>
		</tr>
<?php if($GLOBALS["error"]!="") { ?>
	<tr>
		<td colspan="2"><div class="error"><?php echo $GLOBALS["error"]; ?></div></td>
	</tr>
<?php } ?>
		<tr>
			<td class="content2"><span class="content"><strong><?php echo $lang->tr("User data"); ?></strong></td>
      <td class="content2" style="text-align: right;"><a href="index.php?m=userdata&edit=yes" class="chbutton"><?php echo $lang->tr("change"); ?></a></span></td>
		</tr>
		<tr>
			<td class="content"><?php echo $lang->tr("Name"); ?></td>
			<td class="content"><?php echo $GLOBALS["data"]["fname"]; ?></td>
		</tr>
		<tr>
			<td class="content"><?php echo $lang->tr("Surname"); ?></td>
			<td class="content"><?php echo $GLOBALS["data"]["lname"]; ?></td>
		</tr>
		<tr>
			<td class="content"><?php echo $lang->tr("e-mail"); ?></td>
			<td class="content"><?php echo $GLOBALS["data"]["email"]; ?></td>
		</tr>
			<tr>
			<td class="content"><?php echo $lang->tr("Phone"); ?></td>
			<td class="content"><?php echo $GLOBALS["data"]["phone"]; ?></td>
		</tr>
		<tr>
			<td class="content"><?php echo $lang->tr("Company"); ?></td>
			<td class="content"><?php echo $GLOBALS["data"]["finame"]; ?></td>
		</tr>
		<tr>
			<td class="content"><?php echo $lang->tr("ID"); ?></td>
			<td class="content"><?php echo $GLOBALS["data"]["ico"]; ?></td>
		</tr>
		<tr>
			<td class="content"><?php echo $lang->tr("TAX ID"); ?></td>
			<td class="content"><?php echo $GLOBALS["data"]["dic"]; ?></td>
		</tr>
		<tr>
			<td class="content"><?php echo $lang->tr("Street"); ?></td>
			<td class="content"><?php echo $GLOBALS["data"]["address"]; ?></td>
		</tr>
		<tr>
			<td class="content"><?php echo $lang->tr("City"); ?></td>
			<td class="content"><?php echo $GLOBALS["data"]["city"]; ?></td>
		</tr>
		<tr>
			<td class="content"><?php echo $lang->tr("Country"); ?></td>
			<td class="content"><?php echo $GLOBALS["data"]["country"]; ?></td>
		</tr>
		<tr>		
			<td colspan="2">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="2" class="content"><strong><?php echo $lang->tr("Order"); ?></strong></td>
		</tr>
		<tr>
			<td colspan="2" class="content2">
        <div class="summ_line">
          <div class="orsel" style="float: left;"><a href="index.php?m=domain&edit=yes" class="chbutton"><?php echo $lang->tr("change"); ?></a></div>
          <div class="summ1c" style="float: left;"><img src="tpl/hostovat/images/summ_domain.png" alt="Domain" /><?php echo $GLOBALS["data"]["dom_dom"]; ?></div>
          <div class="orname" style="float: left;">
            <div><img src="tpl/hostovat/images/time.png" alt="Time" /> <?php echo $GLOBALS["data"]["dom_dur"]; ?> <?php echo $lang->tr("months"); ?></div>
            <div><img src="tpl/hostovat/images/money.png" alt="Money" /> <?php echo $GLOBALS["data"]["dom_price_final_v"]; ?></div>
          </div>
          <div style="clear: both;"></div>
        </div>
        <div class="summ_line">
          <div class="orsel" style="float: left;"><a href="index.php?m=plans&edit=yes" class="chbutton"><?php echo $lang->tr("change"); ?></a></div>
          <div class="summ1c" style="float: left;"><img src="tpl/hostovat/images/summ_host.png" alt="Hosting" /><?php echo $GLOBALS["data"]["hosting_name"]; ?></div>
          <div class="orname" style="float: left;">
            <div><img src="tpl/hostovat/images/time.png" alt="Time" /> <?php echo $GLOBALS["data"]["hosting_dur"]; ?> <?php echo $lang->tr("months"); ?></div>
            <div><img src="tpl/hostovat/images/money.png" alt="Money" /> <?php echo $GLOBALS["data"]["host_price_final"]; ?></div>
          </div>
          <div style="clear: both;"></div>
        </div>
      </td>
		</tr>
		<tr>
			<td class="content"><?php echo $lang->tr("Setup fee"); ?></td>
			<td class="content2"><?php $zprice=$money->money($GLOBALS["data"]["hosting_price2"]); echo $zprice[0].$zprice[2].$zprice[1]; ?></td>
		</tr>
  	<tr>
  		<td class="content2"><label for="paysendtype"><?php echo $lang->tr("Send invoices"); ?></label><span class="star">*</span></td>
  		<td class="content-r">
  		<form name="summary" method="post" action="index.php?m=summary" class="sendit">
      <select id="paysendtype" name="paysendtype" class="required invsendtype">
  			<?php echo $GLOBALS["invoice_sel"]; ?>
  		</select> / <?php echo $lang->tr("month"); ?>
  		<input name="recalculate" type="submit" class="recalculate" value="<?php echo $lang->tr("Recalculate"); ?>" />
  		</td>
  	</tr>
		<tr>
			<td class="content2"><label for="period"><?php echo $lang->tr("Payment period for hosting"); ?></label><span class="star">*</span></td>
			<td class="content-r">
        <select id="period" name="period" class="required paysendtype">
          <?php echo $GLOBALS["payment_sel"]; ?>
        </select>
        <input name="recalculate" type="submit" class="recalculate" value="<?php echo $lang->tr("Recalculate"); ?>" />
      </td>
		</tr>
    <tr>
		  <td colspan="2"><small><?php echo $lang->tr("<u>Notice</u>: Items marked * are mandatory!"); ?></small></td>
	  </tr>
		<tr>
			<td colspan="2">&nbsp;</td>
		</tr>
		<tr>
			<td align="right"></td>
			<td class="content2">
        <span class="sum1"><?php echo $lang->tr("Summary"); ?><sub> <?php echo $lang->tr("exclusiv VAT"); ?></sub></span>
        <span class="sum1v"><?php echo $GLOBALS["data"]["final_amount_exc"]; ?> <?php echo sett::curr; ?></span>
      </td>
		</tr>
		<tr>
			<td align="right"></td>
			<td class="content2">
        <span class="sum2"><?php echo $lang->tr("Summary"); ?><sub> <?php echo $lang->tr("inclusiv VAT"); ?></sub></span>
        <span class="sum2v"><?php echo $GLOBALS["data"]["final_amount_with"]; ?> <?php echo sett::curr; ?></span>
      </td>
		</tr>
		<tr>
			<td align="right"></td>
			<td class="content2">
        <span class="exr"><?php echo $lang->tr("Exchange rate"); ?></span>
        <span class="exrv"><?php echo $GLOBALS["data"]["final_amount_with"]; ?> <?php echo sett::curr; ?> = <?php echo $GLOBALS["data"]["suprice"]; ?></span>
      </td>
		</tr>
		<tr>
			<td></td>
      <td class="content-r"><a id="zc"></a>
       <?php echo $lang->tr("Solve the example to send an order:"); ?>
       <div class="capt"><label for="c"><?php echo $lang->tr($GLOBALS["n1"])." + ".$lang->tr($GLOBALS["n2"]) ?> = </label><input type="text" name="c" id="c" class="c required" value="" size="3" maxlength="2" style="color: #000;" /><sub><?php echo $lang->tr("(numerically)"); ?></sub></div>
       <div><a href="index.php?m=summary&new=1&t=<?php echo time(); ?>#zc" class="link"><img src="tpl/hostovat/images/refresh.png" alt="Refresh" /><?php echo $lang->tr("New example"); ?></a></div>
      </td>
		</tr>
		<tr>
			<td></td>
			<td class="content-r">
			 <div class="payhdiv"><input name="Submit" type="submit" class="button" value="<?php echo $lang->tr("Submit order"); ?>" /></div>
			</td>
		</tr>
</form>
	</table>
</div>

<?php include(sett::templates."/".sett::template."/_copy.php"); ?>