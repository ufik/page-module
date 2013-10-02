<?php

namespace AdminModule\PageModule;

/**
 * Description of PagePresenter
 * TODO create base presenter for page module
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
	
	public function actionDefault($idPage){
		$this->page = $this->repository->findOneBy(array(
			'page' => $this->actualPage
		));
	}
	
	public function createComponentSettingsForm(){
		
		$settings = array();
		$settings[] = $this->settings->get('Show map', 'pageModule' . $this->actualPage->getId(), 'checkbox', array());
		$settings[] = $this->settings->get('Enable tracing', 'pageModule' . $this->actualPage->getId(), 'checkbox', array());
		
		return $this->createSettingsForm($settings);
	}
	
	public function renderDefault($idPage){
		$this->reloadContent();
		
		$this->template->config = $this->settings->getSection('pageModule');
		$this->template->page = $this->page;
		$this->template->idPage = $idPage;
	}
	
	
}