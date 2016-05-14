<?php
if(isset($_POST['realname']) & $_POST['realname'] != '' & $_POST['sendmail'] == '1' & $_POST['phone'] != '')  {

$comments = stripslashes($_POST['comments']);

mail("info@dbhlimo.com,laurarizk@gmail.com","WEBSITE REQUEST","

Name: $_POST[realname]
Phone: $_POST[phone]
Email: $_POST[email]


Additional Comments:
$comments","From: postmaster@dbhlimo.com");

echo "Thank you. Your request has been sent.";

}
												