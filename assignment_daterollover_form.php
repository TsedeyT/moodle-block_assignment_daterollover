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
if (!defined('MOODLE_INTERNAL')) {
    die();
}
require_once($CFG->libdir.'/formslib.php');

global $course;
class assignment_daterollover_form extends moodleform {

    public function definition() {
        global $DB;

        $mform =& $this->_form;
        $coursecontext = $this->_customdata['coursecontext'];
       
        $courseid=required_param('id',PARAM_INT);
        $assignments = $DB->get_records('assign', array('course'=>$courseid));

        $assignlist = array();
        foreach($assignments as $key=>$value)
            {
                 // print_object($value->name);
                 $assignlist[$value->id]=$assignments[$key]->name;
                //print_object( $studentlist[$value->id]);
            }
       $mform->addElement('select','assign', get_string('description', 'block_assignment_daterollover'), $assignlist);
	

        
      // $mform->addElement('static', 'description', '' ,get_string('descriptiontitle','block_assignment_daterollover'));

        /**
         *  set id to the value $course->id
         *
         **/
       $mform->addElement('hidden', 'id', $coursecontext->instanceid);
       $mform->setType('id',PARAM_INT);  

       

        $years= array(
        'startyear' => 1970, 
        'stopyear'  => 2030,
        'timezone'  => 99,
        'step'      => 5
        );
        $mform->addElement('date_time_selector','date', get_string('adjustduedate', 'block_assignment_daterollover'),$years);
        $mform->addElement('submit', 'updateduedate', get_string('updateduedate', 'block_assignment_daterollover'));




        $mform->addElement('date_time_selector','cutoff',get_string('adjustcutoffdate', 'block_assignment_daterollover'),$years);
        $mform->addElement('submit', 'updatecutoff', get_string('updatecutoff', 'block_assignment_daterollover'));



        $mform->addElement('date_time_selector','allowsubmission',get_string('adjustallowsubmissiondate', 'block_assignment_daterollover'),$years);    
        $mform->addElement('submit', 'updateallowsub', get_string('updateallowsub', 'block_assignment_daterollover'));  


       /**
	*required -if the value is not empty, integer 0 is not considered an empty value.
	*
       **/
       $mform->addRule('date', null, 'required', null, 'server');
       $mform->addRule('cutoff', null, 'required', null, 'server');
       $mform->addRule('allowsubmission', null, 'required', null, 'server');
     
 $mform->getSubmitValues();



    }

    public function validate($data) {
        $errors= array();
        if (empty($data['date']) || $data['date'] == -1) {
            $errors['date'] = get_string('invaliddate', 'block_assignment_daterollover');
        } 
	if ($data['allowsubmission'] &&  $data['date']) {
		if($data['allowsubmission'] > $data['date'])
		{
		 $errors['date'] = get_string('invalidduedate', 'block_assignment_daterollover');
		}
       
        }
	if ($data['date'] &&  $data['cutoff']) {
		if($data['date'] > $data['cutoff'])
		{
		 $errors['cutoff'] = get_string('invalidcutoffdate', 'block_assignment_daterollover');
		}
       
        }

	if ($data['allowsubmission'] &&  $data['cutoff']) {
		if($data['allowsubmission'] > $data['cutoff'])
		{
		 $errors['allowsubmission'] = get_string('invalidallowsubmissiondate', 'block_assignment_daterollover');
		}
       
        }


        return $errors;
    }

    public function display() {
        //finalize the form definition if not yet done
        if (!$this->_definition_finalized) {
            $this->_definition_finalized = true;
            $this->definition_after_data();
        }
        ob_start();
        $this->_form->display();
        $form = ob_get_clean();

        return $form;
    }


}//class
