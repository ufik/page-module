<?php

namespace AdminModule\PageModule;

/**
 * Description of PagePresenter
 *
 * @author Tomáš Voslař <tomas.voslar at webcook.cz>
 */
class SettingsPresenter extends \AdminModule\BasePresenter {
	
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
	}
	
	public function renderDefault($id){
		$this->reloadContent();
		
		$this->template->page = $this->page;
		$this->template->id = $id;
	}
	
	
}