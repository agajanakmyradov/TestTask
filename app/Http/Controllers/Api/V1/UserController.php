<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Http\Requests\UserStoreRequest;

class UserController extends Controller
{
    public function index() {
        return UserResource::collection(User::all());
    }

    public function store(UserStoreRequest $request) {
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->photo = $request->input('photo');
        $user->position_id = 1;
        $user->save();



        return new UserResource($user);
    }

    public function show($id) {
        return new UserResource(User::findOrFail($id));
    }
}
