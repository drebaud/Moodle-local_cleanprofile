<?php

// This file is part of the cleanprofile module for Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Certificate module core interaction API
 *
 * @package    local
 * @subpackage cleanprofiles
 * @copyright  2013 onwards Denis Rebaud {@link https://denis.rebaud.fr}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * Actions handler for Clean Profiles plugin.
 *
 */
class local_cleanprofiles_cleaner {

	/**
	 * Called each time a profile is created or updated.
	 *
	 * @param $currentuser
	 */
	public static function user_cleanup($userid) {
		global $DB;

		$currentuser = core_user::get_user($userid, '*', MUST_EXIST);
		$user = new stdClass();
		$user->id = 0;
		$config = get_config('cleanprofiles');


		// Missing accentuated first name are corrected
		// TODO we should add a column with the language code of the first name
		// in order to avoid some conversion (e.g. the english name Eric and french name Éric)

		// Cleaning first name
		$firstname = trim($currentuser->firstname);
		if ($config->correct_accentuation) {
			$lcfirstname = mb_convert_case(trim($currentuser->firstname), MB_CASE_LOWER, 'UTF-8');
			$record = $DB->get_record('local_cleanprofiles', array('lcfirstname'=>$lcfirstname));
			if ($record) {
				$firstname = $record->firstname;
			}
		}
		switch($config->firstname_case) {
			// no change
			case -1:
				break;

			case MB_CASE_TITLE:
				$func = function($word) {
					return mb_convert_case($word, MB_CASE_TITLE, 'UTF-8');
				};
				$delimiters = explode(' ', trim($config->delimiters));
				foreach($delimiters as $delimiter) {
					$words = explode($delimiter, trim($firstname));
					// change the case of each item of this array
					$firstname = join($delimiter, array_map($func, $words));
				}
				break;

			// upper ou lower case
			default:
				$firstname = mb_convert_case($firstname, $config->firstname_case, 'UTF-8');
		}
		if ($firstname != $currentuser->firstname) {
			$user->firstname = $firstname;
			$user->id = $currentuser->id;
		}

		// Cleaning last name
		if ($config->lastname_case != -1) {
			$lastname = mb_convert_case(trim($currentuser->lastname), $config->lastname_case, 'UTF-8');
			if ($lastname!= $currentuser->lastname) {
				$user->lastname = $lastname;
				$user->id = $currentuser->id;
			}
		}

		// Cleaning email (always in lowercase)
		$email = mb_convert_case(trim($currentuser->email), MB_CASE_LOWER, 'UTF-8');
		if ($email != $currentuser->email) {
			$user->email = $email;
			$user->id = $currentuser->id;
		}

		// Cleaning city
		if ($config->city_case != -1) {
			$city = mb_convert_case(trim($currentuser->city), $config->city_case, 'UTF-8');
			if ($city != $currentuser->city) {
				$user->city = $city;
				$user->id = $currentuser->id;
			}
		}

		// If one of the fields has changed
		if ($user->id > 0) {
			global $DB;
			// the user record is updated
			$DB->update_record('user', $user);
		}
	}
}
