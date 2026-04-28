<?php include 'config.php'; ?>

<?php
if (isset($_POST['add_link'])) {
  $movie_id = (int) $_POST['movie_id'];
  $actor_id = (int) $_POST['actor_id'];

  $stmt = $conn->prepare("INSERT IGNORE INTO movie_actors (movie_id, actor_id) VALUES (?, ?)");
  $stmt->bind_param("ii", $movie_id, $actor_id);
  $stmt->execute();
  $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Movies & Actors</title>
</head>
<body>

<h1>Movies and Their Actors</h1>

<p><a href="index.php">Back to menu</a></p>

<?php
$sql = "
SELECT m.title, a.first, a.last
FROM movies m
JOIN movie_actors ma ON m.movieid = ma.movie_id
JOIN actors a ON ma.actor_id = a.actorid
ORDER BY m.title, a.last, a.first
";

$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    echo "<p>" . htmlspecialchars($row["title"]) . " - " . htmlspecialchars($row["first"] . " " . $row["last"]) . "</p>";
  }
} else {
  echo "<p>No movie/actor relationships found.</p>";
}
?>

<hr>

<h2>Associate Actor to Movie</h2>

<form method="POST">
  Movie:
  <select name="movie_id" required>
    <option value="">Choose a movie</option>
    <?php
    $movies = $conn->query("SELECT movieid, title, year FROM movies ORDER BY title");
    if ($movies) {
      while ($movie = $movies->fetch_assoc()) {
        echo '<option value="' . (int) $movie['movieid'] . '">' .
          htmlspecialchars($movie['title'] . ' (' . $movie['year'] . ')') .
          '</option>';
      }
    }
    ?>
  </select>

  Actor:
  <select name="actor_id" required>
    <option value="">Choose an actor</option>
    <?php
    $actors = $conn->query("SELECT actorid, first, last FROM actors ORDER BY last, first");
    if ($actors) {
      while ($actor = $actors->fetch_assoc()) {
        echo '<option value="' . (int) $actor['actorid'] . '">' .
          htmlspecialchars($actor['first'] . ' ' . $actor['last']) .
          '</option>';
      }
    }
    ?>
  </select>

  <input type="submit" name="add_link" value="Associate">
</form>

</body>
</html>
