# panda
prosty system zarządzania newsami

 wymagana baza MySQL, nazwa `panda`
 ```SQL
 CREATE DATABASE panda
 ```
 
 Tabela `users`
 ```SQL
 CREATE TABLE panda.users ( 
 id INT NOT NULL AUTO_INCREMENT , 
 first_name VARCHAR(255) NOT NULL, 
 last_name VARCHAR(255) NOT NULL, 
 email VARCHAR(255) NOT NULL, 
 gender BOOLEAN NOT NULL, 
 is_active BOOLEAN NOT NULL, 
 password VARCHAR(255) NOT NULL, 
 created_at DATETIME NOT NULL, 
 updated_at DATETIME NOT NULL, 
 PRIMARY KEY (id)
 ) ENGINE = InnoDB;
 ```
 
 Tabela `news`
 ```SQL
 CREATE TABLE panda.newsa ( 
 id INT NOT NULL AUTO_INCREMENT, 
 name VARCHAR(255) NOT NULL, 
 description TEXT NOT NULL, 
 is_active BOOLEAN NOT NULL, 
 created_at DATETIME NOT NULL, 
 updated_at DATETIME NOT NULL, 
 author_id INT NOT NULL, 
 PRIMARY KEY (id)
 ) ENGINE = InnoDB;
 ```
 
 Klucz obcy
 ```SQL
 ALTER TABLE news
 ADD FOREIGN KEY (author_id) 
 REFERENCES useras(id) 
 ON DELETE RESTRICT 
 ON UPDATE RESTRICT;
 ```
