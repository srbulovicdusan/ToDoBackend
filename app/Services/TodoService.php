<?php
namespace App\Services;
interface TodoService {
    public function getAll();
    public function create($todo);
    public function delete($id);
    public function update($todo);
}