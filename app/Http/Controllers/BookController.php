<?php

namespace App\Http\Controllers;

use App\Models\Book;

class BookController extends Controller
{
    public function findAll()
    {
        return Book::get();
    }

    public function findById($id)
    {
        return Book::find($id);
    }

    public function search($search)
    {
        return Book::where('title', 'LIKE', '%' . $search . '%')->orWhere('author', 'LIKE', '%' . $search . '%')->get();
    }

    public function findBySlug($slug)
    {
        return Book::where('slug', $slug)->first();
    }

    public function findByYear($year)
    {
        return Book::where('year', $year)->get();
    }

    public function findByPages($pages)
    {
        return Book::where('pages', '<', $pages)->get();
    }

    public function getCount()
    {
        return Book::count();
    }

    public function getAvgPages()
    {
        return Book::avg('pages');
    }

    public function getDashboard()
    {
        $oldestBook = Book::orderBy('year', 'asc')->first();
        $newestBook = Book::orderBy('year', 'desc')->first();

        return [
            "books" => Book::count(),
            "pages" => Book::sum('pages'),
            "oldest" => $oldestBook ? $oldestBook->title : null,
            "newest" => $newestBook ? $newestBook->title : null];
    }
}
