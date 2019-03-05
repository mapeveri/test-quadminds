<?php

namespace App\Http\Controllers\API;

use Validator;
use App\Note;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $notes = Note::all();
        } catch (\Exception $e) {
            return response()->apiMessage($e->getMessage());
        }

        return response()->api($notes, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $validator = $this->validateData($request);

            if ($validator->fails()) {
                return response()->apiMessage("Invalid data.");
            } else {
                $note = Note::create($request->all());
            }
        } catch (\Exception $e) {
            return response()->apiMessage($e->getMessage());
        }

        return response()->api($note, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $note = Note::findOrFail($id);
        } catch (\Exception $e) {
            return response()->apiMessage($e->getMessage());
        }

        return response()->api($note, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $note = Note::findOrFail($id);

            $validator = $this->validateData($request);

            if ($validator->fails()) {
                return response()->apiMessage("Invalid data.");
            } else {
                $note->update($request->all());
            }
        } catch (\Exception $e) {
            return response()->apiMessage($e->getMessage());
        }

        return response()->api($note, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $success = true;

        try {
            $note = Note::findOrFail($id);
            $note->delete();
        } catch (\Exception $e) {
            $success = false;
        }

        return response()->api($success, 200);
    }

    private function validateData($request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'content' => 'required',
        ]);

        return $validator;
    }
}
