<?php/* config.php */function dbcon(){    @mysql_connect("localhost", "marquistei", "qaz654wsx") or die(mysql_error());    @mysql_select_db("sistema_suporte") or die(mysql_error());}?>