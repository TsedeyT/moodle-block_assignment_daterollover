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

	require_once($CFG->dirroot.'/blocks/assignment_daterollover/assignment_daterollover_form.php');

	class block_assignment_daterollover extends block_base {




		public function init() {
			$this->title = get_string('pluginname', 'block_assignment_daterollover');
		}


		public function applicable_formats() {
			return array('course-view' => true,
					'all' => false);
		}

		public function allow_multiple() {
			return false;
		}



		public function get_content() {
			global $CFG, $COURSE, $SESSION, $DB, $PAGE;
			if ($this->content !== null) {
				return $this->content;
			}
			$this->content->text = '';
	   $context=$PAGE->context;

	$coursecontext = $context->get_course_context();
	$courseid=$coursecontext->instanceid;

			if (has_capability('block/assignment_daterollover:changedate', $coursecontext)) {
			  

			   $url = new moodle_url('/blocks/assignment_daterollover/edit.php');
				$customdata = array('coursecontext' => $coursecontext);
				$mform = new assignment_daterollover_form($url->out(), $customdata);

				$form = $mform->display();
				$this->content->text .= $form;
			}

			$this->content->footer = '';
			return $this->content;
		}

	   
		public function display_errors($errors) {
			$this->content->text .= html_writer::start_tag('div', array('class' => "errors"));
			foreach ($errors as $error) {
				$this->content->text .= $error.html_writer::empty_tag('br');
			}
			$this->content->text .= html_writer::end_tag('div');
		}
	}
