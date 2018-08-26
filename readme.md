
Prérequis  
-------  
Avoir docker & docker-compose installés  
  
Installation  
------  
Ouvrir un terminal à la racine du projet et taper les commandes :  
  
`docker-compose build`  
  
`docker-compose up -d`  
  
  
le dump de la base se trouve à la racine : dump-test_iad_chat.sql

Les informations de connexion de la base de données se trouvent dans le fichier src/dbconfig.php

```
$dbName = 'test_iad_chat';  
  
$dbHost = 'chat_db';  
  
$dbUser = 'iad';  
  
$dbPassword = 'KLzanTatgAazs556';
```
Fonctionnement  
------  
Se rendre sur l'url localhost une fois les containers démarrés pour accéder à l'application