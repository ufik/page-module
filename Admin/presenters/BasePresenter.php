<?php

namespace AdminModule\PageModule\PageModule;

/**
 * Description of PagePresenter
 *
 * @author Tomáš Voslař <tomas.voslar at webcook.cz>
 */
class BasePresenter extends \AdminModule\BasePresenter {
	
	private $repository;
	
	private $page;
	
	protected function startup() {
		parent::startup();
		
		$this->repository = $this->em->getRepository('WebCMS\PageModule\Entity\Page');

	}

	protected function beforeRender() {
		parent::beforeRender();
                
                if($this->actualPage->getRedirect() !== null){
                    $this->flashMessage('This page is not visible due to redirect.', 'info');
                }
	}
	
	public function actionDefault($idPage){
		$this->page = $this->repository->findOneBy(array(
			'page' => $this->actualPage
		));
	}
	
	public function renderDefault($idPage){
		$this->reloadContent();
		
		$this->template->page = $this->page;
		$this->template->idPage = $idPage;
	}
	
	
}