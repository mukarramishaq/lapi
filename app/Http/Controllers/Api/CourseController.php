<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Course;
use App\Http\Resources\Course as CourseResource;

class CourseController extends Controller
{
    //
    /**
     * returns all the avaliable courses
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        return CourseResource::collection(Course::all());
    }

    /**
     * return details of specific course
     * @param Request $request
     * @param $course_id
     * @return CourseResource|\Illuminate\Http\JsonResponse
     */
    public function show(Request $request, $course_id)
    {
        //if counrse not found
        $course = Course::find($course_id);
        if (!$course) {
            return response()->json(["error"=>["message"=> __('api.resource.notfound', ["resource"=>"course", "id"=>$course_id])]], 404);
        }

        return new CourseResource($course);
    }

    /**
     * create a course
     * @param Request $request
     * @return CourseResource
     */
    public function store(Request $request)
    {
	\Log::info($request->all()['data']['attributes']);
        $course = Course::create($request->all()['data']['attributes']);
        return new CourseResource($course);
    }

    /**
     * this would delete the object
     * @param Request $request
     * @param $course_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request, $course_id)
    {
        //if counrse not found
        $course = Course::find($course_id);
        if (!$course) {
            return response()->json(["error"=>["message"=> __('api.resource.notfound', ["resource"=>"course", "id"=>$course_id])]], 404);
        }
        //delte the resource
        $course->delete();
        return response()->json(null, 204);
    }

    /**
     * update the course
     * @param Request $request
     * @param $course_id
     * @return CourseResource|\Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $course_id)
    {
        //if counrse not found
        $course = Course::find($course_id);
        if (!$course) {
            return response()->json(["error"=>["message"=> __('api.resource.notfound', ["resource"=>"course", "id"=>$course_id])]], 404);
        }
        $course->update($request->all()['data']['attributes']);
        $course->save();
        return new CourseResource($course);
    }


}
