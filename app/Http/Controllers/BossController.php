<?php

namespace App\Http\Controllers;

use App\Models\Boss;
use App\Services\BossService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BossController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param BossService $bossService
     * @return View
     */
    public function index(BossService $bossService, Boss $boss): View
    {
        $bossService->setReward($boss);
        $bosses = $bossService->getAllBosses();
        return view('bosses.index', compact('bosses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param Boss $boss
     * @return View
     */
    public function show(Boss $boss): View
    {
        return view('bosses.show', compact('boss'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Boss  $boss
     * @return \Illuminate\Http\Response
     */
    public function edit(Boss $boss)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Boss  $boss
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Boss $boss)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Boss  $boss
     * @return \Illuminate\Http\Response
     */
    public function destroy(Boss $boss)
    {
        //
    }
}
