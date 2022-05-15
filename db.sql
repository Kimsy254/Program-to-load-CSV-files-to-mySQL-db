

CREATE TABLE IF NOT EXISTS `members` 
(
   `id` int(20) NOT NULL AUTO_INCREMENT,
   `name` varchar(50) NOT NULL,
   `email` varchar(50) NOT NULL,
   `phone` varchar(10) NOT NULL,
    PRIMARY KEY (`id`)
   )