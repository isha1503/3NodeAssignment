<?php
$host = 'localhost';
$dbname = 'demodb';
$username = 'root';
$password = '';

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$xml = simplexml_load_file('students.xml') or die("Error: Cannot create object");

$sql = "INSERT INTO students (name, age, grade) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
}

$stmt->bind_param("sis", $name, $age, $grade);

foreach ($xml->student as $student) {
    $name = $student->name;
    $age = (int)$student->age;
    $grade = $student->grade;

    if (!$stmt->execute()) {
        echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
    }
}

$stmt->close();
$conn->close();

echo "Data successfully imported from XML!";
?>