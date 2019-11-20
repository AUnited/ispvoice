<script type="text/javascript">
 $(document).ready(function(){
 	
	jQuery.validator.messages.required = "";
	$("#domform").validate({
		onkeyup: false,
		submitHandler: function() {
			$("td.error").hide();
			
  			//ajax
        var form = $(this);
        $('#stav').html('<?php echo "<img src=\"tpl/hostovat/images/preloader.gif\" alt=\"Loading...\" /> ".$lang->tr("Checking domain, please wait."); ?>');
        $('#stav').show();
        $('#domresult').hide();
        $.ajax({type: form.attr('method'), url: form.attr('action'), data: form.serializeArray(), success: function(response) {
          $('#stav').html('<?php echo $lang->tr("Domain has been verified"); ?>');
          $('#stav').hide("slow");
          $('#domresult').show();
        }});
        return false;

		},
		messages: {
		},
		debug:false
	});

  $("div.buttonSubmit").hoverClass("buttonSubmitHover");

});



$.fn.hoverClass = function(classname) {
	return this.hover(function() {
		$(this).addClass(classname);
	}, function() {
		$(this).removeClass(classname);
	});
};

</script>
<div id="ispvoice">
<table class="full">
<form id="domform" name="domain" method="post" action="index.php?m=domain&type=check&edit=<?php echo htmlspecialchars($_GET["edit"]); ?>">
		<tr>
			<td colspan="2" class="content3"><strong><?php echo $lang->tr("New domain"); ?></strong><?php echo showflow(); ?></td>
		</tr>
    <tr>
			<td class="content2"><strong><?php echo $lang->tr("Domain name"); ?></strong><br />
      <a href="index.php?m=domain_list&edit=<?php echo htmlspecialchars($_GET["edit"]); ?>" class="link"><img src="tpl/hostovat/images/domain.png" alt="Domain" /><?php echo $lang->tr("Domains pricelist"); ?></a></td>
			<td class="content"><strong>www.</strong>
				<input name="domain" type="text" class="required textinput" id="domainname" value="<?php echo $GLOBALS["ins_domain"]; ?>" />
				<select name="extension" id="extension" class="required textinput">
				<?php echo $domain->generate_options(); ?>
				</select>
				<input type="submit" name="add-button" value="<?php echo $lang->tr("Check domain"); ?>" class="button" />
				<br />
				<small><?php echo $lang->tr("(exam.: www.domain.com)"); ?></small>
			</td>
		</tr>
</form>
		<tr>
		  <td class="content" colspan="2">
        <div><b><?php echo $lang->tr("Options"); ?></b><img src="tpl/hostovat/images/preloader.gif" style="display: none;" /><img src="tpl/hostovat/images/check.png" style="display: none;" /><img src="tpl/hostovat/images/close.png" style="display: none;" /><img src="tpl/hostovat/images/warning.png" style="display: none;" /></div>
        <div id="stav" style="display:none;"></div>
        <div id="domresult">
          <div class="<?php echo $GLOBALS["infostyle"]; ?>"><?php echo $GLOBALS["dommsg"]; ?></div>
        </div>
        <?php if($GLOBALS["showorder"]) { ?>
<form name="domain" method="post" action="index.php?m=domain&type=buy&edit=<?php echo htmlspecialchars($_GET["edit"]); ?>">
        <div class="dom_item">
          <div class="domres"><img src="tpl/hostovat/images/web1.png" alt="Domain" /><span><?php echo $lang->tr("Domain")." <b>".$GLOBALS["domainname"]."</b> ".$lang->tr($GLOBALS["domstat"][0]); ?></span></div>
          <div class="domrescap"><?php echo $lang->tr($GLOBALS["domstat"][1]); ?></div>
          <div>
            <input type="hidden" name="domain" value="<?php echo $GLOBALS["domain"]; ?>" />
            <input type="hidden" name="extension" value="<?php echo $GLOBALS["extension"]; ?>" />
            <input type="hidden" name="stat" value="<?php echo $GLOBALS["domstat_send"]; ?>" />
            <input type="hidden" name="qty" value="" />
    				<img src="tpl/hostovat/images/go.png" alt="->" />&nbsp;
            <input name="submit" type="submit" class="button" value="<?php echo $lang->tr($GLOBALS["domstat"][2]); ?>" />
          </div>
        </div>
</form>
        <?php } ?>
<!--
<form name="domain" method="post" action="index.php?m=domain&type=del&edit=<?php echo htmlspecialchars($_GET["edit"]); ?>">
        <div class="dom_item">
          <input name="submit" type="submit" class="link" value="<?php echo $lang->tr("Continue without domain"); ?>" />
        </div>
</form>
-->
      </td>
		</tr>
	</table>
</div>

<?php include(sett::templates."/".sett::template."/_copy.php"); ?>