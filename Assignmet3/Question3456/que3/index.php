<?php
$host = 'localhost';
$dbname = 'demodb';
$username = 'root';
$password = '';

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT name, age, grade FROM students";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $dom = new DOMDocument('1.0', 'UTF-8');
    
    $studentsElement = $dom->createElement('students');
    $dom->appendChild($studentsElement);
    
    while ($row = $result->fetch_assoc()) {
        $studentElement = $dom->createElement('student');
        
        $nameElement = $dom->createElement('name', htmlspecialchars($row['name']));
        $studentElement->appendChild($nameElement);
        
        $ageElement = $dom->createElement('age', $row['age']);
        $studentElement->appendChild($ageElement);
        
        $gradeElement = $dom->createElement('grade', htmlspecialchars($row['grade']));
        $studentElement->appendChild($gradeElement);
        
        $studentsElement->appendChild($studentElement);
    }
    
    $dom->formatOutput = true;
    $dom->save('students.xml');
    
    echo "Data successfully exported to students.xml!";
} else {
    echo "No data found in the students table.";
}

$conn->close();
?>