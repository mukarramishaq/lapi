<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Teacher;
use App\Http\Resources\Teacher as TeacherResource;

class TeacherController extends Controller
{
    //
    /**
     * returns all the avaliable teachers
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        return TeacherResource::collection(Teacher::all());
    }

    /**
     * return details of specific teacher
     * @param Request $request
     * @param $id
     * @return TeacherResource|\Illuminate\Http\JsonResponse
     */
    public function show(Request $request, Teacher $teacher)
    {
        return new TeacherResource($teacher);
    }

    /**
     * create a teacher
     * @param Request $request
     * @return TeacherResource
     */
    public function store(Request $request)
    {
        $teacher = Teacher::create($request->all());
        return new TeacherResource($teacher);
    }

    /**
     * this would delete the object
     * @param Request $request
     * @param Teacher $teacher
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function delete(Request $request, Teacher $teacher)
    {
        $teacher->delete();
        return response()->json(null, 204);
    }

    /**
     * update the teacher
     * @param Request $request
     * @param Teacher $teacher
     * @return TeacherResource
     */
    public function update(Request $request, Teacher $teacher)
    {
        $teacher->update($request->all());
        return new TeacherResource($teacher);
    }
}
