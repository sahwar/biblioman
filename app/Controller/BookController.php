<?php namespace App\Controller;

use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Pagerfanta;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/books")
 */
class BookController extends Controller {

	/**
	 * @Route("/", name="books")
	 */
	public function indexAction(Request $request) {
		$page = $request->query->get('page', 1);
		$maxResults = 15;
		/* @var $queryBuilder \Doctrine\ORM\QueryBuilder */
		$queryBuilder = $this->getDoctrine()->getManager()->createQueryBuilder()
			->select('b')
			->from('App:Book', 'b');
		if ($searchQuery = $request->query->get('q')) {
			$queryBuilder
				->where('b.title LIKE ?1')
				->orWhere('b.subtitle LIKE ?1')
				->orWhere('b.author LIKE ?1')
				->orWhere('b.translator LIKE ?1')
				->orWhere('b.compiler LIKE ?1')
				->orWhere('b.editor LIKE ?1')
				->orWhere('b.publisher LIKE ?1')
				->setParameter('1', "%$searchQuery%");
		}
		$adapter = new DoctrineORMAdapter($queryBuilder);
		$pager = new Pagerfanta($adapter);
		$pager->setMaxPerPage($maxResults);
		$pager->setCurrentPage($page);
		return $this->render('Book/index.html.twig', [
			'pager' => $pager,
			'fields' => $this->getParameter('book_fields_short'),
			'query' => $searchQuery,
		]);
	}

	/**
	 * @Route("/search-duplicates", name="books_search_duplicates")
	 */
	public function searchDuplicatesAction(Request $request) {
		$books = $this->getDoctrine()->getManager()
			->getRepository('App:Book')
			->findDuplicatesByTitle($request->query->get('title'), $request->query->get('id'));
		return $this->render('Book/searchDuplicates.html.twig', [
			'books' => $books,
			'fields' => $this->getParameter('book_fields_short'),
		]);
	}

	/**
	 * @Route("/{id}", name="books_show")
	 */
	public function showAction($id) {
		$book = $this->getDoctrine()->getManager()
			->getRepository('App:Book')
			->find($id);
		if (!$book) {
			throw $this->createNotFoundException('Book not found');
		}
		return $this->render('Book/show.html.twig', [
			'book' => $book,
			'fields' => $this->getParameter('book_fields_long'),
		]);
	}
}
