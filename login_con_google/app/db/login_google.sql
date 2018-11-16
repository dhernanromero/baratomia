CREATE TABLE usuario_google (
 id int unsigned  AUTO_INCREMENT,
 id_google varchar(100) COLLATE utf8_unicode_ci NOT NULL,
 email varchar(100) COLLATE utf8_unicode_ci NOT NULL,

 PRIMARY KEY (id),
 UNIQUE KEY email (email)
 
) ENGINE=MyIsam  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
