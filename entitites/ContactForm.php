<?php

namespace WebCMS\PageModule\Doctrine;

use Doctrine\ORM\Mapping as orm;

/**
 * Description of ContactForm
 * @orm\Entity
 * @orm\Table(name="pageModuleContactForm")
 * @author Tomáš Voslař <tomas.voslar at webcook.cz>
 */
class ContactForm extends \AdminModule\Doctrine\Entity {
	
	/**
	 * @orm\Column(name="`name`")
	 */
	private $name;
	
	/**
	 * @orm\Column
	 */
	private $label;
	
	/**
	 * @orm\Column
	 */
	private $type;
	
	/**
	 * @orm\Column
	 */
	private $options;
	
	/**
	 * @orm\Column(type="boolean")
	 */
	private $defaultOption;
	
	/**
	 * @orm\OneToOne(targetEntity="Page")
	 * @orm\JoinColumn(name="page_id", referencedColumnName="id", onDelete="CASCADE")
	 */
	private $page;
	
	public function getName() {
		return $this->name;
	}

	public function setName($name) {
		$this->name = $name;
	}

	public function getLabel() {
		return $this->label;
	}

	public function setLabel($label) {
		$this->label = $label;
	}

	public function getType() {
		return $this->type;
	}

	public function setType($type) {
		$this->type = $type;
	}

	public function getOptions() {
		return $this->options;
	}

	public function setOptions($options) {
		$this->options = $options;
	}

	public function getDefaultOption() {
		return $this->defaultOption;
	}

	public function setDefaultOption($defaultOption) {
		$this->defaultOption = $defaultOption;
	}

	public function getPage() {
		return $this->page;
	}

	public function setPage($page) {
		$this->page = $page;
	}	
}