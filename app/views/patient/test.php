<?php 
$pass = 204074;
$a = "2y$10Vk2eZe45QewoZAWsF8AVWOrSG/jMO4CoNKlx3r0ZMyMutlRkpyzZe";
$p = password_hash($pass, PASSWORD_BCRYPT);

echo $a;
echo $p;