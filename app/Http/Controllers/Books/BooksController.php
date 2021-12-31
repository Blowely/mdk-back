<?php

namespace App\Http\Controllers\Books;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use mysql_xdevapi\Table;

class BooksController
{
    public function getProducts(Request $req){
        $products = DB::table('products')->get();

        if ($products) {
            $count = count($products);
            for ($i = 0; $i < $count; $i++){
                $products[$i]->images = base64_encode($products[$i]->images);
            }

            return response()->json([
                'products' => $products
            ]);
        } else {
            return response()->json([
                'data' => [
                    'products' => []
                ]
            ]);
        }
    }

    public function getCustomers(Request $req){
        $customers = DB::table('customers')->get();

        if ($customers) {
            return response()->json([
                'customers' => $customers
            ]);
        } else {
            return response()->json([
                'data' => [
                    'customers' => []
                ]
            ]);
        }
    }

    public function getUsers(Request $req){
        $users = DB::table('users')->get();

        if ($users) {
            return response()->json([
                'users' => $users
            ]);
        } else {
            return response()->json([
                'data' => [
                    'users' => []
                ]
            ]);
        }
    }

    public function getTransactions(Request $req){
        $transactions = DB::table('transactions')
            ->join('customers','id_customer','=','customers.id')
            ->join('products','id_product','=','products.id')
            ->get();

        if ($transactions) {
            $count = count($transactions);
            for ($i = 0; $i < $count; $i++){
                $transactions[$i]->images = base64_encode($transactions[$i]->images);
            }

            return response()->json([
                'transactions' => $transactions
            ]);
        } else {
            return response()->json([
                'data' => [
                    'transactions' => []
                ]
            ]);
        }
    }

    public function getBook($slug)
    {
        $products = DB::table('products')->where('id', $slug)->get();

        if ($products) {
            $count = count($products);
            for ($i = 0; $i < $count; $i++){
                $products[$i]->images = base64_encode($products[$i]->images);
            }

            return response()->json([
                'product' => $products
            ]);
        } else {
            return response()->json([
                'data' => [
                    'products' => []
                ]
            ]);
        }
    }

    public function getTourInExactDate(Request $request)
    {
        $data = $request->all();
        return response()->json([
            'error' => $data
        ]);

        $validator = Validator::make($data,[
            $data['date_min'] => 'required|date',
            $data['date_max'] => 'required|date',
        ]);

        if ($validator->fails()) {
            return response()->json([
               'error' => [
                   'errors' => $validator->errors()
               ]
            ],422);
        }

        $res = DB::table('bookings')->whereBetween('date_from',[$data['date_min'], $data['date_max']])
                                         ->whereBetween('date_back',[$data['date_min'], $data['date_max']])
                                         ->get();
        /*$res = DB::table('flights')->where('cost','>=',$passengers)->get();*/

        if ($res) {
            return response()->json([
                'data' => [
                    'tours' => [
                        $date_min => $res
                    ]
                ]
            ]);
        } else {
            return response()->json([
                'data' => [
                    'tour' => []
                ]
            ]);
        }
    }
}
