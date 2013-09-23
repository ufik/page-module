<?php

namespace WebCMS\PageModule\Doctrine;

use Doctrine\ORM\Mapping as orm;

/**
 * Description of Photo
 * @orm\Entity
 * @orm\Table(name="pageModulePhoto")
 * @author Tomáš Voslař <tomas.voslar at webcook.cz>
 */
class Photo extends \AdminModule\Doctrine\Entity{
	
	/**
	 * @orm\Column(type="text")
	 * @var type 
	 */
	private $title;
	
	/**
	 * @orm\ManyToOne(targetEntity="Photogallery")
	 * @orm\JoinColumn(name="photogallery_id", referencedColumnName="id", onDelete="CASCADE")
	 * @var Int 
	 */
	private $photogallery;

	/**
	 * @orm\Column(type="text")
	 * @var type 
	 */
	private $path;
	
	public function getTitle() {
		return $this->title;
	}

	public function setTitle($title) {
		$this->title = $title;
	}

	public function getPhotogallery() {
		return $this->photogallery;
	}

	public function setPhotogallery(Int $photogallery) {
		$this->photogallery = $photogallery;
	}

	public function getPath() {
		return $this->path;
	}

	public function setPath(type $path) {
		$this->path = $path;
	}

}

?>
