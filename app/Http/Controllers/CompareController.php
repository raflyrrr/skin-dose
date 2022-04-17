<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use App\Models\Category;
use App\Models\Tags;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class CompareController extends Controller
{
    public function compare()
    {
        $category_widget = Category::All();
        $tag_widget = Tags::all();
        return view('compare', compact('category_widget', 'tag_widget'));
    }

    public function compareStore(Request $request)
    {
        $post_id = $request->input('post_id');
        $serviceProduts = new Posts();
        $product = $serviceProduts->getProductByCart($post_id);
        $price = $product[0]['id'];
        $compare_array = [];

        foreach (Cart::instance('compare')->content() as $item) {
            $compare_array[] = $item->id;
        }

        if (in_array($post_id, $compare_array)) {
            $response['present'] = true;
            $response['message'] = "Produk sudah ada didalam compare";
        } elseif (count($compare_array) >= 2) {
            $response['status'] = false;
            $response['message'] = "Kamu tidak bisa menambahkan lebih dari 2 produk";
        } else {
            $result = Cart::instance('compare')->add($post_id, $product[0]['namaproduk'], 1, $price)->associate('App\Models\Posts');
            if ($result) {
                $response['true'] = true;
                $response['message'] = 'Produk telah ditambahkan ke compare';
                $response['compare_count'] = Cart::instance('compare')->count();
            }
        }
        return json_encode($response);
    }

    public function compareDelete(Request $request)
    {
        $category_widget = Category::All();
        $tag_widget = Tags::all();
        $id = $request->input('rowId');
        Cart::instance('compare')->remove($id);

        $response['status'] = true;
        $response['message'] = "Item berhasil dihapus dari compare";


        if ($request->ajax()) {
            $compare = view('compare', compact('category_widget', 'tag_widget'))->render();
        }
    }
}
