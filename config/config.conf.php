<?php
class sett
{
const debug=true;

const classes="class/"; //folder for classes
const modules="module/"; //folder for modules
const libs="lib/"; //folder for libraries
const templates="tpl/"; //folder for templates
const languages="language/"; //folder for languages
const plugins="plugins/"; //folder for plugins

const redirect=""; //Redirect to other page (Flag 301 Moved Permanently)
const redirectwww=true; //Redirect to www. (Flag 301 Moved Permanently)
const pageflow="domain,plans,userdata,summary"; //The first 4 pages ordering (orderflow), the last cannot be changed, is it only info
const nextflowsymbol="&#9654;"; //symbol in flowchart
const webadmin_path="https://webadmin.page.com/"; //path to webadmin
const template="hostovat"; //template name
const header="ispvoice"; //add site header: ispvoice,wp,ispcp,none (if is set wp, wordpress engine must be enabled)
const footer="ispvoice"; //add site footer: ispvoice,wp,ispcp,none (if is set wp, wordpress engine must be enabled)
const menu=true; //add menu
const usescripts=true; //Use internal scripts definitions in template file _scripts.php
const keywords="webhosting,hosting,hostovat,server"; //you can translate it
const robots="index, follow"; //robots engines
const plugin=""; //enabled plugins; delimited by ","; example "date"

const headline="{SERVER} &rsaquo; {MODULE}"; //headline bar {SERVER} = domain name, {MODULE} = current module

const reseller=1; //resseller ID from ispcp
const variable_service="01"; //variable service inserted in specific symbol
const duedate=14; //due date in days
const reseller_name="Reseller"; //name for resseller in mail
const adminmail="admin@domain.tld"; //email for resseller in mail
const vat=20; //current vat in %
const countvat=true; //all prices with or without VAT
const mail_from="info@domain.tld";  //mail from in mail
const ccname="Reseller [copy]"; //carbon copy name
const ccmail="info@domain.tld"; //carbon copy mail
const maillang="en"; //email language to resseller

const showallinvoices=true; //Show invoices to all people, send it by link in email
const wppageid_invoice="5"; //Wordpress page id for Wordpress invoice

//DOMAIN CHECK
const domcheck="subreg"; //Domain check "subreg" or "whois" default: whois

//subreg.cz DOMAIN CHECK if is enabled
const sub_username="hlava22"; //subreg.cz API login
const sub_password="691f47a8bf"; //subreg.cz API password

const curr="€"; //default currency used in orders etc.
const money_conversion=true; //enable conversion module
const money_convertor="eubank"; //source for conversion "google" or (Google can change most of currencies. See: http://www.google.com/finance/converter) "eubank" (eu central bank convert only euro. See: http://www.ecb.int/stats/exchange/eurofxref/html/index.en.html)
const money_currency_name="EUR"; //default currency 3sign name
const money_delimiter=" "; //delimiter in money => 1(delimiter)$
const money_currency_sign="€"; //default currency sign in money format
const money_thousand=" "; //thousand delimiter
const money_dot=","; //dot delimiter
const money_round=2; //round default currency if conversion false

const gateways="other,paypal"; //payment gateways (2co,alertpay,moneybookers,google_checkout,paypal,payflow,other,sagepay)

//Google analytics
const UrchinTr = ""; //urchin tracker, left blank to disable

//wordpress engine IF TRUE SET THE wordpress.conf.php
const wpallow=true; //allow wordpress plugin
const wpsidebar=false; //wordpress sidebar
}
?>