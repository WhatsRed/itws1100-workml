<?php
include 'config.php';

header('Content-Type: text/csv');
header('Content-Disposition: attachment;filename=actors.csv');

$output = fopen("php://output", "w");

fputcsv($output, ['First', 'Last', 'DOB']);

// Export actors born on or after January 1, 1960.
$sql = "SELECT first, last, dob FROM actors WHERE dob >= '1960-01-01' ORDER BY dob, last, first";
$result = $conn->query($sql);

if ($result) {
    while ($row = $result->fetch_assoc()) {
        fputcsv($output, $row);
    }
}

fclose($output);
?>
