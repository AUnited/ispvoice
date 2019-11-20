
<div id="ispvoice">
<form name="address" method="post" action="index.php?m=userdata">
<table class="full">
	<tr>
		<td colspan="2" class="content3"><strong><?php echo $lang->tr("User data"); ?></strong><?php echo showflow(); ?></td>
	</tr>
<?php if($GLOBALS["error"]!="") { ?>
	<tr>
		<td colspan="2"><div class="error"><?php echo $GLOBALS["error"]; ?></div></td>
	</tr>
<?php } ?>
	<tr>
		<td class="content2"><label for="login"><?php echo $lang->tr("Login"); ?></label><span class="star">*</span><br /><?php echo $lang->tr("5-16 chars"); ?> <?php echo $lang->tr("(a-z A-Z 0-9 _ -)"); ?></td>
		<td class="content-r">
    <?php if($GLOBALS["logged"]["id"]>0) { $type="hidden"; $name=$GLOBALS["logged"]["name"]; } else { $type="text"; $name=""; } ?>
    <?php echo $name; ?><input id="login" type="<?php echo $type; ?>" name="login" value="<?php echo $GLOBALS["data"]["login"]; ?>" class="required" maxlength="40" /> <?php if(sett::wpallow) { ?><a href="<?php echo $GLOBALS["wppath"] ?>wp-login" class="login"><?php echo $lang->tr("Log in"); ?></a><br /><small><?php echo $lang->tr("If you have account, please login first."); ?></small><?php } ?></td>
	</tr>
  <input name="existuser" id="existuser" type="hidden" class="existuser" value="<?php echo $GLOBALS["logged"]["id"]; ?>" />
	<tr>
		<td class="content2"><label for="fname"><?php echo $lang->tr("Name"); ?></label><span class="star">*</span></td>
		<td class="content-r"><input id="fname" type="text" name="fname" value="<?php echo $GLOBALS["data"]["fname"]; ?>" class="required" maxlength="40" /></td>
	</tr>
	<tr>
		<td class="content2"><label for="lname"><?php echo $lang->tr("Surname"); ?></label><span class="star">*</span></td>
		<td class="content-r"><input type="text" id="lname" name="lname" value="<?php echo $GLOBALS["data"]["lname"]; ?>" class="required" maxlength="40" /></td>
	</tr>
	<tr>
		<td class="content2"><label for="gender"><?php echo $lang->tr("Gender"); ?></label></td>
		<td class="content">
    <select id="gender" name="gender" size="1">
			<?php echo $userdata->generate_options_gender($lang); ?>
		</select></td>
	</tr>
	<tr>
		<td class="content2"><label for="email"><?php echo $lang->tr("e-mail"); ?></label><span class="star">*</span><br /><small><?php echo $lang->tr("Contact e-mail"); ?></small></td>
		<td class="content-r"><input id="email" name="email" type="text" class="required" value="<?php echo $GLOBALS["data"]["email"]; ?>" maxlength="100" /></td>
	</tr>
	<tr>
		<td class="content2"><label for="phone"><?php echo $lang->tr("Phone"); ?></label><br /><small><?php echo $lang->tr("(exam.: +001-xxx xxxxxx)"); ?></small></td>
		<td class="content"><input name="phone" id="phone" type="text" class="phone" value="<?php echo $GLOBALS["data"]["phone"]; ?>" maxlength="20" /></td>
	</tr>
	<tr>
		<td class="content2"><label for="sknic"><?php echo $lang->tr("NIC handle"); ?></label><br /><small><?php echo $lang->tr("Fill in only if you have NIC handle."); ?><br /><?php echo $lang->tr("(form: ABCD-0123)"); ?></small></td>
		<td class="content"><input name="sknic" id="sknic" type="text" class="sknic" value="<?php echo $GLOBALS["data"]["sknic"]; ?>" maxlength="20" /></td>
	</tr>
	<tr>
		<td colspan="2" class="content3"><strong><?php echo $lang->tr("Facturing details"); ?></strong></td>
	</tr>
	<tr>
		<td class="content2"><label for="address"><?php echo $lang->tr("Street and number"); ?></label><span class="star">*</span></td>
		<td class="content-r"><input type="text" id="address" name="address" value="<?php echo $GLOBALS["data"]["address"]; ?>" class="required" /></td>
	</tr>
	<tr>
		<td class="content2"><label for="zipcode"><?php echo $lang->tr("ZIP"); ?></label><span class="star">*</span></td>
		<td class="content-r"><input type="text" id="zipcode" name="zipcode" value="<?php echo $GLOBALS["data"]["zipcode"]; ?>" class="required zipcode" /></td>
	</tr>
	<tr>
		<td class="content2"><label for="city"><?php echo $lang->tr("City"); ?></label><span class="star">*</span></td>
		<td class="content-r"><input type="text" id="city" name="city" value="<?php echo $GLOBALS["data"]["city"]; ?>" class="required city" /></td>
	</tr>
	<tr>
		<td class="content2"><label for="country"><?php echo $lang->tr("Country"); ?></label><span class="star">*</span></td>
		<td class="content-r">
      <select id="country" name="country" class="required country">
        <option value=""><?php echo $lang->tr(" Select"); ?></option>
        <?php echo $userdata->generate_options_country($lang); ?>
      </select>  
    </td>
	</tr>
	<tr>
		<td class="content2"><label for="state"><?php echo $lang->tr("State"); ?></label></td>
		<td class="content"><input type="text" id="state" name="state" value="<?php echo $GLOBALS["data"]["state"]; ?>" class="state" /></td>
	</tr>
	<tr>
		<td colspan="2" class="content3"><strong><?php echo $lang->tr("Company data"); ?></strong></td>
	</tr>
	<tr>
		<td class="content2"><label for="finame"><?php echo $lang->tr("Company name"); ?></label></td>
		<td class="content"><input type="text" id="finame" name="finame" value="<?php echo $GLOBALS["data"]["finame"]; ?>" class="finame" /></td>
	</tr>
	<tr>
		<td class="content2"><label for="ico"><?php echo $lang->tr("ID"); ?></label><br /><small><?php echo $lang->tr("(exam.: 12345678)"); ?></small></td>
		<td class="content"><input id="ico" type="text" name="ico" value="<?php echo $GLOBALS["data"]["ico"]; ?>" class="ico" /></td>
	</tr>
	<tr>
		<td class="content2"><label for="dic"><?php echo $lang->tr("TAX ID"); ?></label><br /><small><?php echo $lang->tr("(exam.: 1234567890)"); ?></small></td>
		<td class="content"><input type="text" id="dic" name="dic" value="<?php echo $GLOBALS["data"]["dic"]; ?>" class="dic" /></td>
	</tr>
	<tr>
		<td class="content2"><label for="icdph"><?php echo $lang->tr("VAT Number"); ?></label><br /><small><?php echo $lang->tr("(exam.: SK 1234567890)"); ?></small></td>
		<td class="content"><input type="text" id="icdph" name="icdph" value="<?php echo $GLOBALS["data"]["icdph"]; ?>" class="icdph" /></td>
	</tr>
	<tr>
		<td class="content2"><?php echo $lang->tr("I am a tax payer?"); ?></td>
		<td class="content"><input type="checkbox" id="dphpay" name="dphpay" value="1" class="dphpay"<?php echo $GLOBALS["check"]["dphpay"]; ?> /><label for="dphpay">&nbsp;<?php echo $lang->tr("Yes"); ?></label></td>
	</tr>
	<tr>
		<td colspan="2" class="content3"><strong><?php echo $lang->tr("Additional informations"); ?></strong></td>
	</tr>
	<tr>
		<td colspan="2" class="content2">
      <label for="cond"><?php echo $lang->tr("Comments:"); ?></label><br />
      <textarea id="prip" class="prip" name="prip" rows="6" style="width: 100%"><?php echo $GLOBALS["data"]["prip"]; ?></textarea>
    </td>
	</tr>
<?php if($GLOBALS["conditions"]) { ?>
	<tr>
		<td colspan="2" class="content-r">
      <input type="checkbox" id="cond" name="cond" value="1" class="required cond"<?php echo $GLOBALS["check"]["cond"]; ?> /><label for="cond">&nbsp;<strong><?php echo $lang->tr("I accept the conditions of use the services."); ?></strong></label><span class="star">*</span><br />
      <textarea id="condtext" class="condtext" name="condtext" rows="6" readonly="readonly" style="width: 100%"><?php echo $GLOBALS["conditions"]; ?></textarea>
    </td>
	</tr>
<?php } ?>
	<tr>
		<td colspan="2"><small><?php echo $lang->tr("<u>Notice</u>: Items marked * are mandatory!"); ?></small></td>
	</tr>
	<tr align="right">
		<td colspan="2">
			<div class="buttonSubmit">
            <span></span>
            <input class="formButton" type="submit" value="<?php echo $lang->tr("Continue"); ?>" />
      </div>
		</td>
	</tr>
</table>
</form>
</div>

<?php include(sett::templates."/".sett::template."/_copy.php"); ?>