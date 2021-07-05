<?php

namespace App\Http\Controllers\cp;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Repositories\UserRepository;
use App\Http\Controllers\cp\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use App;
use Illuminate\Support\Facades\Hash;

class UserController extends AppBaseController
{
    /** @var  UserRepository */
    private $userRepository;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepository = $userRepo;
    }

    /**
     * Display a listing of the User.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        session()->flashInput($request->input());

        $users = $this->userRepository->getModelInstance();

        if ($request->q){
            $users = $users->where('name','LIKE','%'.$request->q.'%')
                ->orWhere('email','LIKE','%'.$request->q.'%');
        }
        $users = $users->orderBy('created_at', 'desc')->paginate($request->perPage)->appends('perPage', $request->perPage);
        return view('cp.users.index')->with('users', $users);
    }

    /**
     * Show the form for creating a new User.
     *
     * @return Response
     */
    public function create()
    {
        return view('cp.users.create');
    }

    /**
     * Store a newly created User in storage.
     *
     * @param CreateUserRequest $request
     *
     * @return Response
     */
    public function store(CreateUserRequest $request)
    {
        $input = $request->all();
        $input[App::getLocale()] = [
            'name'=>$request->name
        ];
        $user = $this->userRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/users.singular')]));

        return redirect(route('cp.users.index'));
    }

    /**
     * Display the specified User.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            Flash::error(__('messages.not_found', ['model' => __('models/users.singular')]));

            return redirect(route('cp.users.index'));
        }

        return view('cp.users.show')->with('user', $user);
    }

    /**
     * Show the form for editing the specified User.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            Flash::error(__('messages.not_found', ['model' => __('models/users.singular')]));

            return redirect(route('cp.users.index'));
        }

        return view('cp.users.edit')->with('user', $user);
    }

    /**
     * Update the specified User in storage.
     *
     * @param int $id
     * @param UpdateUserRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUserRequest $request)
    {
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            Flash::error(__('messages.not_found', ['model' => __('models/users.singular')]));

            return redirect(route('cp.users.index'));
        }

        $exist = $this->userRepository->where('email',$request->email)->where('id','!=',$user->id)->first();
        if ($exist){
            Flash::error(__('Email already used'));
            return back();
        }
        $user = $this->userRepository->update(array_merge($request->all(),['password'=>Hash::make($request->password)]), $id);

        Flash::success(__('messages.updated', ['model' => __('models/users.singular')]));

        return redirect(route('cp.users.index'));
    }

    /**
     * Remove the specified User from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            Flash::error(__('messages.not_found', ['model' => __('models/users.singular')]));

            return redirect(route('cp.users.index'));
        }

        if($this->userRepository->delete($id)){
            Flash::success(__('messages.deleted', ['model' => __('models/users.singular')]));

            return redirect(route('cp.users.index'));
        }

        Flash::error(__('Cannot delete user account'));

        return redirect(route('cp.users.index'));
    }
}
