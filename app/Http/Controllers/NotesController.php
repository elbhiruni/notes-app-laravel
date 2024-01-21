<?php

namespace App\Http\Controllers;

use App\Models\Notes;
use Illuminate\Http\Request;

class NotesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $notes = Notes::get();

        foreach ($notes as $note) {
            $note['tags'] = explode(',', $note['tags']);

            $note['createdAt'] = $note['created_at'];
            $note['updatedAt'] = $note['created_at'];

            unset($note['created_at']);
            unset($note['updated_at']);
        }

        return response()->json([
            'status' => 'success',
            'data'=> [
                'notes' => $notes,
            ]
        ]);
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
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'body' => 'required|string|max:255',
                'tags' => 'required|array|max:255',
            ]);

            $tags = implode(',', $validated['tags']);

            $notes = Notes::create([
                ...$validated,
                'tags' => $tags,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Catatan berhasil ditambahkan',
                'data' => [
                    'noteId' => $notes->id
                ],
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], $e->status ?? 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Notes $notes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Notes $notes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Notes $notes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Notes $notes)
    {
        //
    }
}
