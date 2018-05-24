<?php
// This file is part of Moodle - http://moodle.org/
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

defined('MOODLE_INTERNAL') || die();

/**
 * @package mod_cleanprofiles
 * @copyright  2013 onwards Denis Rebaud {@link https://denis.rebaud.fr}
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

function clean_profiles_add_firstnames($firstnames) {
    global $DB;

    foreach ($firstnames as $key => $firstname) {
        $record = new stdClass();
        $record->lcfirstname = $key;
        $record->firstname = $firstname;
        try {
            $DB->insert_record('local_cleanprofiles', $record);
        } catch (\Exception $e) {
            // Do nothing. Maybe the name already exists.
            continue;
        }
    }
    return true;
}

function xmldb_local_cleanprofiles_upgrade($oldversion=0) {
    global $DB;

    $result = true;

    if ($result && $oldversion < 2013090602) {
        $firstnames = array(
            'Agnès',
            'Amélie',
            'André',
            'Andrée',
            'Aurélie',
            'Benoît',
            'Cédric',
            'Céline',
            'Clément',
            'Danièle',
            'Édith',
            'Élisabeth',
            'Élodie',
            'Émile',
            'Émilie',
            'Éric',
            'Étienne',
            'Eugénie',
            'Ève',
            'François',
            'Françoise',
            'Frédéric',
            'Gaétan',
            'Gérard',
            'Gisèle',
            'Grégoire',
            'Grégory',
            'Gwénaël',
            'Gwénaëlle',
            'Hélène',
            'Hervé',
            'Irène',
            'Ismaël',
            'Jean-François',
            'Jean-René',
            'Jérémie',
            'Jérémy',
            'Jérôme',
            'Joël',
            'José',
            'Josée',
            'Jürgen',
            'Léonie',
            'Loïc',
            'Maël',
            'Marie-José',
            'Marie-Thérèse',
            'Marité',
            'Michèle',
            'Raphaël',
            'Raphaëlle',
            'Régis',
            'Rémi',
            'Rémy',
            'René',
            'Sébastien',
            'Stéphane',
            'Stéphanie',
            'Thérèse',
            'Vahiré',
            'Valérie',
            'Valéry',
            'Véronique'
        );
        foreach ($firstnames as $firstname) {
            $record = new stdClass();
            $lc = mb_convert_case($firstname, MB_CASE_LOWER, 'UTF-8');
            $search = explode(',', 'ç,æ,œ,á,é,í,ó,ú,à,è,ì,ò,ù,ä,ë,ï,ö,ü,ÿ,â,ê,î,ô,û,å,e,i,ø,u');
            $replace = explode(',', 'c,ae,oe,a,e,i,o,u,a,e,i,o,u,a,e,i,o,u,y,a,e,i,o,u,a,e,i,o,u');
            $record->lcfirstname = str_replace($search, $replace, $lc);
            $record->firstname = $firstname;
            $DB->insert_record('local_cleanprofiles', $record);
        }
        upgrade_plugin_savepoint(true, 2013090602, 'local', 'cleanprofiles');
    }

    if ($result && $oldversion < 2013091800) {
        $result = clean_profiles_add_firstnames(
            array(
                'angelique' => 'Angélique',
                'duarte' => 'Duarté',
                'edmee' => 'Edmée',
                'edouard' => 'Édouard',
                'eliane' => 'Éliane',
                'frederique' => 'Frédérique',
                'gael' => 'Gaël',
                'gaelle' => 'Gaëlle',
                'j-francois' => 'Jean-François',
                'j-françois' => 'Jean-François',
                'j-pierre' => 'Jean-Pierre',
                'j.-francois' => 'Jean-François',
                'j.-françois' => 'Jean-François',
                'j.-pierre' => 'Jean-Pierre',
                'j-rene' => 'Jean-René',
                'romeo' => 'Roméo'
            )
        );
        upgrade_plugin_savepoint(true, 2013091800, 'local', 'cleanprofiles');
    }
    if ($result && $oldversion < 2013091801) {
        $result = clean_profiles_add_firstnames(
            array(
                'solene' => 'Solène',
                'noemie' => 'Noémie'
            )
        );
        upgrade_plugin_savepoint(true, 2013091801, 'local', 'cleanprofiles');
    }
    if ($result && $oldversion < 2013092401) {
        $result = clean_profiles_add_firstnames(
            array(
                'aurelia' => 'Aurélia',
                'aurelien' => 'Aurélien',
                'benedicte' => 'Bénédicte',
                'celestin' => 'Célestin',
                'emilien' => 'Émilien',
                'emilienne' => 'Émilienne',
                'emeline' => 'Émeline',
                'evelyne' => 'Évelyne',
                'felix' => 'Félix',
                'frederick' => 'Frédérick',
                'gerard-phillipe' => 'Gérard-Phillipe',
                'geraud' => 'Géraud',
                'guenolee' => 'Guénolée',
                'jesus' => 'Jésus',
                'jean-stephane' => 'Jean-Stéphane',
                'jean francois' => 'Jean-François',
                'jean pierre' => 'Jean-Pierre',
                'jean-sebastien' => 'Jean-Sébastien',
                'marie-helene' => 'Marie-Hélène',
                'marlene' => 'Marlène',
                'marylene' => 'Marylène',
                'melanie' => 'Mélanie',
                'pierre-eloi' => 'Pierre-Éloi',
                'yann-eric' => 'Yann-Éric'
            )
        );
        upgrade_plugin_savepoint(true, 2013092401, 'local', 'cleanprofiles');
    }

    return $result;
}

// End of file.
