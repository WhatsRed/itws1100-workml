CREATE TABLE IF NOT EXISTS actors (
  actorid INT AUTO_INCREMENT PRIMARY KEY,
  first VARCHAR(100) NOT NULL,
  last VARCHAR(100) NOT NULL,
  dob DATE NOT NULL
);

INSERT INTO actors (first, last, dob) VALUES
('Denzel', 'Washington', '1954-12-28'),
('Viola', 'Davis', '1965-08-11'),
('Keanu', 'Reeves', '1964-09-02'),
('Sigourney', 'Weaver', '1949-10-08'),
('Samuel', 'Jackson', '1948-12-21');

CREATE TABLE IF NOT EXISTS movie_actors (
  movie_id INT NOT NULL,
  actor_id INT NOT NULL,
  PRIMARY KEY (movie_id, actor_id),
  FOREIGN KEY (movie_id) REFERENCES movies(movieid) ON DELETE CASCADE,
  FOREIGN KEY (actor_id) REFERENCES actors(actorid) ON DELETE CASCADE
);
