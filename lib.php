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
 * This file contains the moodle hooks for the MDL helper module.
 *
 * @package     local_mdl_helper
 * @copyright   2021 Mikhail Golenkov <mikhailgolenkov@catalyst-au.net>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * This function overrides data for timeline classification.
 *
 * @param stdClass        $course         Course record.
 * @param stdClass        $user           User record.
 * @param completion_info $completioninfo Completion record for the user.
 */
function local_mdl_helper_extend_course_classify_for_timeline(stdClass $course, stdClass $user, completion_info $completioninfo) {
    global $DB;

    $role = $DB->get_record('role', ['shortname' => 'paststudent'], 'id');

    $context = \context_course::instance($course->id);
    if (!empty($role) && user_has_role_assignment($user->id, $role->id, $context->id)) {
        // Override course end date so the course will be concerned as COURSE_TIMELINE_PAST.
        $course->enddate = time() - WEEKSECS;
    }
}