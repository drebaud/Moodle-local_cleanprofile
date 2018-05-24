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

defined('MOODLE_INTERNAL') || die;

if ($hassiteconfig) {
    if (!defined('LOCAL_CLEANPROFILES_SETTINGS')) {
        define('LOCAL_CLEANPROFILES_SETTINGS', 'cleanprofiles_settings');
    }

    $ADMIN->add(
        'accounts',
        new admin_category(LOCAL_CLEANPROFILES_SETTINGS, get_string('pluginname', 'local_cleanprofiles', null, true))
    );
    $setting = new admin_settingpage(
        'local_cleanprofiles',
        get_string('settings', 'local_cleanprofiles', null, true)
    );

    if ($ADMIN->fulltree) {

        $choices = array();
        $choices[-1] = get_string('settings:no_change', 'local_cleanprofiles', null, true);
        $choices[MB_CASE_LOWER] = get_string('settings:case_lower', 'local_cleanprofiles', null, true);
        $choices[MB_CASE_UPPER] = get_string('settings:case_upper', 'local_cleanprofiles', null, true);
        $choices[MB_CASE_TITLE] = get_string('settings:case_title', 'local_cleanprofiles', null, true);

        $setting->add(
            new admin_setting_configcheckbox('cleanprofiles/correct_accentuation',
                get_string('settings:firstname_accent', 'local_cleanprofiles', null, true),
            get_string('settings:firstname_accent_helpset', 'local_cleanprofiles', null, true),
                0  // Not checked by default.
            )
        );

        $setting->add(
            new admin_setting_configselect('cleanprofiles/firstname_case',
                get_string('settings:firstname_case', 'local_cleanprofiles', null, true),
            get_string('settings:firstname_case_helpset', 'local_cleanprofiles', null, true),
                MB_CASE_TITLE,
                $choices
            )
        );

        $setting->add(
            new admin_setting_configtext('cleanprofiles/delimiters',
                get_string('settings:delimiters', 'local_cleanprofiles', null, true),
                get_string('settings:delimiters_helpset', 'local_cleanprofiles', null, true),
                "- . ' O' Mc"
            )
        );

        $setting->add(
            new admin_setting_configselect('cleanprofiles/lastname_case',
                get_string('settings:lastname_case', 'local_cleanprofiles', null, true),
            get_string('settings:lastname_case_helpset', 'local_cleanprofiles', null, true),
                MB_CASE_UPPER,
                $choices
            )
        );

        $setting->add(
            new admin_setting_configselect('cleanprofiles/city_case',
                get_string('settings:city_case', 'local_cleanprofiles', null, true),
            get_string('settings:city_case_helpset', 'local_cleanprofiles', null, true),
                MB_CASE_TITLE,
                $choices
            )
        );
    }

    // Add settings page to navigation tree.
    $ADMIN->add(LOCAL_CLEANPROFILES_SETTINGS, $setting);
    unset($settings);

    $setting = new admin_externalpage('local_cleanprofiles_all',
                    get_string('settings:update_all', 'local_cleanprofiles', null, true),
                    new moodle_url('/local/cleanprofiles/update_all.php'),
                    'moodle/site:config');

    // Add pagelist page to navigation category.
    $ADMIN->add(LOCAL_CLEANPROFILES_SETTINGS, $setting);
    unset($settings);
}

// End of file.
