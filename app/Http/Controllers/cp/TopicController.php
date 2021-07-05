<?php

namespace App\Http\Controllers\cp;

use App\Http\Requests\CreatetopicRequest;
use App\Http\Requests\UpdatetopicRequest;
use App\Repositories\topicRepository;
use App\Http\Controllers\cp\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use App;
use App\Models\Topic;
use Illuminate\Support\Facades\Hash;

class TopicController extends AppBaseController
{

    /**
     * Display a listing of the topic.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        session()->flashInput($request->input());

        $items = Topic::query();

        // if ($request->q){
        //     $topics = $topics->where('name','LIKE','%'.$request->q.'%')
        //         ->orWhere('email','LIKE','%'.$request->q.'%');
        // }
        $items = $items->orderBy('created_at', 'desc')->paginate($request->perPage)->appends('perPage', $request->perPage);
        return view('cp.topics.index')->with('items', $items);
    }

    /**
     * Show the form for creating a new topic.
     *
     * @return Response
     */
    public function create()
    {
        return view('cp.topics.create');
    }

    /**
     * Store a newly created topic in storage.
     *
     * @param CreatetopicRequest $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $input[App::getLocale()] = [
            'name'=>$request->name
        ];
        $topic = Topic::create($input);

        Flash::success(__('messages.saved', ['model' => __('models/topics.singular')]));

        return redirect(route('cp.topics.index'));
    }

    /**
     * Display the specified topic.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $item = Topic::find($id);

        if (empty($item)) {
            Flash::error(__('messages.not_found', ['model' => __('models/topics.singular')]));

            return redirect(route('cp.topics.index'));
        }

        return view('cp.topics.show')->with('topic', $item);
    }

    /**
     * Show the form for editing the specified topic.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $topic = Topic::find($id);

        if (empty($topic)) {
            Flash::error(__('messages.not_found', ['model' => __('models/topics.singular')]));

            return redirect(route('cp.topics.index'));
        }

        return view('cp.topics.edit')->with('topic', $topic);
    }

    /**
     * Update the specified topic in storage.
     *
     * @param int $id
     * @param UpdatetopicRequest $request
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
        $topic = Topic::find($id);

        if (empty($topic)) {
            Flash::error(__('messages.not_found', ['model' => __('models/topics.singular')]));

            return redirect(route('cp.topics.index'));
        }

        $exist = Topic::where('email',$request->email)->where('id','!=',$topic->id)->first();
        if ($exist){
            Flash::error(__('Email already used'));
            return back();
        }
        $topic = Topic::where('id',$id)->update($request->all());

        Flash::success(__('messages.updated', ['model' => __('models/topics.singular')]));

        return redirect(route('cp.topics.index'));
    }

    /**
     * Remove the specified topic from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $topic = Topic::find($id);

        if (empty($topic)) {
            Flash::error(__('messages.not_found', ['model' => __('models/topics.singular')]));

            return redirect(route('cp.topics.index'));
        }

        if(Topic::where('id',$id)->delete()){
            Flash::success(__('messages.deleted', ['model' => __('models/topics.singular')]));

            return redirect(route('cp.topics.index'));
        }

        Flash::error(__('Cannot delete topic account'));

        return redirect(route('cp.topics.index'));
    }
}
