<?php
namespace KandelIo\Policies\Security;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2015 Tim Kandel <tim@kandel.io>
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *  A copy is found in the text file GPL.txt and important notices to the license
 *  from the author is found in LICENSE.txt distributed with these scripts.
 *
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

use TYPO3\CMS\Core\SingletonInterface;
use TYPO3\CMS\Extbase\Domain\Model\FrontendUser;

/**
 * Class Context
 *
 * @package Kandelio\Policies\Security
 */
class Context implements SingletonInterface {

	/**
	 * @inject
	 * @var \TYPO3\CMS\Extbase\Domain\Repository\FrontendUserRepository
	 */
	protected $frontendUserRepository;

	/**
	 * @var FrontendUser
	 */
	protected $user;

	/**
	 * @return null|FrontendUser
	 */
	public function getUser() {
		if ($this->user === NULL && $GLOBALS['TSFE']->fe_user->user['uid']) {
			$this->user = $this->frontendUserRepository->findByUid($GLOBALS['TSFE']->fe_user->user['uid']);
		}

		return $this->user;
	}

}