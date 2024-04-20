<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuestionAnswerRequest;
use App\Http\Resources\Registration\TeamMemberCollection;
use App\Models\Question;
use App\Services\QuestionAnswerService;
use Illuminate\Http\Request;
use Inertia\Inertia;
class QuestionController extends Controller
{

    /**
     * @var QuestionAnswerService
     */
    private $service;

    public function __construct(QuestionAnswerService $service){
        $this->service = $service;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
          $result = $this->service->getAll($request);
        return showCompoundMessage(200, "", $result, "", "", 1);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
        public function store(QuestionAnswerRequest $request)
    {
        return $this->service->store($request);


    }

    /**
     * Display the specified resource.
     */
    public function show(Question $question)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Question $question)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Question $question)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Question $question)
    {
        //
    }
}
