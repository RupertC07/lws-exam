<?php
namespace App\Interfaces;

interface AnimeInterface {

    public function index($request);

    public function store($request);

    public function show($request);

    public function update($request);

    public function delete($request);
}