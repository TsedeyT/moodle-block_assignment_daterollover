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

global $CFG,$DB,$course,$PAGE;
require_once('../../config.php');

require_once($CFG->dirroot."/course/lib.php");

require_once($CFG->libdir.'/filelib.php');



require_once($CFG->dirroot.'/blocks/assignment_daterollover/assignment_daterollover_form.php');

require_login($SITE);
$courseid=required_param('id',PARAM_INT);

$sql3=$DB->get_fieldset_select('assign','course','course=?',array($courseid));

//if there is no assignment for the course
 if (!empty($sql3))
{


$course= $DB->get_record('course',array ('id'=>$courseid),'*',MUST_EXIST);



$coursecontext = context_course::instance($course->id);//returns an object not just an ID



require_capability('block/assignment_daterollover:changedate', $coursecontext);

block_load_class('assignment_daterollover');

$block = new block_assignment_daterollover();
$form = new assignment_daterollover_form(null, array('coursecontext' => $coursecontext));


if ($data = $form->get_data()) {



$sql2=$DB->get_fieldset_select('course','startdate','id=?',array($courseid));



$assignments = $DB->get_records('assign', array('course'=>$courseid));



$sql3=$DB->get_fieldset_select('assign','duedate','id=?',array($data->assign));
$sql4=$DB->get_fieldset_select('assign','cutoffdate','id=?',array($data->assign));
$sql5=$DB->get_fieldset_select('assign','allowsubmissionsfromdate','id=?',array($data->assign));


if ($data->updateduedate=='Adjust duedate')
{
$tdate =new DateTime();
$tdate->setTimestamp($data->date);
echo '<br> New duedate:</br>'.$tdate->format('U = Y-m-d H:i:s') . "\n";
$record = new stdClass();
$record ->id = $data->assign;
$record ->duedate = $data->date ;
$DB->update_record('assign', $record);
}
if ($data->updatecutoff=='Adjust cutoff date')
{
$tcutoff =new DateTime();
$tcutoff->setTimestamp($data->cutoff);
echo '<br> New cutoffdate:</br>'.$tcutoff->format('U = Y-m-d H:i:s') . "\n";

$cutoffrecord = new stdClass();
$cutoffrecord ->id = $data->assign;
$cutoffrecord ->cutoffdate = $data->cutoff ;
$DB->update_record('assign', $cutoffrecord);

}
if ($data->updateallowsub=='Adjust allow submission')
{
$tallowsubmission =new DateTime();
$tallowsubmission->setTimestamp($data->allowsubmission);
echo '<br> New allowsubmissionfrom:</br>'.$tallowsubmission->format('U = Y-m-d H:i:s') . "\n";
$allowsubrecord = new stdClass();
$allowsubrecord ->id = $data->assign;
$allowsubrecord ->allowsubmissionsfromdate = $data->allowsubmission ;
$DB->update_record('assign', $allowsubrecord);


}


}
}else{

redirect($CFG->wwwroot.'/course/view.php?id='.$courseid, '', 0);
}
redirect($CFG->wwwroot.'/course/view.php?id='.$courseid, '', 0);

