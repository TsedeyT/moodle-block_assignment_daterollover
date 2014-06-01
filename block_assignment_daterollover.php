<?php


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
