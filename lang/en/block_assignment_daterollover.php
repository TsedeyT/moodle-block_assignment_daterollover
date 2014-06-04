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
     *  block_assignment_daterollover
     *
     *  This plugin adjust assignment date items which includes allowsubmissionfrom,
     *  due-date, cutoffdate, upcoming events, in a course through one centralized screen  
     *  rather than having to go into each individual assignment activity.
     *
     * @author      Tsedey Terefe <snort.test123@gmail.com>
     * @license     GNU General Public License version 3
     * @package     block
     * @subpackage  assignment_daterollover
     */
defined('MOODLE_INTERNAL') || die();


$string['pluginname'] = 'Assignment Date Rollover';
$string['pluginnameplural'] = 'Date Rollovers';
$string['adjustdate'] = ' Select a new date for current course';
$string['adjustduedate'] = ' Select duedate ';
$string['adjustcutoffdate'] = ' Select cutoff ';
$string['adjustallowsubmissiondate'] = ' Select allowsubmission  ';
$string['invaliddate'] = 'The date and time selected was invalid';
$string['nodate'] = 'No Date was selected';
$string['pastdate'] = 'The time and date selected is in the past';
$string['description'] = '';
$string['descriptionfooter'] = 'The dates for all assignments in the  current course changes by the same number of days';
$string['descriptiontitle'] = 'Enter a new course start date  for the current coures assignments click Adjust all dates. For example, if the course starts 2014-01-01 and if you change it to 2014-01-08, the dates for all current course assignments are set forward 7 days.';

$string['invalidduedate'] = 'allowsubmission should be before duedate';
$string['invalidcutoffdate'] = 'duedate should be before cutoffdate';
$string['invalidallowsubmissiondate'] = 'cutoffdate should be before allowsubmissiondate';

$string['update'] = 'Adjust All Dates';
$string['updateduedate'] = 'Adjust duedate';
$string['updatecutoff'] = 'Adjust cutoff date';
$string['updateallowsub'] = 'Adjust allow submission';




