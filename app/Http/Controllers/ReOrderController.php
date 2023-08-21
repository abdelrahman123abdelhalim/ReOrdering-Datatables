<?php

namespace App\Http\Controllers;
 
use App\DataTables\UsersDataTable;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\User;
use DataTables;


 
class ReOrderController extends Controller
{
    public function showDatatable()
    {
         $user = User::get();
        return view('ReOrdering.index',['user'=> $user]);
    }

    public function update (Request $request)
    {
        $users = User::all();
        foreach ($users as $user) {
            foreach ($request->order as $order) {
                if ($order['id'] == $user->id) {
                    $user->update(['order' => $order['position']]);
                }
            }
        }
        return response('Update Successfully.', 200);
    }
}