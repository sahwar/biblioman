<?php namespace App\Entity;

use Chitanka\Utils\Typograph;
use Doctrine\ORM\Mapping as ORM;

trait WithBookAuthorship {

	/**
	 * @ORM\Column(type="string", length=500, nullable=true)
	 */
	private $author;

	/**
	 * @ORM\Column(type="string", length=1500, nullable=true)
	 */
	private $translator;

	/**
	 * @ORM\Column(type="string", length=200, nullable=true)
	 */
	private $translatedFromLanguage;

	/**
	 * @ORM\Column(type="string", length=50, nullable=true)
	 */
	private $dateOfTranslation;

	/**
	 * @ORM\Column(type="string", length=100, nullable=true)
	 */
	private $adaptedBy;

	/**
	 * @ORM\Column(type="string", length=1500, nullable=true)
	 */
	private $otherAuthors;

	/**
	 * @ORM\Column(type="string", length=255, nullable=true)
	 */
	private $compiler;

	public function setAuthor($author) { $this->author = Typograph::replaceDash($author); }
	public function setTranslator($translator) { $this->translator = Typograph::replaceDash($translator); }
	public function setTranslatedFromLanguage($translatedFromLanguage) { $this->translatedFromLanguage = $translatedFromLanguage; }
	public function setDateOfTranslation($dateOfTranslation) { $this->dateOfTranslation = $dateOfTranslation; }
	public function setAdaptedBy($adaptedBy) { $this->adaptedBy = Typograph::replaceDash($adaptedBy); }
	public function setOtherAuthors($otherAuthors) { $this->otherAuthors = Typograph::replaceDash($otherAuthors); }
	public function setCompiler($compiler) { $this->compiler = Typograph::replaceDash($compiler); }

	public function getAuthorsAtMost($count) {
		return implode(';', array_slice(explode(';', $this->author), 0, $count));
	}

	protected function authorshipToArray() {
		return [
			'author' => $this->author,
			'translator' => $this->translator,
			'translatedFromLanguage' => $this->translatedFromLanguage,
			'dateOfTranslation' => $this->dateOfTranslation,
			'adaptedBy' => $this->adaptedBy,
			'otherAuthors' => $this->otherAuthors,
			'compiler' => $this->compiler,
		];
	}

}
