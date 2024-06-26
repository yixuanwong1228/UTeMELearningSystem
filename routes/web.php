<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\LecturerController;

use App\Http\Controllers\Student\StudentController;
use App\Http\Controllers\Student\LessonController as StudentLessonController;
use App\Http\Controllers\Student\AssignmentController as StudentAssignmentController;
use App\Http\Controllers\Student\QuizController as StudentQuizController;
use App\Http\Controllers\Student\AttendanceController as StudentAttendanceController;

use App\Http\Controllers\Lecturer\LecturerHomeController;
use App\Http\Controllers\Lecturer\LessonController as LecturerLessonController;
use App\Http\Controllers\Lecturer\QuizController as LecturerQuizController;
use App\Http\Controllers\Lecturer\AttendanceController as LecturerAttendanceController;
use App\Http\Controllers\Lecturer\AnnouncementController;
use App\Http\Controllers\Lecturer\AssignmentController as LecturerAssignmentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/home',[HomeController::class,'redirect']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::group([
    'prefix' => 'admin',
    'as' => 'admin.',
    'namespace' => 'Admin'
], function () {
    Route::get('/showcourses', [CourseController::class, 'showcourses'])->name('showcourses');
    Route::get('/display_edit_course/{id}', [CourseController::class, 'display_edit_course'])->name('displayCourse');
    Route::post('edit_course/{id}', [CourseController::class, 'edit_course'])->name('edit_course');
    Route::get('/showlecturers', [LecturerController::class, 'showlecturers'])->name('showlecturers');
    Route::get('/add_lecturer',[LecturerController::class,'add_lecturer'])->name('add_lecturer');
    Route::get('/view_lecturer/{id}', [LecturerController::class, 'view_lecturer'])->name('view_lecturer');
    Route::get('/add_course',[CourseController::class,'add_course'])->name('add_course');
    Route::post('register_lecturer', [LecturerController::class, 'register_lecturer'])->name('register_lecturer');
    Route::post('register_course', [CourseController::class, 'register_course'])->name('register_course');
    Route::get('course_details/{id}', [CourseController::class, 'course_details'])->name('course_details');
    Route::post('/assign_lecturer',[CourseController::class,'assign_lecturer'])->name('assign_lecturer');

});

Route::group([
    'prefix' => 'student',
    'as' => 'student.',
    'namespace' => 'Student'
], function () {
    Route::get('/list_course', [StudentController::class, 'listCourses'])->name('list_course');
    Route::get('/search_course', [StudentController::class, 'searchCourses'])->name('search_course');
    Route::get('/course_details/{id}', [StudentController::class, 'course_details'])->name('course_details');
    Route::post('/enroll_course',[StudentController::class,'enroll_course'])->name('enroll_course');
    Route::get('/lesson/{id}', [StudentController::class, 'showLesson'])->name('lesson');
    Route::get('/add-submission/{id}', [StudentAssignmentController::class, 'showSubmissionForm'])->name('add_submission');
    Route::get('/lessons/lesson_detail{id}', [StudentLessonController::class, 'show'])->name('lesson_detail');
    Route::post('/submit-assignment', [StudentAssignmentController::class, 'submitAssignment'])->name('submit_assignment');
    Route::get('/assignment/{id}', [StudentController::class, 'showAssignment'])->name('assignment');
    Route::get('/assignments/tobe-completed/{id}', [StudentAssignmentController::class, 'showToBeCompleted'])->name('tobe_completed');
    Route::get('/assignments/completed', [StudentAssignmentController::class, 'showCompleted'])->name('completed_assignments');
    Route::get('/assignments/completed/feedback/{id}', [StudentAssignmentController::class, 'viewFeedback'])->name('view_feedback');
    Route::get('/quizzes/tobe-completed/{id}', [StudentQuizController::class, 'toBeCompleted'])->name('tobe_quiz');
    Route::get('/quizzes/completed', [StudentQuizController::class, 'completed'])->name('completed_quiz');
    Route::get('/quiz/start/{id}', [StudentQuizController::class, 'start'])->name('start_quiz');
    Route::post('/quizzes/submit/{id}', [StudentQuizController::class, 'submitQuiz'])->name('submit_quiz');
    Route::get('/attendance/{id}', [StudentAttendanceController::class, 'showAttendance'])->name('attendance');
    Route::get('/showPastAttendance', [StudentAttendanceController::class, 'showPastAttendance'])->name('showPastAttendance');
    Route::get('/submit_attendance/{id}', [StudentAttendanceController::class, 'submit_attendance'])->name('submit_attendance');
    Route::get('/quizzes/preview/{id}', [StudentQuizController::class, 'previewQuiz'])->name('preview_quiz');

});

// Lecturer Routes
Route::group([
    'prefix' => 'lecturer',
    'as' => 'lecturer.',
    'namespace' => 'Lecturer'
], function () {
    Route::get('/home', [LecturerHomeController::class, 'home'])->name('home');
    Route::get('/view_lesson/{id}', [LecturerLessonController::class, 'view_lesson'])->name('view_lesson');
    Route::get('/add_lesson', [LecturerLessonController::class, 'add_lesson'])->name('add_lesson');
    Route::post('/store_lesson', [LecturerLessonController::class, 'store_lesson'])->name('store_lesson');
    Route::get('/edit_lesson/{id}', [LecturerLessonController::class, 'edit_lesson'])->name('edit_lesson');
    Route::put('/edit_lessons/{id}',[LecturerLessonController::class, 'update_lesson'])->name('update_lesson');
    Route::post('/delete_lesson', [LecturerLessonController::class, 'delete_lesson'])->name('delete_lesson');
    Route::get('/detail/lecture_note{id}', [LecturerLessonController::class, 'lesson_detail'])->name('lesson_detail');
    Route::get('/quiz_index/{id}', [LecturerQuizController::class, 'index'])->name('quiz_index');
    Route::get('/quiz_details/{quizID}', [LecturerQuizController::class, 'details'])->name('quiz_details');
    Route::get('/add_question/{quizID}', [LecturerQuizController::class, 'add_question'])->name('add_question');
    Route::get('/attendance_index/{id}', [LecturerAttendanceController::class, 'index'])->name('attendance_index');
    Route::post('/add_attendance', [LecturerAttendanceController::class, 'add_attendance'])->name('add_attendance');
    Route::get('/showStudentAttendance/{id}', [LecturerAttendanceController::class, 'showStudentAttendance'])->name('showStudentAttendance');
    Route::get('/assignment_index/{id}', [LecturerAssignmentController::class, 'index'])->name('assignment_index');
    Route::post('/add_assignment', [LecturerAssignmentController::class, 'add_assignment'])->name('add_assignment');
    Route::get('/edit_assignment_view/{id}', [LecturerAssignmentController::class, 'edit_assignment_view'])->name('edit_assignment_view');
    Route::post('/edit_assignment/{id}', [LecturerAssignmentController::class, 'edit_assignment'])->name('edit_assignment');
    Route::post('/submit_feedback', [LecturerAssignmentController::class, 'submit_feedback'])->name('submit_feedback');
    Route::get('/assignment_submission/{id}', [LecturerAssignmentController::class, 'assignment_submission'])->name('assignment_submission');
    Route::get('/assignment_give_feedback/{studentID}/{assignmentID}', [LecturerAssignmentController::class, 'give_feedback'])->name('assignment_give_feedback');
    Route::post('/add_quiz', [LecturerQuizController::class, 'add_quiz'])->name('add_quiz');
    Route::post('/add_question_post', [LecturerQuizController::class, 'add_question_post'])->name('add_question_post');
    Route::get('/quiz_submissions/{quizID}', [LecturerQuizController::class, 'view_submissions'])->name('quiz_submissions');
    Route::get('/quiz_preview_submission/{quizID}/{studentID}', [LecturerQuizController::class, 'preview_submission'])->name('preview_quiz_submission');
    Route::get('/announcement_index', [AnnouncementController::class, 'index'])->name('announcement_index');
    Route::post('/add_announcement', [AnnouncementController::class, 'add_announcement'])->name('add_announcement');
    Route::patch('/edit_announcements/{id}/edit', [AnnouncementController::class, 'edit_announcement'])->name('edit_announcement');
    Route::delete('/delete_announcements/{id}', [AnnouncementController::class, 'delete_announcement'])->name('delete_announcement');
    Route::get('/edit_question/{questionID}', [LecturerQuizController::class, 'edit_question'])->name('edit_question');
    Route::post('/edit_question_post/{questionID}', [LecturerQuizController::class, 'edit_question_post'])->name('edit_question_post');

});


//ajax api
Route::get('/quizzes/{quizID}/questions', [StudentQuizController::class, 'getQuestions']);
Route::get('/lecturer/quizzes/{quizID}/{studentID}/questions', [LecturerQuizController::class, 'getQuestions']);
Route::post('/student/save-selection', [StudentQuizController::class, 'saveSelection'])->name('save_selection');
Route::get('/student/quiz/{quizID}/displaymarks', [StudentQuizController::class, 'displayMarks']);
Route::get('/student/quizzes/completed', [StudentQuizController::class, 'completed'])->name('student.quizzes.completed');
Route::get('/lecturer/quizzes/view_submissions/{id}', [LecturerQuizController::class, 'view_submissions']);



