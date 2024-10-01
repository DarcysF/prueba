<?php
session_start();
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// Configuración de la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dbvirtualbiblioteca";


// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Función para manejar las solicitudes GET
function handleGet($conn) {
    $route = $_GET['route'] ?? '';

    switch ($route) {
        case 'books':
            $sql = "SELECT * FROM books";
            $result = $conn->query($sql);
            $books = [];
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $books[] = $row;
                }
            }
            echo json_encode($books);
            break;

        case 'book':
            $id = $_GET['id'] ?? '';
            if ($id) {
                $sql = "SELECT * FROM books WHERE id_book = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $id);
                $stmt->execute();
                $result = $stmt->get_result();
                if ($result->num_rows > 0) {
                    echo json_encode($result->fetch_assoc());
                } else {
                    echo json_encode(["error" => "Libro no encontrado"]);
                }
                $stmt->close();
            } else {
                echo json_encode(["error" => "ID de libro no proporcionado"]);
            }
            break;

        case 'authors':
            $sql = "SELECT * FROM authors";
            $result = $conn->query($sql);
            $authors = [];
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $authors[] = $row;
                }
            }
            echo json_encode($authors);
            break;

        case 'genres':
            $sql = "SELECT * FROM geners";
            $result = $conn->query($sql);
            $genres = [];
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $genres[] = $row;
                }
            }
            echo json_encode($genres);
            break;

        case 'get_cart':
            echo json_encode(["success" => true, "cart" => $_SESSION['cart'] ?? []]);
            break;

        default:
            echo json_encode(["error" => "Ruta no encontrada"]);
            break;
    }
}

// Función para manejar las solicitudes POST
function handlePost($conn) {
    $route = $_GET['route'] ?? '';

    switch ($route) {
        case 'toggle_favorite':
            $bookId = $_GET['id'] ?? '';
            if ($bookId) {
                // Aquí deberías implementar la lógica para alternar el estado de favorito
                // Por ahora, simplemente devolvemos un éxito simulado
                echo json_encode(["success" => true]);
            } else {
                echo json_encode(["error" => "ID de libro no proporcionado"]);
            }
            break;

        case 'add_to_cart':
            $bookId = $_GET['id'] ?? '';
            if ($bookId) {
                $sql = "SELECT id_book, name_book, price_book FROM books WHERE id_book = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $bookId);
                $stmt->execute();
                $result = $stmt->get_result();
                if ($result->num_rows > 0) {
                    $book = $result->fetch_assoc();
                    if (!isset($_SESSION['cart'])) {
                        $_SESSION['cart'] = [];
                    }
                    $found = false;
                    foreach ($_SESSION['cart'] as &$item) {
                        if ($item['id'] == $book['id_book']) {
                            $item['quantity']++;
                            $found = true;
                            break;
                        }
                    }
                    if (!$found) {
                        $_SESSION['cart'][] = [
                            'id' => $book['id_book'],
                            'name' => $book['name_book'],
                            'price' => $book['price_book'],
                            'quantity' => 1
                        ];
                    }
                    echo json_encode(["success" => true, "cart" => $_SESSION['cart']]);
                } else {
                    echo json_encode(["error" => "Libro no encontrado"]);
                }
                $stmt->close();
            } else {
                echo json_encode(["error" => "ID de libro no proporcionado"]);
            }
            break;

        case 'remove_from_cart':
            $bookId = $_GET['id'] ?? '';
            if ($bookId) {
                if (isset($_SESSION['cart'])) {
                    foreach ($_SESSION['cart'] as $key => $item) {
                        if ($item['id'] == $bookId) {
                            unset($_SESSION['cart'][$key]);
                            break;
                        }
                    }
                    $_SESSION['cart'] = array_values($_SESSION['cart']); // Reindexar el array
                }
                echo json_encode(["success" => true, "cart" => $_SESSION['cart']]);
            } else {
                echo json_encode(["error" => "ID de libro no proporcionado"]);
            }
            break;

        case 'checkout':
            // Aquí deberías implementar la lógica para procesar la compra
            // Por ahora, simplemente vaciamos el carrito
            $_SESSION['cart'] = [];
            echo json_encode(["success" => true]);
            break;

        default:
            echo json_encode(["error" => "Ruta no encontrada"]);
            break;
    }
}

// Manejar solicitudes GET y POST
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    handleGet($conn);
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    handlePost($conn);
}

$conn->close();
?>