<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Product;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        Comment::withTrashed()->get();
        Comment::onlyTrashed()->get();
        Comment::onlyTrashed()->restore();
        Comment::onlyTrashed()->forceDelete();







        $product = Product::where('id',$request->product_id)->first();

        $product->comments()->create([
            'comment' => $request->comment,
        ]);
    }
}
