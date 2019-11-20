$(document).ready(function() {

$("input.button").button();
$(".button-details").button({ icons: {primary:'ui-icon-clipboard'} });
$(".button-order").button();
$(".button-back").button({ icons: {primary:'ui-icon-carat-1-w'} });
$(".formButton").button({ icons: {primary:'ui-icon-check'} });
$(".chbutton").button({ icons: {primary:'ui-icon ui-icon-circle-arrow-w'} });
$(".recalculate").button({ icons: {primary:'ui-icon-refresh'} });
$("#dphpay").button();
$(".login").button({ icons: {primary:'ui-icon-key'} });
$(".error").addClass("ui-state-error");
$(".highlight").addClass("ui-state-highlight");
$("input[type='text']").addClass("ui-state-default ui-corner-all");
$("textarea").addClass("ui-state-default ui-corner-all");
$("select").addClass("ui-state-default ui-corner-all");
$("select").selectmenu();

});