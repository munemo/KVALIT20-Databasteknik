<?php

class Model
{

    private $db = null;

    public function __construct($database)
    {
        $this->db = $database;
    }

    public function fetchCourses()
    {
        $courses = $this->db->select("SELECT * FROM courses");
        return $courses;
    }

    public function fetchQuestions()
    {
        $questions = $this->db->select("SELECT * FROM questions");
        return $questions;
    }

    public function fetchCourseById($courses_id)
    {

        $statement = "SELECT * FROM courses WHERE course_id = :id";
        $parameters = array(':id' => $courses_id);
        $course = $this->db->select($statement, $parameters);

        if ($course) {
            return $course[0];
        }

        return false;
    }

    public function fetchAnswers($course_id, $question_id)
    {

        $statement = "  SELECT * FROM courses, surveys, answers, students
                        WHERE answers.survey_id = surveys.survey_id
                        AND courses.course_id   = surveys.course
                        AND students.student_id = surveys.student
                        AND courses.course_id   = :course_id
                        AND answers.question_id = :question_id
                        ";
        $parameters = array(':course_id' => $course_id, ':question_id' => $question_id);
        $answers = $this->db->select($statement, $parameters);

        return $answers;
    }
}
