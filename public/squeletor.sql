drop database cocktails;
create database cocktails;
use cocktails;

CREATE TABLE boisson (
  b_id int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
  b_nom varchar(45) NOT NULL,
  b_type  varchar(45) NOT NULL,
  b_estAlcoolise  tinyint(4) NOT NULL,
  b_qteStockee  float NOT NULL
) ENGINE=InnoDB;

CREATE TABLE  cocktail  (
   c_id  int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
   c_nom  varchar(45) NOT NULL,
   c_cat  enum('SD','LD','AD') NOT NULL,
   c_prix  float NOT NULL
) ENGINE=InnoDB;

CREATE TABLE  commande  (
   com_id  int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
   com_numTable  int(11) NOT NULL
) ENGINE=InnoDB;

CREATE TABLE  etape  (
   c_id  int(11) NOT NULL,
   e_num  int(11) NOT NULL,
   e_desc  text NOT NULL,
   FOREIGN KEY (c_id) REFERENCES  cocktail(c_id)
   ON DELETE CASCADE
   ON UPDATE CASCADE,
   PRIMARY KEY ( c_id ,  e_num )
) ENGINE=InnoDB;

CREATE TABLE  ingredient  (
   i_id  int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
   i_nom  varchar(45) NOT NULL,
   i_type  varchar(45) NOT NULL,
   i_qteStockee  float NOT NULL,
   i_uniteStockee  varchar(15) NOT NULL
) ENGINE=InnoDB;


CREATE TABLE  ustensile  (
   u_id  int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
   u_nom  varchar(45) NOT NULL
) ENGINE=InnoDB;

CREATE TABLE  verre  (
   v_id  int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
   v_type  varchar(45) NOT NULL
) ENGINE=InnoDB;

CREATE TABLE  liencocktailboisson  (
   c_id  int(11) NOT NULL,
   b_id  int(11) NOT NULL,
   qteBoisson  float NOT NULL,
   FOREIGN KEY (c_id) REFERENCES  cocktail(c_id)
   ON DELETE CASCADE
   ON UPDATE CASCADE,
   FOREIGN KEY (b_id) REFERENCES  boisson(b_id)
   ON DELETE CASCADE
   ON UPDATE CASCADE,
   PRIMARY KEY ( c_id ,  b_id )
) ENGINE=InnoDB;

CREATE TABLE  liencocktailcommande  (
   c_id int(11) NOT NULL,
   com_id int(11) NOT NULL,
   nbCocktail int(11) NOT NULL,
   FOREIGN KEY (c_id) REFERENCES  cocktail(c_id)
   ON DELETE CASCADE
   ON UPDATE CASCADE,
   FOREIGN KEY (com_id) REFERENCES  commande(com_id)
   ON DELETE CASCADE
   ON UPDATE CASCADE,
   PRIMARY KEY ( c_id ,  com_id )
) ENGINE=InnoDB;

CREATE TABLE  liencocktailingredient  (
   c_id  int(11) NOT NULL,
   i_id  int(11) NOT NULL,
   qteIngredient  float NOT NULL,
   FOREIGN KEY (c_id) REFERENCES  cocktail(c_id)
   ON DELETE CASCADE
   ON UPDATE CASCADE,
   FOREIGN KEY (i_id) REFERENCES  ingredient(i_id)
   ON DELETE CASCADE
   ON UPDATE CASCADE,
   PRIMARY KEY ( c_id ,  i_id )
) ENGINE=InnoDB;

CREATE TABLE  liencocktailustensile  (
   c_id  int(11) NOT NULL,
   u_id  int(11) NOT NULL,
   FOREIGN KEY (c_id) REFERENCES  cocktail(c_id)
   ON DELETE CASCADE
   ON UPDATE CASCADE,
   FOREIGN KEY (u_id) REFERENCES  ustensile(u_id)
   ON DELETE CASCADE
   ON UPDATE CASCADE,
   PRIMARY KEY ( c_id ,  u_id )
) ENGINE=InnoDB;

CREATE TABLE  liencocktailverre  (
   c_id  int(11) NOT NULL,
   v_id  int(11) NOT NULL,
   FOREIGN KEY (c_id) REFERENCES  cocktail(c_id)
   ON DELETE CASCADE
   ON UPDATE CASCADE,
   FOREIGN KEY (v_id) REFERENCES  verre(v_id)
   ON DELETE CASCADE
   ON UPDATE CASCADE,
   PRIMARY KEY ( c_id ,  v_id )
) ENGINE=InnoDB;


