<?php

namespace App\Http\Controllers;

use App\Models\Book;

class BookController extends Controller
{
    function findAll()
    {
        return Book::get();
    }

    function findById($id)
    {
        return Book::find($id);
    }

    function search($search)
    {
        return Book::where('title', 'LIKE', '%' . $search . '%')->orWhere('author', 'LIKE', '%' . $search . '%')->get();
    }

    function findBySlug($slug)
    {
        return Book::where('slug', $slug)->first();
    }

    function findByYear($year)
    {
        return Book::where('year', $year)->get();
    }

    function findByPages($pages)
    {
        return Book::where('pages', '<', $pages)->get();
    }

    function getCount()
    {
        return Book::count();
    }

    function getAvgPages()
    {
        return Book::avg('pages');
    }

    function getDashboard()
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
