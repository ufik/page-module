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
			'frontend' => TRUE,
			'parameters' => FALSE
			),
		array(
			'name' => 'Photogallery',
			'frontend' => FALSE
			),
		array(
			'name' => 'Videogallery',
			'frontend' => FALSE
			),
		array(
			'name' => 'Contact',
			'frontend' => FALSE
			),
		array(
			'name' => 'Settings',
			'frontend' => FALSE
			)
	);
	
	protected $params = array(
		
	);
	
	protected $cloneable = true;
	
	public function __construct(){
		$this->addBox('Page box', 'Page', 'textBox');
		$this->addBox('Photogallery box', 'Page', 'photogalleryBox');
	}
	
	public function cloneData($em, $oldLang, $newLang, $transform){
		$toClone = $em->getRepository('AdminModule\Page')->findBy(array(
			'moduleName' => $this->name,
			'language' => $oldLang
		));
		
		foreach($toClone as $tc){
			$this->clonePage($em, $tc, $transform, $oldLang);
		}
		
		$em->flush();
	}
	
	private function clonePage($em, $oldPage, $transform, $oldLang){
		
		$old = $em->getRepository('WebCMS\PageModule\Doctrine\Page')->findOneBy(array(
			'page' => $oldPage
		));
		
		if(is_object($old)){
		
			// page cloning
			$new = new Doctrine\Page;
			$new->setText($old->getText());
			$new->setPage($transform[$oldPage->getId()]);

			// photogallery
			$oldPhotogallery = $em->getRepository('WebCMS\PageModule\Doctrine\Photogallery')->findOneBy(array(
				'page' => $old
			));

			$em->persist($new);

			$newPhotogallery = new Doctrine\Photogallery;
			$newPhotogallery->setName($oldPhotogallery->getName());
			$newPhotogallery->setText($oldPhotogallery->getText());
			$newPhotogallery->setPage($new);

			$em->persist($newPhotogallery);

			// photos of photogallery
			foreach($oldPhotogallery->getPhotos() as $photo){
				$newPhoto = new Doctrine\Photo;
				$newPhoto->setPath($photo->getPath());
				$newPhoto->setTitle($photo->getTitle());
				$newPhoto->setPhotogallery($newPhotogallery);

				$em->persist($newPhoto);
			}

			// settings
			$settings = $em->getRepository('AdminModule\Setting')->findBy(array(
				'section' => 'pageModule' . $oldPage->getId(),
				'language' => $oldLang
			));

			foreach($settings as $s){
				$newSetting = new \AdminModule\Setting;
				$newSetting->setSection('pageModule' . $transform[$oldPage->getId()]->getId());
				$newSetting->setLanguage($transform[$oldPage->getId()]->getLanguage());
				$newSetting->setOptions($s->getOptions());
				$newSetting->setType($s->getType());
				$newSetting->setValue($s->getValue());
				$newSetting->setKey($s->getKey());

				$em->persist($newSetting);
			}
		
		}
	}
}