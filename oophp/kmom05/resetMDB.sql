DROP VIEW IF EXISTS VMovie;
DROP TABLE IF EXISTS Movie2Genre;
DROP TABLE IF EXISTS Genre;
DROP TABLE IF EXISTS Movie;

CREATE TABLE Movie
(
  Id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
  Title VARCHAR(100) NOT NULL,
  Year INT NOT NULL DEFAULT 1900,
  Image VARCHAR(100) DEFAULT NULL
) ENGINE INNODB CHARACTER SET utf8;
 
SHOW CHARACTER SET;
SHOW COLLATION LIKE 'utf8%';
 
DELETE FROM Movie;
 
INSERT INTO Movie (title, YEAR, image) VALUES
  ('Pulp fiction', 1994, 'img/movie/pulp-fiction.jpg'),
  ('American Pie', 1999, 'img/movie/american-pie.jpg'),
  ('Kopps', 2003, 'img/movie/kopps.jpg'),
  ('From Dusk Till Dawn', 1996, 'img/movie/from-dusk-till-dawn.jpg'),
  ('The Shawshank Redemption', 1994, 'img/movie/the-shawshank-redemption.jpg'),
  ('The Godfather', 1972, 'img/movie/the-godfather.jpg'),
  ('The Dark Knight', 2008, 'img/movie/the-dark-knight.jpg'),
  ('12 Angry Men', 1957, 'img/movie/12-angry-men.jpg'),
  ('Fight Club', 1999, 'img/movie/fight-club.jpg'),
  ('Inception', 2010, 'img/movie/inception.jpg'),
  ('Forrest Gump', 1994, 'img/movie/forrest-gump.jpg'),
  ('Goodfellas', 1990, 'img/movie/goodfellas.jpg'),
  ('The Matrix', 1999, 'img/movie/the-matrix.jpg'),
  ('Seven Samurai', 1954, 'img/movie/seven-samurai.jpg'),
  ('Se7en', 1995, 'img/movie/se7en.jpg'),
  ('Casablanca', 1942, 'img/movie/casablanca.jpg'),
  ('American History X', 1998, 'img/movie/american-history-x.jpg'),
  ('Psycho', 1960, 'img/movie/psycho.jpg'),
  ('Saving Private Ryan', 1998, 'img/movie/saving-private-ryan.jpg'),
  ('Memento', 2000, 'img/movie/memento.jpg')
;

CREATE TABLE Genre
(
  id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
  name CHAR(20) NOT NULL -- crime, svenskt, college, drama, etc
) ENGINE INNODB CHARACTER SET utf8;
 
INSERT INTO Genre (name) VALUES 
  ('comedy'), ('romance'), ('college'), 
  ('crime'), ('drama'), ('thriller'), 
  ('animation'), ('adventure'), ('family'), 
  ('svenskt'), ('action'), ('horror'),
  ('mystery'), ('sci-fi'), ('biography'),
  ('war')
;
 
CREATE TABLE Movie2Genre
(
  idMovie INT NOT NULL,
  idGenre INT NOT NULL,
 
  FOREIGN KEY (idMovie) REFERENCES Movie (id),
  FOREIGN KEY (idGenre) REFERENCES Genre (id),
 
  PRIMARY KEY (idMovie, idGenre)
) ENGINE INNODB;
 
 
INSERT INTO Movie2Genre (idMovie, idGenre) VALUES
  (1, 1),
  (1, 5),
  (1, 6),
  (2, 1),
  (2, 2),
  (2, 3),
  (3, 11),
  (3, 1),
  (3, 10),
  (3, 9),
  (4, 11),
  (4, 4),
  (4, 12),
  (5, 4),
  (5, 5),
  (6, 4),
  (6, 5),
  (7, 11),
  (7, 8),
  (8, 5),
  (9, 5),
  (10, 11),
  (10, 13),
  (10, 14),
  (11, 5),
  (11, 2),
  (12, 15),
  (12, 4),
  (12, 5),
  (13, 11),
  (13, 14),
  (14, 11),
  (14, 5),
  (15, 5),
  (15, 13),
  (15, 6),
  (16, 5),
  (16, 2),
  (16, 16),
  (17, 4),
  (17, 5),
  (18, 12),
  (18, 13),
  (18, 6),
  (19, 11),
  (19, 5),
  (19, 16),
  (20, 13),
  (20, 6)
;
 
CREATE VIEW VMovie
AS
SELECT 
  M.*,
  GROUP_CONCAT(G.name) AS Genre
FROM Movie AS M
  LEFT OUTER JOIN Movie2Genre AS M2G
    ON M.id = M2G.idMovie
  LEFT OUTER JOIN Genre AS G
    ON M2G.idGenre = G.id
GROUP BY M.id
;