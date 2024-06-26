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
use Illuminate\Support\Collection;

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

    public function attendancetest(Activity $activity)
    {
        return view('admin.activities.attendancetest', compact('activity'));
    }

    public function studentsList(Activity $activity)
    {
        $currentYear = Carbon::now()->year;
        $cycle = Cycle::where('cycle_name', $currentYear)->first();
        $cycleId = $cycle->id;
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

                $enrollments = Enrollment::where('classroom_student_id', $classroomStudentId)->get();
                $TheEnrollment = "";
                foreach ($enrollments as $enrollment) {
                    $activityUser = ActivityUser::where('activity_id', $activity->id)
                        ->pluck('id')
                        ->first();
                    if ($enrollment->activity_user_id == $activityUser) {
                        $TheEnrollment = $enrollment->id;
                    }
                }
                if ($TheEnrollment != "") {
                    $dateNow = Carbon::now()->toDateString();
                    $timeNow = Carbon::now()->toTimeString();

                    // Verificar si ya existe una asistencia para este estudiante en la misma fecha
                    $attendance = Attendance::where('enrollment_id', $TheEnrollment)
                        ->whereDate('attendance_date', $dateNow)
                        ->first();

                    if (!$attendance) {
                        Attendance::create([
                            'enrollment_id' => $TheEnrollment,
                            'attendance_date' => $dateNow,
                            'attendance_time' => $timeNow
                        ]);
                        return response()->make('1', 200, ['Content-Type' => 'text/plain']);
                        /* $result = 'Asistencia Registrada';
                        return view('resultado', compact('result')); */
                    } else {
                        return response()->make('La asistencia para este estudiante ya ha sido registrada hoy', 200, ['Content-Type' => 'text/plain']);
                        /* $result = 'La asistencia para este estudiante ya ha sido registrada hoy';
                        return view('resultado', compact('result')); */
                    }
                } else {
                    return response()->make('No se puede registrar la asistencia, el alumno no está inscrito', 200, ['Content-Type' => 'text/plain']);
                    /* $result = 'No se puede registrar la asistencia, el alumno no está inscrito';
                    return view('resultado', compact('result')); */
                }
            } else {
                return response()->make('El Estudiante no está asignado a un grado en el año actual', 200, ['Content-Type' => 'text/plain']);
                /* $result = 'El Estudiante no está asignado a un grado en el año actual';
                return view('resultado', compact('result')); */
            }
        } else {
            return response()->make('El Estudiante no existe', 200, ['Content-Type' => 'text/plain']);
            /* $result = 'El Estudiante no existe';
            return view('resultado', compact('result')); */
        }
    }

    public function resultado($result)
    {
        return view('resultado', compact('result'));
    }

    public function report(Activity $activity)
    {
        $cycles = Cycle::all();
        return view('admin.activities.report', compact('activity', 'cycles'));
    }

    public function viewReport(Request $request)
    {
        // Obtener el mes y año deseados
        $month = $request->input('month');
        $activity = Activity::find($request->input('activity'));
        $cycle = Cycle::find($request->input('cycle'));

        // Crear una instancia de Carbon con el primer día del mes
        $startOfMonth = Carbon::createFromDate($cycle->cycle_name, $month, 1);

        // Obtener el último día del mes correctamente
        $endOfMonth = $startOfMonth->copy()->endOfMonth();

        // Inicializar una colección para almacenar las fechas del mes
        $dates = Collection::make();

        // Generar las fechas del mes usando un bucle for
        for ($date = $startOfMonth; $date->lte($endOfMonth); $date->addDay()) {
            $dates->push($date->copy()->format('Y-m-d'));
        }

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
            ->where('classrooms.cycle_id', $cycle->id)
            ->where('activity_user.activity_id', $activity->id) // Filtrar por la actividad_id deseada
            ->orderBy('levels.order')
            ->orderBy('grades.order')
            ->orderBy('sections.order')
            ->orderBy('students.lastname')
            ->orderBy('students.firstname')
            ->get([
                'enrollments.id',
                'students.codschool',
                'students.lastname',
                'students.firstname',
                'levels.level_name',
                'grades.grade_name',
                'sections.section_name'
            ]);

        // Inicializar un array para almacenar los resultados formateados
        $formattedEnrollments = [];

        // Iterar sobre las inscripciones
        foreach ($enrollments as $enrollment) {
            // Inicializar un array para almacenar la información de la inscripción
            $formattedEnrollment = [
                'id' => $enrollment->id,
                'codschool' => $enrollment->codschool,
                'lastname' => $enrollment->lastname,
                'firstname' => $enrollment->firstname,
                'level_name' => $enrollment->level_name,
                'grade_name' => $enrollment->grade_name,
                'section_name' => $enrollment->section_name,
            ];

            // Agregar las fechas del mes como claves con valores vacíos
            foreach ($dates as $date) {
                $attendance = Attendance::where('enrollment_id', $enrollment->id)
                    ->where('attendance_date', $date)
                    ->first();
                if ($attendance) {
                    $formattedEnrollment[$date] = "SI";
                } else {
                    $formattedEnrollment[$date] = "NO";
                }
            }

            // Agregar el array formateado al array de resultados
            $formattedEnrollments[] = $formattedEnrollment;
        }

        // Ahora $formattedEnrollments contiene los datos formateados que necesitas
        // Puedes usarlo en tu aplicación como necesites
        return view('admin.activities.theReport', compact('dates', 'formattedEnrollments'));
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
