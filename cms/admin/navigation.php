<?php
function nav_menu(){
         global $db, $prefix;

echo "<center>
      [ <a href=\"index.php\">Admin</a> ]
      [ <a href=\"users.php\">Users</a> ]
      [ <a href=\"options.php\">Options</a> ]
      [ <a href=\"admins.php\">Admins</a> ]
      [ <a href=\"users.php?action=SendAll\">Email All Users</a> ]
      [ <a href=index.php?maa=Logout>Logout</a> ]

      </center><br>";

}
?>
