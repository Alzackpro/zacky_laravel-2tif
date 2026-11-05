<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $request->validate([
            'nama'       => 'required|min:5',
            'email'      => ['required', 'email'],
            'pertanyaan' => 'required|min:10|max:300',
        ], [
            'nama.required'       => 'Nama wajib diisi.',
            'nama.min'            => 'Nama minimal 5 karakter.',
            'email.required'      => 'Email wajib diisi.',
            'email.email'         => 'Format email tidak valid.',
            'pertanyaan.required' => 'Pertanyaan wajib diisi.',
            'pertanyaan.min'      => 'Pertanyaan minimal 10 karakter.',
            'pertanyaan.max'      => 'Pertanyaan maksimal 300 karakter.',
        ]);

        $info = 'Terima kasih <b>' . e($request->nama) . '</b>! Pertanyaan Anda <i>"' . e($request->pertanyaan) . '"</i> '
            . 'sudah kami terima dan akan dibalas melalui email <b>' . e($request->email) . '</b>.';

        return redirect()->route('home')->with('info', $info);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
