<?php  // Moodle configuration file

unset($CFG);
global $CFG;

global $PAGE;
global $USER;

$CFG = new stdClass();


// $CFG->dbtype    = 'pgsql';
// $CFG->dblibrary = 'native';
// $CFG->dbhost    = 'localhost';
// $CFG->dbname    = 'moodle4_1_13';
// $CFG->dbuser    = 'postgres';
// $CFG->dbpass    = '1307x2Npk';
// $CFG->prefix    = 'mdl_';
// $CFG->dboptions = array (
//   'dbpersist' => 0,
//   'dbport' => 5432,
//   'dbsocket' => '',
// );
$CFG->dbtype    = 'pgsql';
$CFG->dblibrary = 'native';
$CFG->dbhost    = 'moodle.cd2wy4iagdv9.ap-southeast-1.rds.amazonaws.com';
$CFG->dbname    = 'moodle';
$CFG->dbuser    = 'postgres';
$CFG->dbpass    = '1307x2Npk';
$CFG->prefix    = 'mdl_';
$CFG->dboptions = array (
  'dbpersist' => 0,
  'dbport' => 5432,
  'dbsocket' => '',
);

// change when deploy //
$CFG->wwwroot   = 'http://localhost:8080/moodle4113';
$CFG->dataroot  = __DIR__.'/data/moodledata4113';
$CFG->admin     = 'admin';

$CFG->directorypermissions = 0777;

require_once(__DIR__ . '/lib/setup.php');


$CFG->cachejs = false;
// There is no php closing tag in this file,
// it is intentional because it prevents trailing whitespace problems!

$PAGE->requires->js_call_amd('theme_boost/widget', 'init',[[
'userId' => $USER->id,
'courseId' => 3
//'courseId' => $PAGE->course->id
// params passed in the module init()
]]);