
# -----------------------------------------------------------------------------
#       TABLE : COMMENTAIRE
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS COMMENTAIRE
 (
   IDCOMMENTAIRE INTEGER(11) NOT NULL  AUTO_INCREMENT,
   IDCOMMENTAIRE_REPONDRE INTEGER(11) NULL  ,
   TEXTCOMMENTAIRE VARCHAR(255) NULL  
   , PRIMARY KEY (IDCOMMENTAIRE) 
 ) 
ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE COMMENTAIRE
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_COMMENTAIRE_COMMENTAIRE
     ON COMMENTAIRE (IDCOMMENTAIRE_REPONDRE ASC);

# -----------------------------------------------------------------------------
#       TABLE : ADMINISTRATEUR
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS ADMINISTRATEUR
 (
   IDADMIN INTEGER(11) NOT NULL  AUTO_INCREMENT,
   NOMADMIN VARCHAR(128) NULL  ,
   EMAIL VARCHAR(128) NULL  ,
   MOTDEPASSE VARCHAR(128) NULL  ,
   IMAGEPROFIL VARCHAR(128) NULL  
   , PRIMARY KEY (IDADMIN) 
 ) 
ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

# -----------------------------------------------------------------------------
#       TABLE : REALISATEUR
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS REALISATEUR
 (
   IDREALISATEUR INTEGER(11) NOT NULL  AUTO_INCREMENT,
   NOMREALISATEUR VARCHAR(128) NULL  ,
   PRENOMREALISATEUR CHAR(32) NULL  ,
   IMAGEREALISATEUR VARCHAR(128) NULL  
   , PRIMARY KEY (IDREALISATEUR) 
 ) 
ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

# -----------------------------------------------------------------------------
#       TABLE : ABONNE
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS ABONNE
 (
   IDABONNE INTEGER(11) NOT NULL  AUTO_INCREMENT,
   NOMABONNE VARCHAR(128) NULL  ,
   PRENOMABONNE VARCHAR(128) NULL  ,
   MDPABONNE VARCHAR(128) NULL  
   , PRIMARY KEY (IDABONNE) 
 ) 
ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

# -----------------------------------------------------------------------------
#       TABLE : FILM
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS FILM
 (
   IDFILM INTEGER(11) NOT NULL  AUTO_INCREMENT,
   IDREALISATEUR INTEGER(11) NOT NULL  ,
   IDGENRE INTEGER(11) NOT NULL  ,
   TITREFILM VARCHAR(128) NULL  ,
   PRIXFILMLOCATION DECIMAL(13,2) NULL  ,
   NBEXPDISPFILM INTEGER(2) NULL  ,
   RESUMELONGFILM VARCHAR(255) NULL  ,
   RESUMECOURTFILM VARCHAR(128) NULL  ,
   IMAGEFILM VARCHAR(128) NULL  
   , PRIMARY KEY (IDFILM) 
 ) 
ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE FILM
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_FILM_REALISATEUR
     ON FILM (IDREALISATEUR ASC);

CREATE  INDEX I_FK_FILM_THEME
     ON FILM (IDGENRE ASC);

# -----------------------------------------------------------------------------
#       TABLE : PROSPECT
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS PROSPECT
 (
   IDPROSPECT INTEGER(11) NOT NULL  AUTO_INCREMENT,
   NOMPROSPECT VARCHAR(128) NULL  ,
   PRENOMPROSPECT VARCHAR(128) NULL  ,
   MDPPROSPECT VARCHAR(128) NULL  
   , PRIMARY KEY (IDPROSPECT) 
 ) 
ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

# -----------------------------------------------------------------------------
#       TABLE : THEME
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS THEME
 (
   IDGENRE INTEGER(11) NOT NULL  AUTO_INCREMENT,
   GENRE VARCHAR(128) NULL  
   , PRIMARY KEY (IDGENRE) 
 ) 
 ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

# -----------------------------------------------------------------------------
#       TABLE : ACTEUR
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS ACTEUR
 (
   IDACTEUR INTEGER(11) NOT NULL  AUTO_INCREMENT,
   NOMACTEUR VARCHAR(128) NULL  ,
   PRENOMACTEUR CHAR(32) NULL  ,
   IMAGEACTEUR VARCHAR(128) NULL  
   , PRIMARY KEY (IDACTEUR) 
 ) 
ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

# -----------------------------------------------------------------------------
#       TABLE : RECOMMANDER
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS RECOMMANDER
 (
   IDABONNE INTEGER(11) NOT NULL  AUTO_INCREMENT,
   IDFILM INTEGER(11) NOT NULL  ,
   IDABONNE_1 INTEGER(11) NOT NULL  
   , PRIMARY KEY (IDABONNE,IDFILM,IDABONNE_1) 
 ) 
ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE RECOMMANDER
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_RECOMMANDER_ABONNE
     ON RECOMMANDER (IDABONNE ASC);

CREATE  INDEX I_FK_RECOMMANDER_FILM
     ON RECOMMANDER (IDFILM ASC);

CREATE  INDEX I_FK_RECOMMANDER_ABONNE1
     ON RECOMMANDER (IDABONNE_1 ASC);

# -----------------------------------------------------------------------------
#       TABLE : JOUER
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS JOUER
 (
   IDFILM INTEGER(11) NOT NULL  ,
   IDACTEUR INTEGER(11) NOT NULL  
   , PRIMARY KEY (IDFILM,IDACTEUR) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE JOUER
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_JOUER_FILM
     ON JOUER (IDFILM ASC);

CREATE  INDEX I_FK_JOUER_ACTEUR
     ON JOUER (IDACTEUR ASC);

# -----------------------------------------------------------------------------
#       TABLE : SUIVRE
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS SUIVRE
 (
   IDABONNE INTEGER(11) NOT NULL  ,
   IDABONNE_1 INTEGER(11) NOT NULL  
   , PRIMARY KEY (IDABONNE,IDABONNE_1) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE SUIVRE
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_SUIVRE_ABONNE
     ON SUIVRE (IDABONNE ASC);

CREATE  INDEX I_FK_SUIVRE_ABONNE1
     ON SUIVRE (IDABONNE_1 ASC);

# -----------------------------------------------------------------------------
#       TABLE : REDIGER
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS REDIGER
 (
   IDABONNE INTEGER(11) NOT NULL  ,
   IDCOMMENTAIRE INTEGER(11) NOT NULL  ,
   IDFILM INTEGER(11) NOT NULL  
   , PRIMARY KEY (IDABONNE,IDCOMMENTAIRE,IDFILM) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE REDIGER
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_REDIGER_ABONNE
     ON REDIGER (IDABONNE ASC);

CREATE  INDEX I_FK_REDIGER_COMMENTAIRE
     ON REDIGER (IDCOMMENTAIRE ASC);

CREATE  INDEX I_FK_REDIGER_FILM
     ON REDIGER (IDFILM ASC);

# -----------------------------------------------------------------------------
#       TABLE : LOUER
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS LOUER
 (
   IDABONNE INTEGER(11) NOT NULL  ,
   IDFILM INTEGER(11) NOT NULL  
   , PRIMARY KEY (IDABONNE,IDFILM) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE LOUER
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_LOUER_ABONNE
     ON LOUER (IDABONNE ASC);

CREATE  INDEX I_FK_LOUER_FILM
     ON LOUER (IDFILM ASC);

# -----------------------------------------------------------------------------
#       TABLE : AIMER
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS AIMER
 (
   IDABONNE INTEGER(11) NOT NULL  ,
   IDFILM INTEGER(11) NOT NULL  
   , PRIMARY KEY (IDABONNE,IDFILM) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE AIMER
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_AIMER_ABONNE
     ON AIMER (IDABONNE ASC);

CREATE  INDEX I_FK_AIMER_FILM
     ON AIMER (IDFILM ASC);


# -----------------------------------------------------------------------------
#       CREATION DES REFERENCES DE TABLE
# -----------------------------------------------------------------------------


ALTER TABLE COMMENTAIRE 
  ADD FOREIGN KEY FK_COMMENTAIRE_COMMENTAIRE (IDCOMMENTAIRE_REPONDRE)
      REFERENCES COMMENTAIRE (IDCOMMENTAIRE) ;


ALTER TABLE FILM 
  ADD FOREIGN KEY FK_FILM_REALISATEUR (IDREALISATEUR)
      REFERENCES REALISATEUR (IDREALISATEUR) ;


ALTER TABLE FILM 
  ADD FOREIGN KEY FK_FILM_THEME (IDGENRE)
      REFERENCES THEME (IDGENRE) ;


ALTER TABLE RECOMMANDER 
  ADD FOREIGN KEY FK_RECOMMANDER_ABONNE (IDABONNE)
      REFERENCES ABONNE (IDABONNE) ;


ALTER TABLE RECOMMANDER 
  ADD FOREIGN KEY FK_RECOMMANDER_FILM (IDFILM)
      REFERENCES FILM (IDFILM) ;


ALTER TABLE RECOMMANDER 
  ADD FOREIGN KEY FK_RECOMMANDER_ABONNE1 (IDABONNE_1)
      REFERENCES ABONNE (IDABONNE) ;


ALTER TABLE JOUER 
  ADD FOREIGN KEY FK_JOUER_FILM (IDFILM)
      REFERENCES FILM (IDFILM) ;


ALTER TABLE JOUER 
  ADD FOREIGN KEY FK_JOUER_ACTEUR (IDACTEUR)
      REFERENCES ACTEUR (IDACTEUR) ;


ALTER TABLE SUIVRE 
  ADD FOREIGN KEY FK_SUIVRE_ABONNE (IDABONNE)
      REFERENCES ABONNE (IDABONNE) ;


ALTER TABLE SUIVRE 
  ADD FOREIGN KEY FK_SUIVRE_ABONNE1 (IDABONNE_1)
      REFERENCES ABONNE (IDABONNE) ;


ALTER TABLE REDIGER 
  ADD FOREIGN KEY FK_REDIGER_ABONNE (IDABONNE)
      REFERENCES ABONNE (IDABONNE) ;


ALTER TABLE REDIGER 
  ADD FOREIGN KEY FK_REDIGER_COMMENTAIRE (IDCOMMENTAIRE)
      REFERENCES COMMENTAIRE (IDCOMMENTAIRE) ;


ALTER TABLE REDIGER 
  ADD FOREIGN KEY FK_REDIGER_FILM (IDFILM)
      REFERENCES FILM (IDFILM) ;


ALTER TABLE LOUER 
  ADD FOREIGN KEY FK_LOUER_ABONNE (IDABONNE)
      REFERENCES ABONNE (IDABONNE) ;


ALTER TABLE LOUER 
  ADD FOREIGN KEY FK_LOUER_FILM (IDFILM)
      REFERENCES FILM (IDFILM) ;


ALTER TABLE AIMER 
  ADD FOREIGN KEY FK_AIMER_ABONNE (IDABONNE)
      REFERENCES ABONNE (IDABONNE) ;


ALTER TABLE AIMER 
  ADD FOREIGN KEY FK_AIMER_FILM (IDFILM)
      REFERENCES FILM (IDFILM) ;

