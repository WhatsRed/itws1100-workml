<?php include 'config.php'; ?>

<?php
if (isset($_POST['add_movie'])) {
  $title = trim($_POST['title']);
  $year = (int) $_POST['year'];

  $stmt = $conn->prepare("INSERT INTO movies (title, year) VALUES (?, ?)");
  $stmt->bind_param("si", $title, $year);
  $stmt->execute();
  $stmt->close();
}

if (isset($_POST['delete_movie'])) {
  $movieid = (int) $_POST['movieid'];

  $stmt = $conn->prepare("DELETE FROM movies WHERE movieid = ?");
  $stmt->bind_param("i", $movieid);
  $stmt->execute();
  $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Movies</title>
</head>
<body>

<h1>Movies</h1>

<p><a href="index.php">Back to menu</a></p>

<?php
// READ (display movies)
$sql = "SELECT movieid, title, year FROM movies ORDER BY title";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    ?>
    <form method="POST">
      <p>
        <?php echo htmlspecialchars($row["title"]); ?> (<?php echo htmlspecialchars($row["year"]); ?>)
        <input type="hidden" name="movieid" value="<?php echo (int) $row["movieid"]; ?>">
        <input type="submit" name="delete_movie" value="Delete">
      </p>
    </form>
    <?php
  }
} else {
  echo "<p>No movies found.</p>";
}
?>

<hr>

<h2>Add Movie</h2>

<form method="POST">
  Title: <input type="text" name="title" required>
  Year: <input type="number" name="year" required>
  <input type="submit" name="add_movie" value="Add Movie">
</form>

</body>
</html>
