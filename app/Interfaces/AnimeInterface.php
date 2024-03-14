<?php
namespace App\Interfaces;

interface AnimeInterface {

    public function store($request);

    public function show($request);

    public function update($id);
}