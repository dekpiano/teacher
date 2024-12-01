<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method/control_login/Login_main
*/
$route['default_controller'] = 'Control_login/LoginTeacher';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


$route['ClosePage'] = "welcome/ClosePage";

$route['Logout'] = "Control_login/logout";
$route['LogoutTeacher'] = "Control_login/logoutGoogle";
$route['LoginStudent'] = "Control_login/LoginStudent";
$route['LoginTeacher'] = "Control_login/LoginTeacher";
//$route['LoginTeacher'] = "Control_login/LoginTeacherMain";

// Teacher
$route['Home'] = "ConTeacherHome/TeacherHome";
$route['Course/SendPlanAll/(:any)/(:any)'] = "ConTeacherCourse/Course/$1/$2";
$route['Course/UploadPlan'] = "ConTeacherCourse/UploadPlan";
$route['Course/LoadPlan/(:any)/(:any)/(:any)'] = "ConTeacherCourse/LoadPlan/$1/$2/$3";
$route['Course/SendPlan'] = "ConTeacherCourse/send_plan";
$route['Course/EditPlan/(:num)'] = "ConTeacherCourse/edit_plan/$1";
$route['Course/CheckPlan'] = "ConTeacherCourse/check_plan";
$route['Course/Setting'] = "ConTeacherCourse/setting_plan";
$route['Course/SettingTeacher'] = "ConTeacherCourse/setting_teacher";
$route['Course/CheckPlan/(:any)'] = "ConTeacherCourse/check_plan_lear/$1";
$route['Course/CheckPlan/(:any)/(:any)/(:any)/(:any)'] = "ConTeacherCourse/check_plan_lear_techer/$1/$2/$3/$4";
$route['Course/Delete/(:any)']['delete'] = "ConTeacherCourse/delete_plan/$1";
$route['Course/ReportPlan'] = "ConTeacherCourse/report_plan";
$route['Course/ReportPlan/(:any)'] = "ConTeacherCourse/report_plan/$1";
$route['Course/DownloadPlan'] = "ConTeacherCourse/DownloadPlan";
$route['Course/DownloadPlanZip/(:any)'] = "ConTeacherCourse/DownloadPlanZip/$1";
$route['Profile'] = "ConTeacherProfile/ProfileMain";
$route['Teaching/CheckHomeRoomMain'] = "ConTeacherTeaching/CheckHomeRoomMain";
$route['Teaching/CheckHomeRoomAdd'] = "ConTeacherTeaching/CheckHomeRoomAdd";
$route['Teaching/CheckHomeRoomStatistics'] = "ConTeacherTeaching/CheckHomeRoomStatistics";
$route['Teaching/CheckHomeRoomDashboard/(:any)'] = "ConTeacherTeaching/CheckHomeRoomDashboard/$1";
$route['Teaching/CheckTeaching'] = "ConTeacherTeaching/CheckTeaching";
$route['Teaching/RoomOnlineMain'] = "ConTeacherTeaching/RoomOnlineMain";

$route['TeacherJob/CheckNameFrontSchool'] = "ConTeacherTeacherJob/CheckNameFrontSchoolMain";

$route['Register/SaveScoreMain'] = "ConTeacherRegister/SaveScoreMain";
$route['Register/SaveScoreAdd/(:any)/(:any)/(:any)/(:any)'] = "ConTeacherRegister/SaveScoreAdd/$1/$2/$3/$4";
$route['Register/RopoetPT'] = "ConTeacherRegister/report_pt";
$route['Register/LearnRepeatMain'] = "ConTeacherRegister/LearnRepeatMain";
$route['Register/LearnRepeatAdd/(:any)/(:any)/(:any)/(:any)'] = "ConTeacherRegister/LearnRepeatAdd/$1/$2/$3/$4";
$route['Register/ReportLearnRepeat'] = "ConTeacherRegister/ReportLearnRepeat";

$route['Clubs/Main'] = "ConTeacherClubs/ClubsMain";
$route['Clubs/Report/AttendanceActivity'] = "ConTeacherClubs/ClubReportRecord";


$route['SupStd/Main'] = "ConTeacherStudentSupport/SupStdMain";
$route['SupStd/CheckWorkManager/(:any)'] = "ConTeacherStudentSupport/SupStdCheckWorkManager/$1";
$route['SupStd/CheckWorkExecutive'] = "ConTeacherStudentSupport/SupStdCheckWorkExecutive";
$route['SupStdMain/Add'] = "ConTeacherStudentSupport/SupStdAdd";


$route['BudgetPlan/Cooperative/Home'] = "BudgetPlan/ConTeacherCooperative/CooperativeMain";
$route['BudgetPlan/Cooperative'] = "BudgetPlan/ConTeacherCooperative/CooperativeShareCapital";


