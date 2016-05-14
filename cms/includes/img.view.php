<script language="JavaScript" type="text/javascript">
var newwindow;
var wheight = 0, wwidth = 0;
function popimg(url, title, iwidth, iheight, colour) {
var pwidth, pheight;

if ( !newwindow || newwindow.closed ) {
pwidth=iwidth;
pheight=iheight;
newwindow=window.open('','htmlname','width=' + pwidth +',height=' +pheight + ',resizable=1,top=50,left=10');
wheight=iheight;
wwidth=iwidth;
}

if (wheight!=iheight || wwidth!=iwidth ) {
pwidth=iwidth;
pheight=iheight;
newwindow.resizeTo(pwidth, pheight);
wheight=iheight;
wwidth=iwidth;
}

newwindow.document.clear();
newwindow.focus();
newwindow.document.writeln('<html> <head> <title>¿Cómo Se Dice? Restaurant<\/title> <\/head> <body bgcolor= \"#000000\" topmargin=\"0\" leftmargin=\"0\" rightmargin=\"0\" bottommargin=\"0\"> <center>');
newwindow.document.writeln('<a title="Hit to close!" href="javascript:window.close();"><img src=\"' + url + '\" border=\"0\"></a>');
newwindow.document.writeln('<\/center> <\/body> <\/html>');
newwindow.document.close();
newwindow.focus();
}

function tidy5() {
if (newwindow && !newwindow.closed) { newwindow.close(); }
}

</script>