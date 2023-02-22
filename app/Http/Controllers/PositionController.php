<?php

namespace App\Http\Controllers;

use App\Http\Requests\PositionRequest;
use App\Models\Position;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    public function index()
    {
        $positions = Position::all();
        return view('position.index', compact('positions'));
    }

    public function create()
    {
        return view('position.create');
    }

    public function store(PositionRequest $request)
    {
        $data = $request->validated();
        Position::create($data);

        return redirect()->route('positions.index');
    }

    public function edit(Position $position)
    {
        return view('position.edit', compact('position'));
    }

    public function update(PositionRequest $request, Position $position)
    {
        $data = $request->validated();
        $position->update($data);

        return redirect()->route('positions.index');
    }

    public function delete(Position $position)
    {
        $position->delete();

        return redirect()->route('positions.index');
    }
}
