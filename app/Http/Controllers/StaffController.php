<?php

namespace App\Http\Controllers;

use App\Models\User;

use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $current_user_id = Auth()->user()->id;

        $current_staff = User::where('staffid', '=', $current_user_id)->get();

        $current_staff_count = User::where('staffid', '=', $current_user_id)->count();

        return view('staff.index', ['userid' => $current_user_id, 'staff_list' => $current_staff, 'staff_count' => $current_staff_count]);

    }

    /**
     * Add new user as staff view.
     */
    public function create()
    {

        $all_users = 
        DB::table('users')
            ->where('usertype', '=', 'fan')
            ->WhereNull('staffid')
            ->get();

        $all_users_count = User::count();

        return view('staff.create', ['users' => $all_users, 'users_count' => $all_users_count]);
    }

    /**
     * Save staff status.
     */
    public function save(Request $request)
    {
        $user = $request->user;

        $staff_id = $request->user_id;

        $affected = User::where('email', $user)->update(['staffid' => $staff_id, 'usertype' => 'staff']);

        return redirect()->route('staff.index');
    }

    /**
     * Remove a staff member
     */
    public function remove($id)
    {
        $current_user_id = Auth()->user()->id;

        if( $id ) {
            $remove_id = User::where('id', '=', $id)->pluck('staffid')->first();

            if( $remove_id == $current_user_id ) {
                $affected = User::where('id', $id)->update(['staffid' => null]);
            }
        }

        return redirect()->route('staff.index');
    }
}
