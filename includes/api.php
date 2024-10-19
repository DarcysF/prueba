<?php
    require_once __DIR__ . '/MyDatabase.php';

    session_start(); // Asegúrate de iniciar la sesión

    class User
    {
        private $db;
        
        public function __construct()
        {
            $this->db = new MyDatabase();
        }

        // Función para manejar las solicitudes GET
        public function handleGet() {
            $conn = $this->db->getPDO(); // Obtén la conexión PDO
            $route = $_GET['route'] ?? '';

            switch ($route) {
                case 'books':
                    $sql = "SELECT * FROM books";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute();
                    $books = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    echo json_encode($books);
                    break;

                case 'book':
                    $id = $_GET['id'] ?? '';
                    if ($id) {
                        $sql = "SELECT * FROM books WHERE id_book = :id_book";
                        $stmt = $conn->prepare($sql);
                        $stmt->bindParam(':id_book', $id, PDO::PARAM_INT);
                        $stmt->execute();
                        $book = $stmt->fetch(PDO::FETCH_ASSOC);
                        if ($book) {
                            echo json_encode($book);
                        } else {
                            echo json_encode(["error" => "Libro no encontrado"]);
                        }
                    } else {
                        echo json_encode(["error" => "ID de libro no proporcionado"]);
                    }
                    break;

                case 'authors':
                    $sql = "SELECT * FROM authors";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute();
                    $authors = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    echo json_encode($authors);
                    break;

                case 'genres':
                    $sql = "SELECT * FROM genres"; // Corrige el nombre de la tabla
                    $stmt = $conn->prepare($sql);
                    $stmt->execute();
                    $genres = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
        public function handlePost() {
            $conn = $this->db->getPDO(); // Obtén la conexión PDO
            $route = $_GET['route'] ?? '';

            switch ($route) {
                case 'toggle_favorite':
                    $bookId = $_GET['id'] ?? '';
                    if ($bookId) {
                        // Implementa la lógica para alternar el estado de favorito
                        echo json_encode(["success" => true]);
                    } else {
                        echo json_encode(["error" => "ID de libro no proporcionado"]);
                    }
                    break;

                case 'add_to_cart':
                    $bookId = $_GET['id'] ?? '';
                    if ($bookId) {
                        $sql = "SELECT id_book, name_book, price_book FROM books WHERE id_book = :id_book";
                        $stmt = $conn->prepare($sql);
                        $stmt->bindParam(':id_book', $bookId, PDO::PARAM_INT);
                        $stmt->execute();
                        $book = $stmt->fetch(PDO::FETCH_ASSOC);
                        if ($book) {
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
                    // Implementa la lógica para procesar la compra
                    $_SESSION['cart'] = [];
                    echo json_encode(["success" => true]);
                    break;

                default:
                    echo json_encode(["error" => "Ruta no encontrada"]);
                    break;
            }
        }
    }

    // Crear una instancia de la clase User
    $user = new User();

    // Manejar solicitudes GET y POST
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $user->handleGet();
    } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $user->handlePost();
    }

    ?>
