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
     * @param $teacher_id
     * @return TeacherResource|\Illuminate\Http\JsonResponse
     */
    public function show(Request $request, $teacher_id)
    {
        //if counrse not found
        $teacher = Teacher::find($teacher_id);
        if (!$teacher) {
            return response()->json(["error"=>["message"=> __('api.resource.notfound', ["resource"=>"teacher", "id"=>$teacher_id])]], 404);
        }

        return new TeacherResource($teacher);
    }

    /**
     * create a teacher
     * @param Request $request
     * @return TeacherResource
     */
    public function store(Request $request)
    {
    \Log::info($request->all()['data']['attributes']);
        $teacher = Teacher::create($request->all()['data']['attributes']);
        return new TeacherResource($teacher);
    }

    /**
     * this would delete the object
     * @param Request $request
     * @param $teacher_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request, $teacher_id)
    {
        //if counrse not found
        $teacher = Teacher::find($teacher_id);
        if (!$teacher) {
            return response()->json(["error"=>["message"=> __('api.resource.notfound', ["resource"=>"teacher", "id"=>$teacher_id])]], 404);
        }
        //delte the resource
        $teacher->delete();
        return response()->json(null, 204);
    }

    /**
     * update the teacher
     * @param Request $request
     * @param $teacher_id
     * @return TeacherResource|\Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $teacher_id)
    {
        //if counrse not found
        $teacher = Teacher::find($teacher_id);
        if (!$teacher) {
            return response()->json(["error"=>["message"=> __('api.resource.notfound', ["resource"=>"teacher", "id"=>$teacher_id])]], 404);
        }
        $teacher->update($request->all()['data']['attributes']);
        $teacher->save();
        return new TeacherResource($teacher);
    }


}
