<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $product = Product::where('id',$request->product_id)->first();

        $product->comments()->create([
            'comment' => $request->comment,
        ]);
    }
}
