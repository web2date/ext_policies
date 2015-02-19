<?php

/** @var \TYPO3\CMS\Extbase\SignalSlot\Dispatcher $signalSlotDispatcher */
$signalSlotDispatcher = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\CMS\Extbase\SignalSlot\Dispatcher');
$signalSlotDispatcher->connect(
	'TYPO3\\CMS\\Extbase\\Mvc\\Controller\\ActionController',
	'beforeCallActionMethod',
	'Kandelio\\Policies\\Aspect\\PolicyEnforcementAspect',
	'enforcePolicy'
);

unset($signalSlotDispatcher);
