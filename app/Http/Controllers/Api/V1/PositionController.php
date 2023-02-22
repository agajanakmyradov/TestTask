<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Position;
use App\Http\Resources\PositionResource;

class PositionController extends Controller
{
    public function index() {
        return PositionResource::collection(Position::all());
    }
}
