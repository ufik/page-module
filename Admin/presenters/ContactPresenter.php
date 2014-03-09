<?php

namespace AdminModule\PageModule;

/**
 * Description of PagePresenter
 *
 * @author Tomáš Voslař <tomas.voslar at webcook.cz>
 */
class ContactPresenter extends \AdminModule\BasePresenter {
	
	private $repository;
	
	private $page;
	
	protected function startup() {
		parent::startup();
		
		$this->repository = $this->em->getRepository('WebCMS\PageModule\Entity\Page');
	}

	protected function beforeRender() {
		parent::beforeRender();
		
	}
	
	public function actionDefault($idPage){
		$this->page = $this->repository->findOneBy(array(
			'page' => $this->actualPage
		));
	}
	
	public function createComponentContactForm(){
		
		$settings = array();
		$settings[] = $this->settings->get('Latitude', 'pageModule' . $this->actualPage->getId(), 'text', array());
		$settings[] = $this->settings->get('Longtitude', 'pageModule' . $this->actualPage->getId(), 'text', array());
		
		return $this->createSettingsForm($settings);
	}
	
	public function renderDefault($idPage){
		$this->reloadContent();
		
		$this->template->page = $this->page;
		$this->template->idPage = $idPage;
	}
	
	
}