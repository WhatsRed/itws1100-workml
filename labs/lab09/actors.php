<?php
include 'config.php';

if (isset($_POST['add_actor'])) {
    $first = trim($_POST['first']);
    $last = trim($_POST['last']);
    $dob = $_POST['dob'];

    $stmt = $conn->prepare("INSERT INTO actors (first, last, dob) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $first, $last, $dob);
    $stmt->execute();
    $stmt->close();
}

if (isset($_POST['delete_actor'])) {
    $actorid = (int) $_POST['actorid'];

    $stmt = $conn->prepare("DELETE FROM actors WHERE actorid = ?");
    $stmt->bind_param("i", $actorid);
    $stmt->execute();
    $stmt->close();
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Actors</title>
</head>
<body>

<h1>Actors</h1>

<p><a href="index.php">Back to menu</a></p>

<?php
$result = $conn->query("SELECT actorid, first, last, dob FROM actors ORDER BY last, first");

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        ?>
        <form method="POST">
          <p>
            <?php echo htmlspecialchars($row['first'] . ' ' . $row['last']); ?>
            -
            <?php echo htmlspecialchars($row['dob']); ?>
            <input type="hidden" name="actorid" value="<?php echo (int) $row['actorid']; ?>">
            <input type="submit" name="delete_actor" value="Delete">
          </p>
        </form>
        <?php
    }
} else {
    echo "<p>No actors found.</p>";
}
?>

<hr>

<h2>Add Actor</h2>

<form method="POST">
  First: <input type="text" name="first" required>
  Last: <input type="text" name="last" required>
  DOB: <input type="date" name="dob" required>
  <input type="submit" name="add_actor" value="Add Actor">
</form>

</body>
</html>
