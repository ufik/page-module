<?php

namespace AdminModule\PageModule;

/**
 * Description of PagePresenter
 *
 * @author Tomáš Voslař <tomas.voslar at webcook.cz>
 */
class PagePresenter extends BasePresenter {
	
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
		
		if(!is_object($this->page)){
			$this->page = $this->persistPage();
		}
	}
	
	public function renderDefault($idPage){
		$this->reloadContent();
		
		$this->template->page = $this->page;
		$this->template->idPage = $idPage;
	}
	
	protected function createComponentPageForm(){
		$form = $this->createForm();
		
		$form->addTextArea('text', 'Page text')->setAttribute('class', 'form-control editor')->setDefaultValue($this->page->getText());
				
		$form->addSubmit('submit', 'Save')->setAttribute('class', 'btn btn-success');
		$form->onSuccess[] = callback($this, 'pageFormSubmitted');
		
		return $form;
	}
	
	public function pageFormSubmitted($form){
		$values = $form->getValues();
		
		$this->page->setText($values->text);
		
		$this->em->flush();
		$this->flashMessage('Page text has been saved.', 'success');
		
		$this->redirect('this');
	}
	
	private function persistPage(){
		$page = new \WebCMS\PageModule\Entity\Page;
		$page->setText($this->translation['Module page default text.']);
		$page->setPage($this->actualPage);
	
		$this->em->persist($page);
		$this->em->flush();
		
		return $page;
	}
}