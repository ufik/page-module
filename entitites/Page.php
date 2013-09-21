<?php

namespace WebCMS\PageModule\Doctrine;

use Doctrine\ORM\Mapping as orm;

/**
 * Description of Page
 * @orm\Entity
 * @orm\Table(name="pageModule")
 * @author Tomáš Voslař <tomas.voslar at webcook.cz>
 */
class Page extends \AdminModule\Doctrine\Entity {
	/**
	 * @orm\Column(type="text")
	 */
	private $text;
	
	/**
	 * @orm\ManyToOne(targetEntity="AdminModule\Page")
	 * @orm\JoinColumn(name="page_id", referencedColumnName="id", onDelete="CASCADE")
	 */
	private $page;
	
	public function getText() {
		return $this->text;
	}

	public function setText($text) {
		$this->text = $text;
	}

	public function getPage() {
		return $this->page;
	}

	public function setPage($page) {
		$this->page = $page;
	}
}