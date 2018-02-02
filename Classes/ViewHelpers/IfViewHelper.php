<?php
namespace KandelIo\Policies\ViewHelpers;

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

class IfViewHelper extends \TYPO3\CMS\Fluid\ViewHelpers\IfViewHelper
{

    /**
     * @inject
     * @var \KandelIo\Policies\Service\EvaluationService
     */
    protected $evaluationService;

    /**
     * renders <f:then> child if $condition is true, otherwise renders <f:else> child.
     *
     * @param string $evaluationExpression View helper condition
     * @param array $arguments
     * @return string the rendered string
     * @api
     */
    public function render($evaluationExpression, $arguments = array())
    {
        if ($this->evaluationService->evaluate($evaluationExpression, $arguments)) {
            return $this->renderThenChild();
        } else {
            return $this->renderElseChild();
        }
    }

}
