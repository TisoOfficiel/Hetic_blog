
CREATE TABLE `Users` (
        `id` INT NOT NULL AUTO_INCREMENT,
        `firstName` VARCHAR(40),
        `lastName` VARCHAR (40),
        `login` VARCHAR(30) NOT NULL UNIQUE ,
        `role` ENUM('user','admin'),
        `password` VARCHAR(100) NOT NULL,
        `created_at` datetime, 
        `updated_at` datetime, 
        PRIMARY KEY(id)
);
CREATE TABLE `Tweets`(
        `id` INT NOT NULL AUTO_INCREMENT,
        `user_id` INT NOT NULL,
        `author` VARCHAR(30) NOT NULL,
        `content` text NOT NULL,
        `created_at` datetime,
        `updated_at` datetime,
        FOREIGN KEY(`user_id`) REFERENCES `Users`(`id`),
        PRIMARY KEY (id)
);
INSERT INTO `Users` (`firstName`,`lastName`,`login`,`role`,`password`,`created_at`,`updated_at`) VALUES ('ADMIN','ADMIN','admin','admin','$2y$10$OgGilVcpTrARPRsrx8YZf.GRCGW3EAugei7htlwYaGDdbROVRY2pu','2022-10-16 17:15:10','2022-10-16 17:15:10');



