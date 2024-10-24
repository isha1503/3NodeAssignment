<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST");
header("Access-Control-Allow-Headers: Content-Type");

$books = [
    ['id' => 1, 'title' => '1984', 'author' => 'George Orwell', 'year' => 1949],
    ['id' => 2, 'title' => 'To Kill a Mockingbird', 'author' => 'Harper Lee', 'year' => 1960],
    ['id' => 3, 'title' => 'The Great Gatsby', 'author' => 'F. Scott Fitzgerald', 'year' => 1925],
];

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    echo json_encode($books);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    $newBook = [
        'id' => count($books) + 1,
        'title' => $data['title'],
        'author' => $data['author'],
        'year' => $data['year']
    ];
    echo json_encode(['message' => 'Book added', 'book' => $newBook]);
    exit();
}

http_response_code(405);
echo json_encode(['message' => 'Method not allowed']);
?>