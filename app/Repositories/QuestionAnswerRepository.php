<?php

namespace App\Repositories;

use App\Interfaces\QuestionAnswerRepositoryInterface;
use App\Models\Answer;
use App\Models\Question;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Inertia\Inertia;


class QuestionAnswerRepository implements QuestionAnswerRepositoryInterface
{

    protected Question $model;
    protected Answer $answer_model;


    /**
     * @param Question $model
     * @param Answer $answer_model
     */
    public function __construct(Question $model, Answer $answer_model)
    {
        $this->model = $model;
        $this->answer_model = $answer_model;
    }

    /**
     * store function to store question and answers
     *
     * @param  $request
     */
    public function store($request)
    {

        $question_data['question']=$request['question'];

        $new_question = $this->model->create($question_data);
        $data['answers']=$request['answers'];
        foreach ($data['answers'] as $answer) {

            $answer_data['answer']=$answer['answer'];
            $answer_data['question_id']=$new_question->id;
            $answer_data['created_by'] = auth()->user()->id;
            $answer_data['is_correct'] = $answer['correct_answer'];

            $this->answer_model->create($answer_data);

        }

        return $new_question;

    }

    public function update($data, $id)
    {
        $data['updated_by'] = auth()->user()->id;
        return $this->model->where('employee_allocation_team_member_id', $id)->update($data->all());
    }

    public function delete($id)
    {
        return $this->model->where('employee_allocation_team_member_id', $id)->delete();
    }

    public function getByTeamId($team_id)
    {
        $data= $this->model->where('team_id', $team_id);
        return $data->get();
    }

    public function getByUserId($user_id)
    {
        // TODO: Implement getByUserId() method.
    }

    public function getByTeamIdAndUserId($team_id, $user_id)
    {
        // TODO: Implement getByTeamIdAndUserId() method.
    }

    public function getByTeamIdAndUserIdWithUsers($team_id, $user_id)
    {
        // TODO: Implement getByTeamIdAndUserIdWithUsers() method.
    }

    public function getAll($request)
    {
        $data= $this->model->with('answers');
        return $data->get();

    }

    public function getById($id)
    {
        // TODO: Implement getById() method.
    }
}
