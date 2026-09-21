<?php

namespace App\Services;

use App\Repositories\CourseRepository;

class CourseService
{
    protected CourseRepository $courseRepository;

    public function __construct(CourseRepository $courseRepository)
    {
        $this->courseRepository = $courseRepository;
    }

    public function getCourses()
    {
        return $this->courseRepository->getCourses();
    }

    public function getCourseByName(string $mataKuliah)
    {
        return $this->courseRepository->findByCourseName($mataKuliah);
    }
}