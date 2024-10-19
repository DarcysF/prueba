// Configuración de la URL base de la API
const API_BASE_URL = 'http://localhost/prueba/includes/api.php';

// Variables globales
let favorites = [];
let cart = [];

// Función para obtener todos los libros
async function fetchBooks() {
    try {
        const response = await fetch(`${API_BASE_URL}?route=books`);
        const books = await response.json();
        renderBooks(books);
    } catch (error) {
        console.error('Error al obtener los libros:', error);
    }
}

// Función para obtener todos los autores
async function fetchAuthors() {
    try {
        const response = await fetch(`${API_BASE_URL}?route=authors`);
        const authors = await response.json();
        populateAuthorFilter(authors);
    } catch (error) {
        console.error('Error al obtener los autores:', error);
    }
}

// Función para obtener todos los géneros
async function fetchGenres() {
    try {
        const response = await fetch(`${API_BASE_URL}?route=genres`);
        const genres = await response.json();
        populateGenreFilter(genres);
    } catch (error) {
        console.error('Error al obtener los géneros:', error);
    }
}

// Función para poblar el filtro de autores
function populateAuthorFilter(authors) {
    const authorFilter = document.getElementById('filter-author');
    authorFilter.innerHTML = '<option value="">Todos los autores</option>';
    authors.forEach(author => {
        const option = document.createElement('option');
        option.value = author.id_author;
        option.textContent = author.name_author;
        authorFilter.appendChild(option);
    });
}

// Función para poblar el filtro de géneros
function populateGenreFilter(genres) {
    const genreFilter = document.getElementById('filter-genre');
    genreFilter.innerHTML = '<option value="">Todos los géneros</option>';
    genres.forEach(genre => {
        const option = document.createElement('option');
        option.value = genre.id_gener;
        option.textContent = genre.name_gener;
        genreFilter.appendChild(option);
    });
}

// Función para renderizar los libros
function renderBooks(books) {
    const content = document.getElementById('content');
    content.innerHTML = '';
    books.forEach(book => {
        const bookElement = document.createElement('div');
        bookElement.className = 'card';
        bookElement.innerHTML = `
            <img src="${book.imagen_book || 'https://via.placeholder.com/150'}" alt="${book.name_book}">
            <h3>${book.name_book}</h3>
            <p>Precio: $${parseFloat(book.price_book).toFixed(2)}</p>
            <p>Año: ${new Date(book.year_book).getFullYear()}</p>
            <p>Calificación: ${book.rate_book}</p>
            <button onclick="showBookDetails(${book.id_book})">Ver detalles</button>
            <button class="favorite-button ${favorites.includes(book.id_book) ? 'active' : ''}" onclick="toggleFavorite(${book.id_book})">
                ${favorites.includes(book.id_book) ? 'Quitar de favoritos' : 'Agregar a favoritos'}
            </button>
            <button class="add-to-cart-button" onclick="addToCart(${book.id_book})">Agregar al carrito</button>
        `;
        content.appendChild(bookElement);
    });
}

// Función para mostrar detalles del libro
async function showBookDetails(bookId) {
    try {
        const response = await fetch(`${API_BASE_URL}?route=book&id=${bookId}`);
        const book = await response.json();
        const modalContent = document.getElementById('modal-content');
        modalContent.innerHTML = `
            <h2>${book.name_book}</h2>
            <p><strong>Precio:</strong> $${parseFloat(book.price_book).toFixed(2)}</p>
            <p><strong>Año:</strong> ${new Date(book.year_book).getFullYear()}</p>
            <p><strong>Calificación:</strong> ${book.rate_book}</p>
            <p><strong>Descripción:</strong> ${book.description_book}</p>
            <button class="favorite-button ${favorites.includes(book.id_book) ? 'active' : ''}" onclick="toggleFavorite(${book.id_book})">
                ${favorites.includes(book.id_book) ? 'Quitar de favoritos' : 'Agregar a favoritos'}
            </button>
            <button class="add-to-cart-button" onclick="addToCart(${book.id_book})">Agregar al carrito</button>
        `;
        document.getElementById('modal').style.display = 'block';
    } catch (error) {
        console.error('Error al obtener los detalles del libro:', error);
    }
}

// Función para cerrar los modales
document.querySelectorAll('.close').forEach(closeButton => {
    closeButton.onclick = function() {
        this.closest('.modal').style.display = 'none';
    }
});

// Función para alternar favoritos
async function toggleFavorite(bookId) {
    try {
        const response = await fetch(`${API_BASE_URL}?route=toggle_favorite&id=${bookId}`, { method: 'POST' });
        const result = await response.json();
        if (result.success) {
            if (favorites.includes(bookId)) {
                favorites = favorites.filter(id => id !== bookId);
            } else {
                favorites.push(bookId);
            }
            fetchBooks(); // Actualizar la vista de libros
        }
    } catch (error) {
        console.error('Error al alternar favorito:', error);
    }
}

// Función para agregar al carrito
async function addToCart(bookId) {
    try {
        const response = await fetch(`${API_BASE_URL}?route=add_to_cart&id=${bookId}`, { method: 'POST' });
        const result = await response.json();
        if (result.success) {
            cart = result.cart;
            updateCartCount();
            alert('Libro añadido al carrito');
        } else {
            alert('Error al añadir el libro al carrito');
        }
    } catch (error) {
        console.error('Error al añadir al carrito:', error);
    }
}

// Función para actualizar el contador del carrito
function updateCartCount() {
    const cartCount = document.getElementById('cart-count');
    const totalItems = cart.reduce((total, item) => total + item.quantity, 0);
    cartCount.textContent = totalItems;
}

// Función para actualizar el contenido del carrito
async function updateCartContent() {
    try {
        const response = await fetch(`${API_BASE_URL}?route=get_cart`);
        const result = await response.json();
        if (result.success) {
            cart = result.cart;
            const cartItems = document.getElementById('cart-items');
            cartItems.innerHTML = '';
            let total = 0;

            cart.forEach(item => {
                const itemTotal = item.price * item.quantity;
                total += itemTotal;

                const cartItem = document.createElement('div');
                cartItem.className = 'cart-item';
                cartItem.innerHTML = `
                    <span>${item.name} (x${item.quantity})</span>
                    <span>$${itemTotal.toFixed(2)}</span>
                    <span class="cart-item-remove" onclick="removeFromCart(${item.id})">X</span>
                `;
                cartItems.appendChild(cartItem);
            });

            document.getElementById('cart-total').textContent = total.toFixed(2);
        } else {
            console.error('Error al obtener el carrito:', result.error);
        }
    } catch (error) {
        console.error('Error al actualizar el contenido del carrito:', error);
    }
}

// Función para remover del carrito
async function removeFromCart(bookId) {
    try {
        const response = await fetch(`${API_BASE_URL}?route=remove_from_cart&id=${bookId}`, { method: 'POST' });
        const result = await response.json();
        if (result.success) {
            cart = result.cart;
            updateCartCount();
            updateCartContent();
        } else {
            alert('Error al remover el libro del carrito');
        }
    } catch (error) {
        console.error('Error al remover del carrito:', error);
    }
}

// Función para realizar la compra
async function checkout() {
    try {
        const response = await fetch(`${API_BASE_URL}?route=checkout`, { method: 'POST' });
        const result = await response.json();
        if (result.success) {
            alert('Compra realizada con éxito!');
            cart = [];
            updateCartCount();
            updateCartContent();
            document.getElementById('cart-modal').style.display = 'none';
        } else {
            alert('Error al realizar la compra');
        }
    } catch (error) {
        console.error('Error al realizar la compra:', error);
    }
}

// Event listener para el botón de checkout
document.getElementById('checkout-button').addEventListener('click', checkout);

// Llamar a las funciones de fetch al cargar la página
document.addEventListener('DOMContentLoaded', () => {
    fetchBooks();
    fetchAuthors();
    fetchGenres();
    updateCartCount();
});

// Event listeners para la navegación
document.getElementById('nav-books').addEventListener('click', fetchBooks);
document.getElementById('nav-authors').addEventListener('click', () => {
    // Implementar la vista de autores
});
document.getElementById('nav-genres').addEventListener('click', () => {
    // Implementar la vista de géneros
});
document.getElementById('nav-users').addEventListener('click', () => {
    // Implementar la vista de usuarios
});
document.getElementById('nav-favorites').addEventListener('click', () => {
    // Implementar la vista de favoritos
});
document.getElementById('nav-cart').addEventListener('click', () => {
    updateCartContent();
    document.getElementById('cart-modal').style.display = 'block';
});

// Event listeners para los filtros
document.getElementById('filter-genre').addEventListener('change', fetchBooks);
document.getElementById('filter-author').addEventListener('change', fetchBooks);
document.getElementById('filter-language').addEventListener('change', fetchBooks);
document.getElementById('filter-year').addEventListener('input', fetchBooks);
document.getElementById('sort').addEventListener('change', fetchBooks);

// Cerrar modales al hacer clic fuera de ellos
window.onclick = function(event) {
    if (event.target.className === 'modal') {
        event.target.style.display = "none";
    }
}