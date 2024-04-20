<?php

namespace App\Repositories\Registration;

use App\Interfaces\PollRepositoryInterface;
use App\Models\Polls;


class PollRepository implements PollRepositoryInterface
{

    protected Polls $model;


    public function __construct(Polls $model)
    {
        $this->model = $model;
    }

    public function getAll($request)
    {

// Fetch data from team member model along with specific columns
// from related tables 'employee', 'team', and 'member_type'
        $data = $this->model->with( ['employee' => function ($query) {
            $query->select('employee_id','first_name','last_name');
        }])
            ->with(['team' => function ($query) {
                $query->select('team_id','branch_id', 'team_name');
            }])
            ->with(['member_type' => function ($query) {
                $query->select('member_type_id', 'member_type_name');
            }]);

        $branch_id = $request->has('branch_id') ? $request->branch_id : "";
        $team_id = $request->has('team_id') ? $request->team_id : "";

        $team_details = $request->has('team_details') ? $request->team_details : "";

        $search_terms = $request->has('search_terms') ? $request->search_terms : "";

        //now check based on passed filters from the common search bar
        if(!empty($branch_id)){
            $data = $data->whereHas('team', function ($query) use ($branch_id) {
                $query->where('branch_id', $branch_id);
            });
        }

        if(!empty($team_id)){
            $data = $data->where('team_id', $team_id);
        }

        if(!empty($team_details)){

            $data = $data->whereHas('team', function ($query) use ($team_details) {
                $query->whereHas('employee', function ($query) use ($team_details) {
                    $query->where('first_name', 'like', '%' . $team_details . '%')
                        ->orWhere('last_name', 'like', '%' . $team_details . '%');
                });
            });
        }


        $report = $request->has('report') ? $request->report : "";
        if ($report) {
            return $data->get();
        }
        $limit = $request->get('limit', config('app.pagination_limit'));
        return $data->paginate($limit);
    }

    public function getById($id)
    {

        return $this->model->where('employee_allocation_team_member_id', $id)->with( ['employee' => function ($query) {
            $query->select('employee_id','first_name','last_name');
        }])
            ->with(['team' => function ($query) {
                $query->select('team_id','branch_id', 'team_name');
            }])
            ->with(['member_type' => function ($query) {
                $query->select('member_type_id', 'member_type_name');
            }])->first();
    }

    public function store($data)
    {
        $item = new $this->model;
        $data['company_id'] = getLoggedUserActiveCompany()->company_id;
        $data['created_by'] = auth()->user()->id;
        return $item->create($data->all());
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
}
