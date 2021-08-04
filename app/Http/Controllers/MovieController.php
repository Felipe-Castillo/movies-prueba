<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;


use App\Http\Requests\Movie\CreateRequest;
use App\Http\Requests\Movie\UpdateRequest;
use App\Http\Requests\Movie\AssignRequest;

use App\Datatables\Movie\MovieDataTable;
use App\UseCases\Movie\Create;
use App\UseCases\Movie\Update;
use App\UseCases\Movie\Show;
use App\UseCases\Movie\Destroy;
use App\UseCases\Movie\Assign;
use GuzzleHttp\Client;

class MovieController extends Controller
{
   
	 public function getData()
    {

        $client = new Client();
        $res = $client->request('GET', '/api/movies/get-movies', []
        ]);

        return $result= $res->getBody();
    }

    public function store(
        CreateRequest $request,
        Create $create
    )
    {

         $create->execute($request);

        return response()->json([
            'message' => 'Pelicula registrada!'
        ]);
    }

    public function shift_assign(
        AssignRequest $request,
        Assign $assign
    )
    {

        $assign->execute($request->all());

        return response()->json([
            'message' => 'Turnos asignados!'
        ]);
    }

    public function update(
        UpdateRequest $request,
        Update $update
    )
    {
        $update->execute($request);

        return response()->json([
            'message' => 'Pelicula modificada!'
        ]);
    }


    public function show(
        $id,
        Show $show
    )
    {
        $model = $show->execute($id);

        return response()->json($model);
    }

   
     public function destroy(
        Destroy $destroy,
         $id
    )
    {

        $destroy->execute($id);

        return response()->json([
            'message' => "Pelicula eliminada!"
        ]);
    }
  

}
