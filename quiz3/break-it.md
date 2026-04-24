1:  
$name \= $\_POST\['name'\];  
$comment \= $\_POST\['comment'\];

$sql \= "INSERT INTO guestbook (name, comment) VALUES ('$name', '$comment')";  
$conn-\>query($sql);

If a user enters this in the name field, such as \['); DROP TABLE guestbook; \--\], then The SQL query becomes:

INSERT INTO guestbook (name, comment) VALUES ('' ); DROP TABLE guestbook; \--', 'hello')

This can allow the user to execute multiple SQL commands, delete the entire guestbook table, and even permanently remove all data. The safe version of this code would be:

$stmt \= $conn-\>prepare("INSERT INTO guestbook (name, comment) VALUES (?, ?)");  
$stmt-\>bind\_param("ss", $name, $comment);  
$stmt-\>execute();

This can prevent attacks because the query structure is fixed \[VALUES (?, ?)\].the user input is also just treated strictly as data, and not SQL code, preventing SQL injections. This causes malicious inputs to be stored as plain text instead of being executed.

2:

Bad code:  
echo "\<p\>\<strong\>" . $row\["name"\] . "\</strong\>: " . $row\["comment"\] . "\</p\>";

If the user submits something like \[\<script\>alert('hacked')\</script\>\], the browser will execute the script and a popup appears saying “hacked”. If it were a real attack, this could steal cookies, redirect users to malicious sites, inject malicious content into the site, and much more. The safe version of this code would be:

echo "\<p\>\<strong\>"  
. htmlspecialchars($row\["name"\], ENT\_QUOTES, 'UTF-8')  
. "\</strong\>: "  
. nl2br(htmlspecialchars($row\["comment"\], ENT\_QUOTES, 'UTF-8'))  
. "\</p\>";

This works because \[htmlspecialchars()\] converts \< into \&lt; and \> into \&gt;. Now the script is displayed as text rather than executed. ENT\_QUOTES also protects against quote-based injections  
