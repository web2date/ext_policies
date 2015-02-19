<?php
namespace KandelIo\Policies\Aspect;

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

use TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface;
use TYPO3\CMS\Extbase\Mvc\Exception\StopActionException;

class PolicyEnforcementAspect {

	/**
	 * @inject
	 * @var \TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface
	 */
	protected $configurationManager;

	/**
	 * @inject
	 * @var \KandelIo\Policies\Utility\ExpressionLanguageUtility
	 */
	protected $expressionLanguage;

	/**
	 * @inject
	 * @var \KandelIo\Policies\Security\Context
	 */
	protected $securityContext;

	/**
	 * @inject
	 * @var \TYPO3\CMS\Extbase\Service\TypoScriptService
	 */
	protected $typoScriptService;

	/**
	 * @var array
	 */
	protected $policies;

	/**
	 *
	 */
	public function initializeObject() {
		$settings = $this->configurationManager->getConfiguration(ConfigurationManagerInterface::CONFIGURATION_TYPE_FULL_TYPOSCRIPT);
		$this->policies = $this->typoScriptService->convertTypoScriptArrayToPlainArray($settings['security.']['policies.']);
	}

	/**
	 * Enforces policies as defined in TypoScript
	 *
	 * @param $controllerName
	 * @param $actionName
	 * @param $preparedArguments
	 * @throws StopActionException
	 */
	public function enforcePolicy($controllerName, $actionName, $preparedArguments) {
		$preparedArguments['securityContext'] = $this->securityContext;
		if (isset($this->policies[$controllerName][$actionName])) {
			if (!$this->expressionLanguage->evaluate($this->policies[$controllerName][$actionName], $preparedArguments)) {
				throw new StopActionException();
			}
		}
	}

}
