<?php

namespace App\Http\Controllers;

use App\Models\Home;
use App\Models\WorkshopRegistration ;
use Illuminate\Http\Request;
use App\Models\Faculty_member;
use Illuminate\Support\Facades\Artisan;
use DB;
class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('frontDirectory.index');
    }
    public function about()
    {
        return view('frontDirectory.about');
    }
    public function contact()
    {
        return view('frontDirectory.contact');
    }
    public function registration()
    {
        $doctorTitle      =   Home::getDoctorTitle();
        return view('frontDirectory.registration',compact('doctorTitle'));
    }


    public function Breastbdcon2024()
    {
        $UK             =   Faculty_member::where('country','UK')->get();
        $Turkey         =   Faculty_member::where('country','Turkey')->get();
        $Australia      =   Faculty_member::where('country','Australia')->get();
        $India          =   Faculty_member::where('country','India')->get();
        return view('frontDirectory.Breastbdcon2024',compact('UK','Turkey','Australia','India'));
    }
    public function internationalFaculty()
    {
        $UK             =   Faculty_member::where('country','UK')->where('is_active',1)->orderBy('view_order','ASC')->get();
        $Turkey         =   Faculty_member::where('country','Turkey')->where('is_active',1)->orderBy('view_order','ASC')->get();
        $Australia      =   Faculty_member::where('country','Australia')->where('is_active',1)->orderBy('view_order','ASC')->get();
        $India          =   Faculty_member::where('country','India')->where('is_active',1)->orderBy('view_order','ASC')->get();
        $China          =   Faculty_member::where('country','China')->where('is_active',1)->orderBy('view_order','ASC')->get();

        return view('frontDirectory.internationalFaculty',compact('UK','Turkey','Australia','India','China'));
    }
    public function scientificSession()
    {
        return view('frontDirectory.scientificSession');
    }

    public function registrationSuccess($id)
    {
        $id=decrypt($id);
        if(!empty($id)) {
            $doctorTitle      =   Home::getDoctorTitle();
            $registrationInfo = WorkshopRegistration::where('id', $id)->first();
            return view('frontDirectory.registrationSuccess', compact('registrationInfo','doctorTitle'));
        }
    }

    public function regSuccess($id)
    {
        $id=decrypt($id);
        if(!empty($id)) {
            $doctorTitle      =   Home::getDoctorTitle();
            $registrationInfo = WorkshopRegistration::where('id', $id)->first();
            return view('frontDirectory.regSuccess', compact('registrationInfo','doctorTitle'));
        }
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title'         => 'required| integer',
            'name'          => 'required|string',
            'institute'     => 'required|string',
            'mobile'        => 'required|string',
            'email'     => [
                'required',
                'string',
                'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/',
            ],
        ]);

        $data=[
            'title'         =>  $request->title??NULL,
            'member_id'     =>  date('ymd').rand(999,10000),
            'name'          =>  $request->name??NULL,
            'institute'     =>  $request->institute??NULL,
            'degree'        =>  $request->degree??NULL,
            'mobile'        =>  $request->mobile??NULL,
            'email'         =>  $request->email??NULL,
            'subs_ctg'      =>  1,
            'attend_days'   =>  $request->presentDays??NULL,
            'amount'        =>  $request->amount??'0.00',
            'is_payment_status' =>0,
            'created_at'    =>date('Y-m-d H:i:s'),
            'created_ip'    =>'NULL',
          ];
        $insertedId = DB::table('workshop_registration')->insertGetId($data);
        return redirect('/registrationSuccess/'.encrypt($insertedId));

    }




    /**
     * Display the specified resource.
     */
    public function generateStorageLink()
    {
        try {
            // Run the artisan command
            Artisan::call('storage:link');

            // Get the output for feedback
            $output = Artisan::output();

            // Return or display the output
            return response()->json(['message' => 'Storage link created successfully.', 'output' => $output]);
        } catch (\Exception $e) {
            // Handle any errors
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function viewFacultyDetails($id)
    {
        $id=decrypt($id);
        if(!empty($id)) {
            $facultyMember = Faculty_member::where('id', $id)->first();
            return view('frontDirectory.viewFacultyDetails', compact('facultyMember'));
        }
    }

    public function invitation()
    {
            return view('frontDirectory.invitation');

    }


}
