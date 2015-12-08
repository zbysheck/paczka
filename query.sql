CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL auto_increment,
  `name` char(255) NOT NULL,
  `mail` char(255) NOT NULL,
  `phone` char(255) NOT NULL,
  `hash` char(255) NOT NULL,
  `anonymous` char(255) NOT NULL,
  `admin` char(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

INSERT INTO `user` (`id`, `name`, `mail`, `phone`, `hash`, `anonymous`, `admin`) VALUES
(1, "zbysio", "zbyshekh@gmail.com", "883878197", "xxx", "no", "yes"),
(2, "zbyszek", "zbyshekh2@gmail.com", "883878191", "xdr", "no", "yes"),
(3, "Ania Lipska", "zbyshekh2@gmail.com", "883878191", "xdf", "no", "yes"),
(4, "Jan Kowalski", "jkowal@gmail.com", "666666666", "jok", "no", "no");


CREATE TABLE IF NOT EXISTS `need` (
  `id` int(11) NOT NULL auto_increment,
  `opis` char(255) NOT NULL,
  `kolor` char(255) NOT NULL,
  `status` char(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

INSERT INTO `need` (`id`, `opis`, `kolor`, `status`) VALUES
(1, "jedzenie", "red", "gotowe"),
(2, "zabawki", "blue", "część"),
(3, "węgiel", "red", "zbieramy");


CREATE TABLE IF NOT EXISTS `gift` (
  `id` int(11) NOT NULL auto_increment,
  `need_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `uwagi` text(2555) NOT NULL,
  `newest` char(255) NOT NULL,
  `approved` char(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

INSERT INTO `gift` (`id`, `need_id`, `user_id`, `uwagi`, `newest`, `approved`) VALUES
(1, 1, 1, "2kg makaronu", "1", "1"),
(2, 1, 3, "kawa i słodycze", "1", "1"),
(3, 2, 3, "lalka i samochodzik", "1", "1");