<?php
// Класс Library управляет коллекцией книг
class Library {
    private $books = [];

    // Метод для добавления книги в библиотеку
    public function addBook(Book $book) {
        foreach ($this->books as $existingBook) {
            if ($existingBook->getTitle() === $book->getTitle()) {
                throw new Exception("Книга с таким названием уже существует.");
            }
        }
        $this->books[] = $book;
    }

    // Метод для удаления книги по названию
    public function removeBookByTitle($title) {
        foreach ($this->books as $index => $book) {
            if ($book->getTitle() === $title) {
                unset($this->books[$index]);
                $this->books = array_values($this->books); // Перенумерация массива
                return true;
            }
        }
        return false;
    }

    // Метод для поиска книг по автору
    public function findBooksByAuthor($author) {
        $result = [];
        foreach ($this->books as $book) {
            if ($book->getAuthor() === $author) {
                $result[] = $book;
            }
        }
        return $result;
    }

    // Метод для отображения всех книг
    public function listAllBooks() {
        $result = [];
        foreach ($this->books as $book) {
            $result[] = $book->getBookInfo();
        }
        return $result;
    }
}
?>
