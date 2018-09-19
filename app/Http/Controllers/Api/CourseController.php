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
     * @param $id
     * @return CourseResource|\Illuminate\Http\JsonResponse
     */
    public function show(Request $request, Course $course)
    {
        return new CourseResource($course);
    }

    /**
     * create a course
     * @param Request $request
     * @return CourseResource
     */
    public function store(Request $request)
    {
        $course = Course::create($request->all());
        return new CourseResource($course);
    }

    /**
     * this would delete the object
     * @param Request $request
     * @param Course $course
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function delete(Request $request, Course $course)
    {
        $course->delete();
        return response()->json(null, 204);
    }

    /**
     * update the course
     * @param Request $request
     * @param Course $course
     * @return CourseResource
     */
    public function update(Request $request, Course $course)
    {
        $course->update($request->all());
        return new CourseResource($course);
    }
}
