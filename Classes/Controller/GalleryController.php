<?php
namespace SKYFILLERS\SfFilecollectionGallery\Controller;

/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2014 Jöran Kurschatke <j.kurschatke@skyfillers.com>, Skyfillers GmbH
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * GalleryController
 */
class GalleryController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	/**
	 * File Collection Service
	 *
	 * @var \SKYFILLERS\SfFilecollectionGallery\Service\FileCollectionService
	 * @inject
	 */
	protected $fileCollectionService;


	/**
	 * List action
	 *
	 * @param int $offset
	 * @return void
	 */
	public function listAction($offset = 0) {
		$collectionUids = explode(',', $this->settings['fileCollection']);
		$imageItems = $this->fileCollectionService->getFileObjectsFromCollection($collectionUids);
		$paginationArray = array(
			'itemsPerPage' => $this->settings['imagesPerPage'],
			'maximumVisiblePages' => $this->settings['numberOfPages'],
			'insertAbove' => $this->settings['insertAbove'],
			'insertBelow' => $this->settings['insertBelow']
		);
		$this->view->assignMultiple(array(
			'imageItems' => $imageItems,
			'offset' => $offset,
			'paginationConfiguration' => $paginationArray,
			'settings' => $this->settings
		));
	}

}