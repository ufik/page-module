<?php

namespace WebCMS\PageModule;

/**
 * Description of Page
 *
 * @author Tomáš Voslař <tomas.voslar at webcook.cz>
 */
class Page extends \WebCMS\Module {
	
	protected $name = 'Page';
	
	protected $version;
	
	protected $author = 'Tomáš Voslař';
	
	protected $presenters = array(
		'Page'
	);
	
	protected $params = array(
		
	);
	
	public function createRoutes() {
		
	}	
}