<?php

namespace App\Http\Controllers\api;

use App\Models\Expenditure;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ExpenditureController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return response(Expenditure::all());
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show(int $id)
    {


        try{
            $response = response(Expenditure::query()->findOrFail($id));
        } catch (\Exception $e){

            return response(array('msg'=>'No data found with this id'), 404);
        }


        return  $response->content();

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {

        try{

            if(!$request->all()){
                $e = new \Exception('No data has been sent.');
                throw $e;
            }

            $request->validate([
                'description' => 'required|max:50',
                'value' => '|numeric|required',
                'date_expenditure' => 'required',
                'repeat'=>'required'
            ]);

            $expenditure = Expenditure::create($request->all());
        } catch (\Exception $e){
            return response(array('msg'=>$e->getMessage()), 400);
        }


        return response($expenditure, 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, int $id)
    {

        try{

            if(!$request->all()){
                $e = new \Exception('No data has been sent.');
                throw $e;
            }

            $expenditure = Expenditure::query()->find($id);
            $expenditure->update($request->all());
        } catch (\Exception $e){
            return response(array('msg'=>$e->getMessage()), 400);
        }

        return response($expenditure, 200);
    }

        /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     * @throws \Exception
     */
    public function destroy(int $id)
    {
        /*
        if (!auth()->user()->isAdmin()) {
            abort(403);
        }
        */


        try{
            if(!Expenditure::where('expenditure_id',$id)->delete()){
                throw new \Exception("Not found");
            }
        } catch (\Exception $e){
            return response(array('msg'=>$e->getMessage()), 404);
        }

        return response([], 204);
    }
}
