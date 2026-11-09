<?php

/* This file is part of Jeedom.
 *
 * Jeedom is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Jeedom is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Jeedom. If not, see <http://www.gnu.org/licenses/>.
 */

/* * ***************************Includes********************************* */
require_once dirname(__FILE__) . '/../../../../core/php/core.inc.php';

class phonemarket extends eqLogic {
	/*     * *************************Attributs****************************** */

	/*     * ***********************Methode static*************************** */

	/*     * *********************Methode d'instance************************* */

	/*     * **********************Getteur Setteur*************************** */
}

class phonemarketCmd extends cmd {
	/*     * *************************Attributs****************************** */

	/*     * ***********************Methode static*************************** */

	/*     * *********************Methode d'instance************************* */
	public function preSave() {
		if ($this->getSubtype() == 'message') {
			$this->setDisplay('title_disable', 1);
		}
	}

	public function execute($_options = array()) {
		log::add('phonemarket', 'debug', 'Call execute command');
		$type = $this->getConfiguration('type');
		if ($type !== 'sms' && $type !== 'call') {
			return;
		}

		$data = array(
			'number' => $this->getConfiguration('phonenumber'),
			'message' => ($_options['title'] ?? '') . ' ' . ($_options['message'] ?? ''),
		);
		if ($type === 'call') {
			$data['language'] = config::byKey('language', 'core', 'fr_FR');
		} else {
			log::add('phonemarket', 'debug', 'Begin send sms to ' . $data['number']);
		}

		if (class_exists('repo_market') && class_exists('marketClient', false)) {
			$path = $type === 'sms' ? '/phone/messages' : '/phone/calls';
			marketClient::request('POST', $path, $data);
		} else {
			$market = repo_market::getJsonRpc();
			if (!$market->sendRequest('phonemarket::' . $type, $data)) {
				throw new Exception($market->getError(), $market->getErrorCode());
			}
			log::add('phonemarket', 'debug', print_r($market->getResult(), true));
		}

		if ($type === 'sms') {
			log::add('phonemarket', 'debug', 'End send sms to ' . $data['number']);
		}
	}

	/*     * **********************Getteur Setteur*************************** */
}

?>
