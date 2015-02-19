<?php
namespace KandelIo\Policies\Utility;

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

use Symfony\Component\ExpressionLanguage\ExpressionLanguage;
use Symfony\Component\Finder\Expression\Expression;
use TYPO3\CMS\Core\SingletonInterface;

class ExpressionLanguageUtility implements SingletonInterface {

	/**
	 * @var ExpressionLanguage
	 */
	protected $expressionLanguage;

	public function __construct() {
		$this->expressionLanguage = new ExpressionLanguage();
	}

	/**
	 * Compiles an expression source code.
	 *
	 * @param Expression|string $expression The expression to compile
	 * @param array $names An array of valid names
	 *
	 * @return string The compiled PHP source code
	 */
	public function compile($expression, $names = array()) {
		return $this->expressionLanguage->compile($expression, $names);
	}

	/**
	 * Evaluate an expression.
	 *
	 * @param Expression|string $expression The expression to compile
	 * @param array $values An array of values
	 *
	 * @return string The result of the evaluation of the expression
	 */
	public function evaluate($expression, $values = array()) {
		return $this->expressionLanguage->evaluate($expression, $values);
	}

	/**
	 * Registers a function.
	 *
	 * @param string $name The function name
	 * @param callable $compiler A callable able to compile the function
	 * @param callable $evaluator A callable able to evaluate the function
	 *
	 * @see ExpressionFunction
	 */
	public function register($name, $compiler, $evaluator) {
		$this->expressionLanguage->register($name, $compiler, $evaluator);
	}
}