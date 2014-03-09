<?php

namespace AdminModule\PageModule;

/**
 * Description of PagePresenter
 *
 * @author Tomáš Voslař <tomas.voslar at webcook.cz>
 */
class PhotogalleryPresenter extends \AdminModule\BasePresenter {
	
	private $repository;
	
	private $page;
	
	/* @var \WebCMS\PageModule\Entity\Photogallery */
	private $photogallery;
	
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
		
		$this->photogallery = $this->em->getRepository('WebCMS\PageModule\Entity\Photogallery')->findOneBy(array(
			'page' => $this->page
		));

	}
	
	public function renderDefault($idPage){
		$this->reloadContent();
		
		$this->template->photogallery = $this->photogallery;
		$this->template->page = $this->page;
		$this->template->idPage = $idPage;
	}
	
	public function createComponentPhotogalleryForm(){
		$form = $this->createForm();
		
		$form->addText('name', 'Photogallery name');
		$form->addTextArea('text', 'Photogallery text');
		
		$form->addSubmit('submit', 'Save');
		$form->onSuccess[] = callback($this, 'photogalleryFormSubmitted');
		
		if(is_object($this->photogallery))
			$form->setDefaults($this->photogallery->toArray());
		
		return $form;
	}
	
	public function photogalleryFormSubmitted(\Nette\Forms\Form $form){
		$values = $form->getValues();
		
		if(is_object($this->photogallery)){
			$photogallery = $this->photogallery;
			
			// delete old photos and save new ones
			$qb = $this->em->createQueryBuilder();
			$qb->delete('WebCMS\PageModule\Entity\Photo', 'l')
					->where('l.photogallery = ?1')
					->setParameter(1, $photogallery)
					->getQuery()
					->execute();
		}
		else
			$photogallery = new \WebCMS\PageModule\Entity\Photogallery;
		
		$photogallery->setName($values->name);
		$photogallery->setText($values->text);
		$photogallery->setPage($this->page);
		
		$this->em->persist($photogallery);
		
		if(array_key_exists('files', $_POST)){
			$counter = 0;
			foreach($_POST['files'] as $path){

				$photo = new \WebCMS\PageModule\Entity\Photo;
				$photo->setTitle($_POST['fileNames'][$counter]);
				$photo->setPath($path);
				$photo->setPhotogallery($photogallery);

				$this->em->persist($photo);

				$counter++;
			}
		}
		
		$this->em->flush();
		$this->flashMessage('Photogallery has been saved.', 'success');
		$this->redirect('this');
	}
	
}