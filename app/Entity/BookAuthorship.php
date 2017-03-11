<?php namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable
 */
class BookAuthorship {

	/**
	 * @ORM\Column(type="string", length=500, nullable=true)
	 */
	private $author;

	/**
	 * @ORM\Column(type="string", length=500, nullable=true)
	 */
	private $translator;

	/**
	 * @ORM\Column(type="string", length=50, nullable=true)
	 */
	private $translatedFromLanguage;

	/**
	 * @ORM\Column(type="string", length=20, nullable=true)
	 */
	private $dateOfTranslation;

	/**
	 * @ORM\Column(type="string", length=100, nullable=true)
	 */
	private $adaptedBy;

	/**
	 * @ORM\Column(type="string", length=700, nullable=true)
	 */
	private $otherAuthors;

	/**
	 * @ORM\Column(type="string", length=255, nullable=true)
	 */
	private $compiler;

	public function getAuthor() { return $this->author; }
	public function setAuthor($author) { $this->author = $author; }
	public function getTranslator() { return $this->translator; }
	public function setTranslator($translator) { $this->translator = $translator; }
	public function getTranslatedFromLanguage() { return $this->translatedFromLanguage; }
	public function setTranslatedFromLanguage($translatedFromLanguage) { $this->translatedFromLanguage = $translatedFromLanguage; }
	public function getDateOfTranslation() { return $this->dateOfTranslation; }
	public function setDateOfTranslation($dateOfTranslation) { $this->dateOfTranslation = $dateOfTranslation; }
	public function getAdaptedBy() { return $this->adaptedBy; }
	public function setAdaptedBy($adaptedBy) { $this->adaptedBy = $adaptedBy; }
	public function getOtherAuthors() { return $this->otherAuthors; }
	public function setOtherAuthors($otherAuthors) { $this->otherAuthors = $otherAuthors; }
	public function getCompiler() { return $this->compiler; }
	public function setCompiler($compiler) { $this->compiler = $compiler; }

	public function toArray() {
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

	public function jsonSerialize() {
		return $this->toArray();
	}
}