<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Memberships;

use App\Http\Requests\StoreMembershipsRequest;
use App\Http\Requests\UpdateMembershipsRequest;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Illuminate\Auth\Events\Registered;

class MembershipsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $current_user_id = Auth()->user()->id;

        $current_memberships = Memberships::where('userid', '=', $current_user_id)->get();

        $current_memberships_count = Memberships::where('userid', '=', $current_user_id)->count();
        
        return view('memberships.index', ['userid' => $current_user_id, 'memberships' => $current_memberships, 'memberships_count' => $current_memberships_count]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('memberships.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function save(Request $request)
    {
        
        $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'description' => ['string', 'max:160'],
        ]);

        $membership = Memberships::create([
            'name' => $request->name,
            'userid' => $request->userid,
            'description' => $request->description,
            'status' => $request->status,
            'price' => $request->price,
            'starts' => $request->starts,
            'ends' => $request->ends,
            'limit' => $request->limit
        ]);

        event(new Registered($membership));

        return redirect()->route('memberships.index')->with('status', 'Membership plan created');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $membership_id = $request->query->get('id');
        if( $membership_id ) {
            $membership = Memberships::find($membership_id);

            return view('memberships.edit', ['membership' => $membership]);
        } else {
            return view('memberships.index', ['error' => 'Membership not found']);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'description' => ['string', 'max:160'],
        ]);

        $membership = Memberships::query()
            ->update([
                'name' => $request->name,
                'userid' => $request->userid,
                'description' => $request->description,
                'status' => $request->status,
                'price' => $request->price,
                'starts' => $request->starts,
                'ends' => $request->ends,
                'limit' => $request->limit
        ]);

        return redirect()->route('memberships.index')->with('status', 'Membership plan Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $membership_id = $request->query->get('id');
        if( $membership_id ) {
            $membership = Memberships::find($membership_id)->delete();

            $current_memberships_count = Memberships::where('userid', '=', $current_user_id)->count();

            return view('memberships.index', ['status' => 'Membership deleted', 'memberships_count' => $current_memberships_count]);
        } else {
            return view('memberships.index', ['error' => 'Membership not found']);
        }
    }
}
