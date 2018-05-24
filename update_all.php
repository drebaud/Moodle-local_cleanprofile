<?php
// This file is part of the cleanprofiles module for Moodle - http://moodle.org/
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
require_once(__DIR__ . '/../../config.php');
require_once($CFG->libdir . '/adminlib.php');

admin_externalpage_setup('local_cleanprofiles_all', '', null);

$PAGE->set_heading($SITE->fullname);
$PAGE->set_title($SITE->fullname . ': ' . get_string('pluginname', 'local_cleanprofiles'));

// Let PHP know that we'll take longer.
\core_php_time_limit::raise();

echo $OUTPUT->header();

echo $OUTPUT->heading(get_string('pluginname', 'local_cleanprofiles'));

$conditions = null;
$sort = '';
$fields = 'id';
$users = $DB->get_records('user', $conditions, $sort, $fields);
if ($users) {
    foreach ($users as $user) {
        \local_cleanprofiles\cleaner::user_cleanup($user->id);
    }
    $done = get_string('done', 'local_cleanprofiles');
    echo "<p>$done</p>";
}
echo $OUTPUT->footer();

// End of file.
