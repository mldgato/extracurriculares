<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
//use Illuminate\Support\Facades\Storage;
use App\Models\Activity;
use App\Models\Attendance;
use App\Models\Student;
use App\Models\Enrollment;
use App\Models\Cycle;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\ActivityUser;
use App\Models\ClassroomStudent;
//use App\Models\ClassroomStudent;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('home');
    }

    public function cycles()
    {
        return view('admin.cycles.index');
    }

    public function orderCycles()
    {
        return view('admin.cycles.order');
    }

    public function levels()
    {
        return view('admin.levels.index');
    }

    public function orderLevels()
    {
        return view('admin.levels.order');
    }

    public function grades()
    {
        return view('admin.grades.index');
    }

    public function orderGrades()
    {
        return view('admin.grades.order');
    }

    public function sections()
    {
        return view('admin.sections.index');
    }

    public function orderSections()
    {
        return view('admin.sections.order');
    }

    public function classroom()
    {
        return view('admin.classroom.index');
    }

    public function students()
    {
        return view('admin.students.index');
    }
    public function showStudents()
    {
        return view('admin.students.show');
    }
    public function users()
    {
        return view('admin.users.index');
    }
    public function profile()
    {
        $user = auth()->user();
        return view('admin.users.profile', compact('user'));
    }
    public function activities()
    {
        return view('admin.activities.index');
    }
    public function show(Activity $activity)
    {
        return view('admin.activities.show', compact('activity'));
    }

    public function work()
    {
        $activityUsers = auth()->user()->activityUser;
        $activities = $activityUsers->map(function ($activityUser) {
            return $activityUser->activity;
        });
        return view('admin.activities.work', compact('activities'));
    }

    public function registrations()
    {
        $activityUsers = auth()->user()->activityUser;
        $activities = $activityUsers->map(function ($activityUser) {
            return $activityUser->activity;
        });
        return view('admin.activities.registrations', compact('activities'));
    }

    public function presences()
    {
        $activityUsers = auth()->user()->activityUser;
        $activities = $activityUsers->map(function ($activityUser) {
            return $activityUser->activity;
        });
        return view('admin.activities.presences', compact('activities'));
    }

    public function enrolled()
    {
        $activityUsers = auth()->user()->activityUser;
        $activities = $activityUsers->map(function ($activityUser) {
            return $activityUser->activity;
        });
        return view('admin.activities.enrolled', compact('activities'));
    }

    public function assisted()
    {
        $activityUsers = auth()->user()->activityUser;
        $activities = $activityUsers->map(function ($activityUser) {
            return $activityUser->activity;
        });
        return view('admin.activities.assisted', compact('activities'));
    }

    public function register(Activity $activity)
    {
        return view('admin.activities.register', compact('activity'));
    }
    public function attendance(Activity $activity)
    {
        return view('admin.activities.attendance', compact('activity'));
    }

    public function studentsList(Activity $activity)
    {
        $currentYear = Carbon::now()->year;
        $cycle = Cycle::where('cycle_name', $currentYear)->first();
        $cycleId = $cycle->id;
        $userId = Auth::id();
        $activityId = $activity->id;

        $enrollments = Enrollment::join('classroom_students', 'enrollments.classroom_student_id', '=', 'classroom_students.id')
            ->join('classrooms', 'classroom_students.classroom_id', '=', 'classrooms.id')
            ->join('cycles', 'classrooms.cycle_id', '=', 'cycles.id')
            ->join('levels', 'classrooms.level_id', '=', 'levels.id')
            ->join('grades', 'classrooms.grade_id', '=', 'grades.id')
            ->join('sections', 'classrooms.section_id', '=', 'sections.id')
            ->join('students', 'classroom_students.student_id', '=', 'students.id')
            ->join('activity_user', 'enrollments.activity_user_id', '=', 'activity_user.id')
            ->join('activities', 'activity_user.activity_id', '=', 'activities.id')
            ->join('users', 'activity_user.user_id', '=', 'users.id')
            ->where('classrooms.cycle_id', $cycleId)
            ->where('activity_user.activity_id', $activityId) // Filtrar por la actividad_id deseada
            ->orderBy('levels.order')
            ->orderBy('grades.order')
            ->orderBy('sections.order')
            ->orderBy('students.lastname')
            ->orderBy('students.firstname')
            ->get([
                'students.codschool',
                'students.lastname',
                'students.firstname',
                'levels.level_name',
                'grades.grade_name',
                'sections.section_name',
                DB::raw('DATE_FORMAT(enrollments.registrationdate, "%d/%m/%Y %H:%i:%s") as registration_date')
            ]);


        return view('admin.activities.students', compact('activity', 'enrollments'));
    }

    public function enrollment(Request $request)
    {
        $currentYear = Carbon::now()->year;
        $cycle = Cycle::where('cycle_name', $currentYear)->first();
        $cycleId = $cycle->id;
        $codschool = $request->input('codschool');
        $activity = Activity::find($request->input('activity'));
        $student = Student::where('codschool', $codschool)->first();
        $user = Auth::id();

        if ($student) {
            $classroomStudentId = Student::findOrFail($student->id)
                ->classroomStudents()
                ->whereHas('classroom', function ($query) use ($cycleId) {
                    $query->where('cycle_id', $cycleId);
                })
                ->pluck('id')
                ->first();
            if ($classroomStudentId) {
                $activityUserId = ActivityUser::where('activity_id', $activity->id)
                    ->where('user_id', $user)
                    ->pluck('id')
                    ->first();
                if ($activityUserId) {
                    $enrollment = Enrollment::where('classroom_student_id', $classroomStudentId)
                        ->where('activity_user_id', $activityUserId)
                        ->where('status', '1')
                        ->first();
                    if (!$enrollment) {
                        $dateNow = date('Y-m-d');
                        $timeNow = date('H:i:s');
                        $datetimenow = date('Y-m-d H:i:s');
                        $enrollment = Enrollment::create(
                            [
                                'classroom_student_id' => $classroomStudentId,
                                'activity_user_id' => $activityUserId,
                                'registrationdate' => $datetimenow
                            ]
                        );
                        $attendance = Attendance::where('enrollment_id', $enrollment->id)
                            ->whereDate('attendance_date', $dateNow) // Utiliza whereDate para comparar solo la parte de fecha
                            ->first();
                        if (!$attendance) {
                            Attendance::create(
                                [
                                    'enrollment_id' => $enrollment->id,
                                    'attendance_date' => $dateNow,
                                    'attendance_time' => $timeNow
                                ]
                            );
                            return response()->make('1', 200, ['Content-Type' => 'text/plain']);
                        } else {
                            return response()->make('El Estudiante ya se ha registrado el día de hoy', 200, ['Content-Type' => 'text/plain']);
                        }
                    } else {
                        return response()->make('El Estudiante no está registrado a una actividad', 200, ['Content-Type' => 'text/plain']);
                    }
                } else {
                    return response()->make('No tiene una actividad asignada', 200, ['Content-Type' => 'text/plain']);
                }
            } else {
                return response()->make('El Estudiante no está asignado a un grado en el año actual', 200, ['Content-Type' => 'text/plain']);
            }
        } else {
            return response()->make('El Estudiante no existe', 200, ['Content-Type' => 'text/plain']);
        }
    }

    public function registerAttendance(Request $request)
    {
        $currentYear = Carbon::now()->year; //Año Actual
        $cycle = Cycle::where('cycle_name', $currentYear)->first(); //Consultamos los datos del ciclo en base al año actual: $currentYear
        $cycleId = $cycle->id; // Obtenemos el id del ciclo actual
        $codschool = $request->input('codschool'); //Carné del alumno que viene desde el request
        $activity = Activity::find($request->input('activity')); //Id de la actividad que se está tomando asistencia
        $student = Student::where('codschool', $codschool)->first(); //Obtenemos los datos del alumno tomando de referencia el carné
        $userId = Auth::id();

        if ($student) { //Si el estudiante existe
            $classroomStudentId = Student::findOrFail($student->id)
                ->classroomStudents()
                ->whereHas('classroom', function ($query) use ($cycleId) {
                    $query->where('cycle_id', $cycleId);
                })
                ->pluck('id')
                ->first();
            if ($classroomStudentId) {
                $activity_user_id = ActivityUser::where('user_id', $userId)
                    ->where('activity_id', $activity)
                    ->pluck('id')
                    ->first();
                $theEnrollment = Enrollment::where('classroom_student_id', $classroomStudentId)
                    ->where('activity_user_id', $activity_user_id)
                    ->where('status', '1')
                    ->pluck('id')
                    ->first(); //Necesito validar esto antes de pasar a la siguiente consulta
                return response()->make('El theEnrollment es: ' . $theEnrollment, 200, ['Content-Type' => 'text/plain']);
                /* if ($theEnrollment) {
                    $activityUser = ActivityUser::where('id', $theEnrollment->activity_user_id)
                        ->first(); //Necesito validar esto antes de pasar a la siguiente consulta
                    $theUser = $activityUser->user_id;
                    $activityUserId = ActivityUser::where('activity_id', $activity->id)
                        ->where('user_id', $theUser)
                        ->pluck('id')
                        ->first();
                    if ($activityUserId) {
                        $enrollment = Enrollment::where('classroom_student_id', $classroomStudentId)
                            ->where('activity_user_id', $activityUserId)
                            ->where('status', '1')
                            ->first();
                        if ($enrollment) {
                            $dateNow = Carbon::now()->toDateString();
                            $timeNow = Carbon::now()->toTimeString();

                            // Verificar si ya existe una asistencia para este estudiante en la misma fecha
                            $attendance = Attendance::where('enrollment_id', $enrollment->id)
                                ->whereDate('attendance_date', $dateNow)
                                ->first();

                            if (!$attendance) {
                                Attendance::create([
                                    'enrollment_id' => $enrollment->id,
                                    'attendance_date' => $dateNow,
                                    'attendance_time' => $timeNow
                                ]);
                                return response()->make('1', 200, ['Content-Type' => 'text/plain']);
                            } else {
                                return response()->make('La asistencia para este estudiante ya ha sido registrada hoy', 200, ['Content-Type' => 'text/plain']);
                            }
                        } else {
                            return response()->make('No se puede registrar la asistencia, el alumno no está inscrito', 200, ['Content-Type' => 'text/plain']);
                        }
                    } else {
                        return response()->make('No tiene una actividad asignada', 200, ['Content-Type' => 'text/plain']);
                    }
                } else {
                    return response()->make('El estudiante no está inscrito en la actividad extraaula', 200, ['Content-Type' => 'text/plain']);
                } */
            } else {
                return response()->make('El Estudiante no está asignado a un grado en el año actual', 200, ['Content-Type' => 'text/plain']);
            }
        } else {
            return response()->make('El Estudiante no existe', 200, ['Content-Type' => 'text/plain']);
        }
    }



    public function qrgenerator()
    {
        $alumnos = [
            '20240108' => ['Nombres' => 'Río Felipe ', 'Apellidos' => 'Carrillo Herrero'],
            '20240003' => ['Nombres' => 'Fabio Giancarlo ', 'Apellidos' => 'García Ortíz'],
            '20240099' => ['Nombres' => 'Santiago Alexander ', 'Apellidos' => 'López López'],
            '20240097' => ['Nombres' => 'Evan Yared ', 'Apellidos' => 'Martinez López'],
            '20240162' => ['Nombres' => 'Federico Esteban ', 'Apellidos' => 'Mérida Cobox'],
            '20240011' => ['Nombres' => 'Angel David  ', 'Apellidos' => 'Pérez Echeverría'],
            '20240007' => ['Nombres' => 'Diego Julián ', 'Apellidos' => 'Rodríguez Villatoro'],
            '20240002' => ['Nombres' => 'Mateo Andrés ', 'Apellidos' => 'Sazo Comparini'],
        ];
        $contador = 1;
        foreach ($alumnos as $codigo => $infoAlumno) {
            // Formar el nombre del archivo con el código, apellido y nombre
            $nombreArchivo = $contador . "_" . $codigo . '_' . $infoAlumno['Apellidos'] . '_' . $infoAlumno['Nombres'] . '.png';
            $rutaArchivo = 'public/qrcodes/' . $nombreArchivo;

            QrCode::format('png')->size(500)->generate((string)$codigo, storage_path('app/' . $rutaArchivo));
            $contador++;
            // Puedes guardar la ruta del archivo y la información del alumno en tu base de datos si es necesario
            // Por ejemplo, puedes guardar $rutaArchivo, $codigo, $infoAlumno['Nombres'], $infoAlumno['Apellidos'] en la base de datos
        }

        return view('admin.qr.index', compact('alumnos'));
    }


    public function scanQr()
    {
        return view('admin.qr.scan-qr');
    }
}
