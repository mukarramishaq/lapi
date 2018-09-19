<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Student;
use App\Http\Resources\Student as StudentResource;

class StudentController extends Controller
{
    //
    /**
     * returns all the avaliable students
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        return StudentResource::collection(Student::all());
    }

    /**
     * return details of specific student
     * @param Request $request
     * @param $student_id
     * @return StudentResource|\Illuminate\Http\JsonResponse
     */
    public function show(Request $request, $student_id)
    {
        //if counrse not found
        $student = Student::find($student_id);
        if (!$student) {
            return response()->json(["error"=>["message"=> __('api.resource.notfound', ["resource"=>"student", "id"=>$student_id])]], 404);
        }

        return new StudentResource($student);
    }

    /**
     * create a student
     * @param Request $request
     * @return StudentResource
     */
    public function store(Request $request)
    {
        $student = Student::create($request->all());
        return new StudentResource($student);
    }

    /**
     * this would delete the object
     * @param Request $request
     * @param $student_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request, $student_id)
    {
        //if counrse not found
        $student = Student::find($student_id);
        if (!$student) {
            return response()->json(["error"=>["message"=> __('api.resource.notfound', ["resource"=>"student", "id"=>$student_id])]], 404);
        }
        //delte the resource
        $student->delete();
        return response()->json(null, 204);
    }

    /**
     * update the student
     * @param Request $request
     * @param $student_id
     * @return StudentResource|\Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $student_id)
    {
        //if counrse not found
        $student = Student::find($student_id);
        if (!$student) {
            return response()->json(["error"=>["message"=> __('api.resource.notfound', ["resource"=>"student", "id"=>$student_id])]], 404);
        }
        $student->update($request->all());
        $student->save();
        return new StudentResource($student);
    }


}
