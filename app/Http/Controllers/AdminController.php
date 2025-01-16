<?php

namespace App\Http\Controllers;

use App\Libraries\Lrvbkash;
use App\Models\Home;
use App\Models\WorkshopRegistration ;
use Illuminate\Http\Request;
use App\Models\Faculty_member;
use DB;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function dashboard(){
        $doctorTitle            =   Home::getDoctorTitle();
        $totalApplicant         = WorkshopRegistration::where(['is_active'=>1,'is_payment_status'=>1])->count();
        $totalFacultyMember     = Faculty_member::where(['is_active'=>1])->count();
        $allApplicant= WorkshopRegistration::where(['is_active'=>1,'is_payment_status'=>1])->orderBy('id','DESC')->limit(10)->get();
        $totalReceivedAmnt= WorkshopRegistration::where(['is_active'=>1,'is_payment_status'=>1])->sum('received_amount');

        $ctgWiseReceived = WorkshopRegistration::selectRaw("
                CASE
                    WHEN package_category = 1 THEN 'Delegate'
                    WHEN package_category = 2 THEN 'Trainee'
                    ELSE 'Other'
                END as package_category_label,
                CASE
                    WHEN attend_days = 1 THEN 'One Day'
                    WHEN attend_days = 2 THEN 'Both Days'
                    WHEN attend_days = 3 THEN 'Both Days'
                    ELSE 'Other'
                END as attend_days_label,
                SUM(received_amount) as total_receive_amount,
                COUNT(id) as totalApplicant
            ")
            ->whereNotNull('package_category')
            ->where('is_payment_status', 1)
            ->where('received_amount', '>', 0)
            ->groupBy('package_category', 'attend_days')
            ->orderBy('package_category', 'ASC')
            ->get();

        $titleWiseReceived = WorkshopRegistration::selectRaw("
                CASE
                    WHEN title = 1 THEN 'Professor'
                    WHEN title = 2 THEN 'Associate Professor'
                    WHEN title = 3 THEN 'Senior Consultant'
                    WHEN title = 4 THEN 'Assistant Professor'
                    WHEN title = 5 THEN 'Junior Consultant'
                    WHEN title = 6 THEN 'Postgraduate Dr.'
                    WHEN title = 7 THEN 'Doctor'
                    ELSE 'Other'
                END as title_label,
                 CASE
                    WHEN attend_days = 1 THEN 'One Day'
                    WHEN attend_days = 2 THEN 'Both Days'
                    WHEN attend_days = 3 THEN 'Both Days'
                    ELSE 'Other'
                END as attend_days_label,
                SUM(received_amount) as total_receive_amount,
                COUNT(id) as totalApplicant
            ")
            ->whereNotNull('title')
            ->where('is_payment_status', 1)
            ->where('received_amount', '>', 0)
            ->groupBy('title', 'attend_days')
            ->orderBy('title', 'ASC')
            ->get();


        //  dd($ctgWiseReceived);
        return view('dashboard',compact('totalApplicant','totalFacultyMember','allApplicant','totalReceivedAmnt','ctgWiseReceived','titleWiseReceived','doctorTitle'));
    }

    public function workshopApplicant(){
        $allApplicant       =   WorkshopRegistration::where(['is_active'=>1,'is_payment_status'=>1])->get();
        $doctorTitle        =   Home::getDoctorTitle();
        return view('admin.applicant',compact('allApplicant','doctorTitle'));
    }
    public function viewApplicant($id){
        $id=decrypt($id)??'';
        if(!empty($id)){
            $applicant =    WorkshopRegistration::where('id',$id)->first();
        }else{
            $applicant =   [];
        }
        $doctorTitle      =   Home::getDoctorTitle();
        return view('admin.applicant.show',compact('applicant','doctorTitle'));
    }

    public function facultyMember(){
        $facultyMember= Faculty_member::whereIn('is_active',[1,2])->get();
        return view('admin.facultyMember',compact('facultyMember'));
    }


    public function addNewFacultyMember(){
        $facultyMemberInfo =   [];
        $country = ['UK','Turkey','Australia','India','China'];

        return view('admin.facultyMember.update',compact('facultyMemberInfo','country'));
    }

    public function updateFacultyMember($id){
        $id=decrypt($id)??'';
        if(!empty($id)){
            $facultyMemberInfo =    Faculty_member::where('id',$id)->first();
        }else{
            $facultyMemberInfo =   [];
        }
        $country = ['UK','Turkey','Australia','India','China'];
        return view('admin.facultyMember.update',compact('facultyMemberInfo','country'));
    }

    public function updatedStoreFacultyMember(Request $request)
    {

        $validatedData = $request->validate([
            'country'       => 'required| string',
            'name'          => 'required|string',
            'institute'     => 'required|string',
            'designation'   => 'required|string',
            'view_order'   => 'required',
            'image'         => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate the image
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->store('faculty_images', 'public');
        }elseif(!empty($request->hiddenImage)){
            $imagePath= $request->hiddenImage;
        }

        if(empty($request->facultyMemberId)){

            $data = [
                'image'         => $imagePath,
                'country'       => $request->country ?? NULL,
                'name'          => $request->name ?? NULL,
                'degree_info'   => $request->degree ?? NULL,
                'institute'     => $request->institute ?? NULL,
                'designation'   => $request->designation ?? NULL,
                'is_active'     => $request->is_active ?? NULL,
                'view_order'     => $request->view_order ?? NULL,
                'biography'     => $request->biography ?? NULL,
                'created_time' => date('Y-m-d H:i:s'),
                'created_ip'    =>  $request->ip()??NULL,
            ];
          //  dd($data);
            DB::table('faculty_members')->insert($data);
            return redirect('/facultyMember')->with('success', 'Successfully Save Faculty Member information ');

        }else {
            $data = [
                'image'         => $imagePath,
                'country'       => $request->country ?? NULL,
                'name'          => $request->name ?? NULL,
                'degree_info'   => $request->degree ?? NULL,
                'institute'     => $request->institute ?? NULL,
                'designation'   => $request->designation ?? NULL,
                'view_order'     => $request->view_order ?? NULL,
                'biography'     => $request->biography ?? NULL,
                'is_active'     => $request->is_active ?? NULL,
                'updated_time'  => date('Y-m-d H:i:s'),
                'updated_ip'    => $request->ip()??NULL,
            ];

            DB::table('faculty_members')->where('id', $request->facultyMemberId)->update($data);
            return redirect('/facultyMember')->with('success', 'Successfully Update faculty Member Information');
        }

    }


    public function create_bkash_token(Request $request)
    {
        if ($request->ajax() && ($request->method() == 'GET')) {
            $lrvbkash_lib = new Lrvbkash();
            $request_token = $lrvbkash_lib->create_accesstoken();
            Session::put('bkashToken', isset($request_token['id_token'])? $request_token['id_token']:null);
            return isset($request_token['id_token'])? $request_token['id_token']:null;
        }
    }

    public function create_bkash_payment(Request $request)
    {
        if ($request->ajax() && Session::has('bkashToken') && ($request->method() == 'GET')) {
            $token = Session::get('bkashToken');
            $lrvbkash_lib = new Lrvbkash();
            return $lrvbkash_lib->create_payment($token, $request->amount);
        }else{
            return response()->json([
                'success' => true,
                'authorized' => false,
                'message' => 'Only accessible from a web browser.'
            ]);
        }
    }

}
