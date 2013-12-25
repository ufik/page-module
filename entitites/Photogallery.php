<?php

namespace WebCMS\PageModule\Doctrine;

use Doctrine\ORM\Mapping as orm;

/**
 * Description of Photogallery
 * @orm\Entity
 * @orm\Table(name="pageModulePhotogallery")
 * @author Tomáš Voslař <tomas.voslar at webcook.cz>
 */
class Photogallery extends \AdminModule\Doctrine\Entity{
	
	/**
	 * @orm\Column
	 * @var type 
	 */
	private $name;
	
	/**
	 * @orm\OneToOne(targetEntity="Page")
	 * @orm\JoinColumn(name="page_id", referencedColumnName="id", onDelete="CASCADE")
	 */
	private $page;
	
	/**
	 * @orm\Column(type="text")
	 */
	private $text;
	
	/**
	 * @orm\OneToMany(targetEntity="Photo", mappedBy="photogallery") 
	 * @var Array
	 */
	private $photos;
	
	public function getName() {
		return $this->name;
	}

	public function setName($name) {
		$this->name = $name;
	}

	public function getPage() {
		return $this->page;
	}

	public function setPage($page) {
		$this->page = $page;
	}

	public function getText() {
		return $this->text;
	}

	public function setText($text) {
		$this->text = $text;
	}	
	
	public function getPhotos() {
		return $this->photos;
	}

	public function setPhotos($photos) {
		$this->photos = $photos;
	}
}