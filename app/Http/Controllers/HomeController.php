<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;
use App\Models\Activity;
use App\Models\Student;
use App\Models\Enrollment;
use App\Models\Cycle;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
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
        $activities = auth()->user()->activities;
        return view('admin.activities.work', compact('activities'));
    }

    public function register(Activity $activity)
    {
        return view('admin.activities.register', compact('activity'));
    }

    public function studentsList(Activity $activity)
    {
        $currentYear = Carbon::now()->year;
        $userId = Auth::id();
        $enrollments = Enrollment::where('activity_id', $activity->id)
            ->where('user_id', $userId)
            ->whereYear('registrationdate', $currentYear)
            ->get();

        /* $enrollments = Enrollment::join('students', 'enrollments.student_id', '=', 'students.id')
            ->join('classroom_students', 'students.id', '=', 'classroom_students.student_id')
            ->join('classrooms', 'classroom_students.classroom_id', '=', 'classrooms.id')
            ->join('cycles', 'classrooms.cycle_id', '=', 'cycles.id')
            ->join('levels', 'classrooms.level_id', '=', 'levels.id')
            ->join('grades', 'classrooms.grade_id', '=', 'grades.id')
            ->join('sections', 'classrooms.section_id', '=', 'sections.id')
            ->select(
                'students.codschool',
                'students.firstname',
                'students.lastname',
                'levels.level_name',
                'grades.grade_name',
                'sections.section_name',
                'enrollments.registrationdate'
            )
            ->whereYear('cycles.cycle_name', $currentYear) // Filtrar por el año actual
            ->orderBy('levels.order')
            ->orderBy('grades.order')
            ->orderBy('sections.order')
            ->orderBy('students.lastname')
            ->orderBy('students.firstname')
            ->get(); */
        return view('admin.activities.students', compact('activity', 'enrollments'));
    }

    public function enrollment(Request $request)
    {
        $currentYear = Carbon::now()->year;
        $cycle = Cycle::where('cycle_name', $currentYear)->first();
        $codschool = $request->input('codschool');
        $activity = Activity::find($request->input('activity'));
        $student = Student::where('codschool', $codschool)->first();
        if ($student) {
            $enrollment = Enrollment::where('student_id', $student->id)
                ->where('activity_id', $activity->id)
                ->exists();
            if (!$enrollment) {
                Enrollment::create(
                    [
                        'student_id' => $student->id,
                        'user_id' => auth()->user()->id,
                        'activity_id' => $activity->id,
                        'cycle_id' => $cycle->id,
                        'registrationdate' => date('Y-m-d H:i:s')
                    ]
                );
                return response()->make('1', 200, ['Content-Type' => 'text/plain']);
            }
        } else {
            return response()->make('0', 200, ['Content-Type' => 'text/plain']);
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
