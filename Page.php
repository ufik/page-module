<?php

namespace WebCMS\PageModule;

/**
 * Description of Page
 *
 * @author Tomáš Voslař <tomas.voslar at webcook.cz>
 */
class Page extends \WebCMS\Module {
	
	protected $name = 'Page';
	
	protected $author = 'Tomáš Voslař';
	
	protected $presenters = array(
		array(
			'name' => 'Page',
			'frontend' => TRUE
			),
		array(
			'name' => 'Photogallery',
			'frontend' => FALSE
			),
	);
	
	protected $params = array(
		
	);
	
	public function __construct(){
		$this->addBox('Page box', 'Page', 'textBox');
		$this->addBox('Photogallery box', 'Page', 'photogalleryBox');
	}
	
}