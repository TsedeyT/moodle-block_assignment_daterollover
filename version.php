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

$plugin->version = 2014050100;
$plugin->cron = 3600;
$plugin->requires = 2011120500;
$plugin->component = 'block_assignment_daterollover';

