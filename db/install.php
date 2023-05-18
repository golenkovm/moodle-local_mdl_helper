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

/**
 * Installation scippt for the local_mdl_helper plugin.
 *
 * @package     local_mdl_helper
 * @copyright   2023 Mikhail Golenkov <mikhailgolenkov@catalyst-au.net>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

function xmldb_local_mdl_helper_install() {
    global $CFG, $DB;
    require_once($CFG->dirroot . '/user/profile/definelib.php');
    require_once($CFG->dirroot . '/user/profile/field/text/define.class.php');
    $profileclass = new \profile_define_text();

    // Create a category.
    $category1 = new \stdClass();
    $category1->sortorder = $DB->count_records('user_info_category') + 1;
    $category1->name = 'My category 1';
    $category1->id = $DB->insert_record('user_info_category', $category1, true);

    // Create a profile field.
    $field1 = (object) [
        'shortname' => 'myprofilefield1',
        'name' => 'My field 1',
        'datatype' => 'text',
        'description' => 'My field 1',
        'descriptionformat' => 1,
        'categoryid' => $category1->id,
    ];
    $profileclass->define_save($field1);

    // Create another category.
    $category2 = new \stdClass();
    $category2->sortorder = $DB->count_records('user_info_category') + 1;
    $category2->name = 'My category 2';
    $category2->id = $DB->insert_record('user_info_category', $category2, true);

    // Create another profile field.
    $field2 = (object) [
        'shortname' => 'myprofilefield2',
        'name' => 'My field 2',
        'datatype' => 'text',
        'description' => 'My field 2',
        'descriptionformat' => 1,
        'categoryid' => $category2->id,
    ];
    $profileclass->define_save($field2);
}
