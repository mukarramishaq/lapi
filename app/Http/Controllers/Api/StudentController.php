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
     * @param $id
     * @return StudentResource|\Illuminate\Http\JsonResponse
     */
    public function show(Request $request, Student $student)
    {
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
     * @param Student $student
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function delete(Request $request, Student $student)
    {
        $student->delete();
        return response()->json(null, 204);
    }

    /**
     * update the student
     * @param Request $request
     * @param Student $student
     * @return StudentResource
     */
    public function update(Request $request, Student $student)
    {
        $student->update($request->all());
        return new StudentResource($student);
    }


}
