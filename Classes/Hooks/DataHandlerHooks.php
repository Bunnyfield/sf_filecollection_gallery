<?php
namespace SKYFILLERS\SfFilecollectionGallery\Hooks;

/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2015 Jöran Kurschatke <j.kurschatke@skyfillers.com>
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
 *
 *  Idea to use Hook for flexform settings: http://www.derhansen.de/2014/06/typo3-how-to-prevent-empty-flexform.html
 ***************************************************************/

use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Hooks for DataHandler
 */
class DataHandlerHooks {

	/**
	 * Checks if the fields defined in $checkFields are set in the data-array of pi_flexform. If a field is
	 * present and contains an empty value, the field is unset.
	 *
	 * Structure of the checkFields array:
	 *
	 * array('sheet' => array('field1', 'field2'));
	 *
	 * @param string $status
	 * @param string $table
	 * @param string $id
	 * @param array $fieldArray
	 * @param \TYPO3\CMS\Core\DataHandling\DataHandler $reference
	 *
	 * @return void
	 */
	public function processDatamap_postProcessFieldArray($status, $table, $id, &$fieldArray, &$reference) {
		if ($table === 'tt_content' && $status == 'update' && isset($fieldArray['pi_flexform'])) {
			$checkFields = array(
				'sDEF' => array(
					'settings.imagesPerPage',
					'settings.numberOfPages'
				),
			);

			$flexformData =  GeneralUtility::xml2array($fieldArray['pi_flexform']);

			foreach ($checkFields as $sheet => $fields) {
				foreach($fields as $field) {
					if (isset($flexformData['data'][$sheet]['lDEF'][$field]['vDEF']) &&
						$flexformData['data'][$sheet]['lDEF'][$field]['vDEF'] === '') {
						unset($flexformData['data'][$sheet]['lDEF'][$field]);
					}
				}

				// If remaining sheet does not contain fields, then remove the sheet
				if (isset($flexformData['data'][$sheet]['lDEF']) && $flexformData['data'][$sheet]['lDEF'] === array()) {
					unset($flexformData['data'][$sheet]);
				}
			}

			/** @var \TYPO3\CMS\Core\Configuration\FlexForm\FlexFormTools $flexFormTools */
			$flexFormTools = GeneralUtility::makeInstance('TYPO3\\CMS\\Core\\Configuration\\FlexForm\\FlexFormTools');
			$fieldArray['pi_flexform'] = $flexFormTools->flexArray2Xml($flexformData, TRUE);
		}
	}

}