CREATE TABLE IF NOT EXISTS `elements`
(
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(100),
  `accent_color` varchar(10),
  `second_color` varchar(10),
  PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `tabs`
(
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100),
  `content` text,
  `element_id` int,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`element_id`) REFERENCES `elements`(`id`) ON DELETE SET NULL
);