cambiar las config de base de datos 

1. en el archivo controladores/post.php
'host' => 'db',
    'username' => 'db_american_group',
    'password' => '4m3r1c4n2021',
    'db' => 'db' //Cambiar al nombre de tu base de datos

 'host' => 'localhost',
    'username' => 'root',
    'password' => '',
    'db' => 'db' //Cambiar al nombre de tu base de datos
    
2.remplazar en todo

  $mysqli = new mysqli("db","db_american_group","4m3r1c4n2021","db");
    $mysqli = new mysqli("localhost","root","","db");