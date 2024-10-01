<?php
// Класс Book представляет книгу в библиотеке
class Book {
    private $title;
    private $author;
    private $publishedYear;
    private $genre;

    // Конструктор для инициализации всех свойств
    public function __construct($title, $author, $publishedYear, $genre) {
        $this->title = $title;
        $this->author = $author;
        $this->setPublishedYear($publishedYear);
        $this->genre = $genre;
    }

    // Геттеры и сеттеры
    public function getTitle() {
        return $this->title;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function getAuthor() {
        return $this->author;
    }

    public function setAuthor($author) {
        $this->author = $author;
    }

    public function getPublishedYear() {
        return $this->publishedYear;
    }

    public function setPublishedYear($publishedYear) {
        if (!is_numeric($publishedYear) || $publishedYear < 0) {
            throw new InvalidArgumentException("Год публикации должен быть положительным числом.");
        }
        $this->publishedYear = $publishedYear;
    }

    public function getGenre() {
        return $this->genre;
    }

    public function setGenre($genre) {
        $this->genre = $genre;
    }

    // Метод для получения информации о книге
    public function getBookInfo() {
        return "Название: " . $this->title . ", Автор: " . $this->author .
            ", Год публикации: " . $this->publishedYear . ", Жанр: " . $this->genre;
    }
}
?>
