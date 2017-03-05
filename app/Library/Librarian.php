<?php namespace App\Library;

use App\Entity\Book;
use App\Entity\BookCategory;
use App\Entity\BookOnShelf;
use App\Entity\Shelf;
use App\Persistence\RepositoryFinder;

class Librarian {

	private $repoFinder;

	public function __construct(RepositoryFinder $repoFinder) {
		$this->repoFinder = $repoFinder;
	}

	/**
	 * @param string $textQuery
	 * @return BookSearchCriteria
	 */
	public function createBookSearchCriteria($textQuery, $sort = null) {
		return new BookSearchCriteria($textQuery, $sort);
	}

	public function findBooksByCriteria(BookSearchCriteria $query) {
		return $this->repoFinder->forBook()->filterByCriteria($query);
	}

	public function findBooksOnShelfByCriteria(Shelf $shelf, BookSearchCriteria $query) {
		if ($query->isEmpty()) {
			return $shelf->getBooksOnShelf();
		}
		return $this->repoFinder->forBook()->filterByCriteria($query->inShelf($shelf));
	}

	public function findBooksInCategoryByCriteria(BookCategory $category, BookSearchCriteria $query) {
		return $this->repoFinder->forBook()->filterByCriteria($query->inCategory($category));
	}

	public function findRecentBooks() {
		return $this->repoFinder->forBook()->recent();
	}

	/**
	 * @param array|\Traversable $result
	 * @return Book[]
	 */
	public function getBooksFromSearchResult($result) {
		$books = [];
		foreach ($result as $item) {
			$books[] = $item instanceof BookOnShelf ? $item->getBook() : $item;
		}
		return $books;
	}
}
