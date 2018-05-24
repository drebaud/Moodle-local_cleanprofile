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
 * Clean Profiles Plugin
 *
 * @package    local_cleanprofiles
 * @copyright  2013 onwards Denis Rebaud {@link https://denis.rebaud.fr}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_cleanprofiles;

defined('MOODLE_INTERNAL') || die();

/**
 * Event handler for Clean Profiles plugin.
 *
 */
class observer {

    /**
     * Triggered via user_created event.
     *
     * @param \core\event\user_created $event
     */
    public static function user_created(\core\event\user_created $event) {
        cleaner::user_cleanup($event->userid);
    }

    /**
     * Triggered via user_updated event.
     *
     * @param \core\event\user_updated $event
     */
    public static function user_updated(\core\event\user_updated $event) {
        cleaner::user_cleanup($event->userid);
    }
}

// End of file.
