<?php

namespace FrontendModule\PageModule;

/**
 * Description of PagePresenter
 *
 * @author Tomáš Voslař <tomas.voslar at webcook.cz>
 */
class PagePresenter extends \FrontendModule\BasePresenter{
	
	private $repository;
	
	private $page;
	
	protected function startup() {
		parent::startup();
	
		$this->repository = $this->em->getRepository('WebCMS\PageModule\Doctrine\Page');
	}

	protected function beforeRender() {
		parent::beforeRender();
		
	}
	
	public function actionDefault($id){
		
		$this->page = $this->repository->findOneBy(array(
			'page' => $this->actualPage
		));
		
		if(!is_object($this->page)){
			$this->page = $this->persistPage();
		}
	}
	
	public function renderDefault($id){
		
		$this->template->page = $this->page;
		$this->template->id = $id;
	}
	
	private function persistPage(){
		$page = new \WebCMS\PageModule\Doctrine\Page;
		$page->setText($this->translation['Module page default text.']);
		$page->setPage($this->actualPage);
	
		$this->em->persist($page);
		$this->em->flush();
		
		return $page;
	}
}

?>
