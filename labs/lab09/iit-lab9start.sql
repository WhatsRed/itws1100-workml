CREATE DATABASE IF NOT EXISTS iit CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE iit;

SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS movie_actors;
DROP TABLE IF EXISTS actors;
DROP TABLE IF EXISTS movies;

SET FOREIGN_KEY_CHECKS = 1;

CREATE TABLE movies (
  movieid INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255) NOT NULL,
  year INT NOT NULL
);

CREATE TABLE actors (
  actorid INT AUTO_INCREMENT PRIMARY KEY,
  first VARCHAR(100) NOT NULL,
  last VARCHAR(100) NOT NULL,
  dob DATE NOT NULL
);

CREATE TABLE movie_actors (
  movie_id INT NOT NULL,
  actor_id INT NOT NULL,
  PRIMARY KEY (movie_id, actor_id),
  FOREIGN KEY (movie_id) REFERENCES movies(movieid) ON DELETE CASCADE,
  FOREIGN KEY (actor_id) REFERENCES actors(actorid) ON DELETE CASCADE
);

INSERT INTO movies (title, year) VALUES
('Training Day', 2001),
('The Matrix', 1999),
('Alien', 1979),
('Pulp Fiction', 1994),
('Fences', 2016);

INSERT INTO actors (first, last, dob) VALUES
('Denzel', 'Washington', '1954-12-28'),
('Viola', 'Davis', '1965-08-11'),
('Keanu', 'Reeves', '1964-09-02'),
('Sigourney', 'Weaver', '1949-10-08'),
('Samuel', 'Jackson', '1948-12-21');

INSERT INTO movie_actors (movie_id, actor_id) VALUES
(1, 1),
(2, 3),
(3, 4),
(4, 5),
(5, 2);
