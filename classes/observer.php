<?php
// This file is part of Moodle - https://moodle.org/
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
// along with Moodle.  If not, see <https://www.gnu.org/licenses/>.

/**
 * Event observer.
 *
 * @package     local_mdl_helper
 * @copyright   2021 Mikhail Golenkov <mikhailgolenkov@catalyst-au.net>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_mdl_helper;

defined('MOODLE_INTERNAL') || die();

class observer {

    /**
     * Does a DB query to the mdl_user_lastaccess table.
     *
     * @param \core\event\user_enrolment_created $event
     */
    public static function query_user_lastaccess(\core\event\user_enrolment_created $event) {
        global $DB;
        // Get records with a random conditions, so table columns will be cached and
        // this will break some core unit tests. See MDL-72239 for details.
        $DB->get_records('user_lastaccess', ['id' => 1]);
    }
}
