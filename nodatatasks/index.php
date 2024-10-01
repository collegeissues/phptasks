<?php
// Подключаем классы
require_once 'models/Book.php';
require_once 'models/Library.php';

// Пример использования классов

// Создание экземпляров книг
$book1 = new Book("1984", "Джордж Оруэлл", 1949, "Антиутопия");
$book2 = new Book("Преступление и наказание", "Федор Достоевский", 1866, "Роман");
$book3 = new Book("Мастер и Маргарита", "Михаил Булгаков", 1967, "Фантастика");

// Создание библиотеки и добавление книг
$library = new Library();
try {
    $library->addBook($book1);
    $library->addBook($book2);
    $library->addBook($book3);
} catch (Exception $e) {
    echo "Ошибка: " . $e->getMessage() . "\n";
}

// Удаление книги по названию
$library->removeBookByTitle("1984");

// Поиск книг по автору
$booksByDostoevsky = $library->findBooksByAuthor("Федор Достоевский");

// Вывод информации о книгах Достоевского
echo "Книги Федора Достоевского:\n";
foreach ($booksByDostoevsky as $book) {
    echo $book->getBookInfo() . "\n";
}

// Вывод всех книг
echo "\nВсе книги в библиотеке:\n";
$allBooks = $library->listAllBooks();
foreach ($allBooks as $bookInfo) {
    echo $bookInfo . "\n";
}
?>
