<?php include 'config.php'; ?>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = $_POST['name'];
  $comment = $_POST['comment'];

  $stmt = $conn->prepare("INSERT INTO guestbook (name, comment) VALUES (?, ?)");
  $stmt->bind_param("ss", $name, $comment);
  $stmt->execute();
  $stmt->close();

  if (isset($_POST['ajax'])) {
    exit();
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Guestbook</title>
  <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
</head>
<body>

<h1>Guestbook</h1>

<div id="entries">
<?php
$sql = "SELECT name, comment, created_at FROM guestbook ORDER BY created_at DESC";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
  echo "<p><strong>"
    . htmlspecialchars($row["name"], ENT_QUOTES, 'UTF-8')
    . "</strong>: "
    . nl2br(htmlspecialchars($row["comment"], ENT_QUOTES, 'UTF-8'))
    . "<br><small>" . $row["created_at"] . "</small></p><hr>";
}
?>
</div>

<h2>Leave a Message</h2>

<p id="message"></p>

<form id="guestbookForm">
  Name: <input type="text" id="name"><br><br>
  Comment:<br>
  <textarea id="comment" rows="4" cols="40"></textarea><br>
  <p id="charCount">0 / 200</p><br>
  <button type="submit">Post</button>
</form>

<script>
const commentBox = document.getElementById("comment");
const charCount = document.getElementById("charCount");

commentBox.addEventListener("input", function() {
  let len = commentBox.value.length;
  charCount.textContent = len + " / 200";
});

$("#guestbookForm").submit(function(e) {
  e.preventDefault();

  let name = $("#name").val().trim();
  let comment = $("#comment").val().trim();

  if (name === "" || comment === "") {
    $("#message").css("color","red").text("Fill out all fields.");
    return;
  }

  $.ajax({
    url: "guestbook.php",
    method: "POST",
    data: { ajax: true, name: name, comment: comment },
    success: function() {
      $("#message").css("color","green").text("Message added!");
      $("#name").val("");
      $("#comment").val("");
      $("#entries").load("guestbook.php #entries > *");
    }
  });
});
</script>

</body>
</html>