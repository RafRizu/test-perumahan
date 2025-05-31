<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Referral;
use Illuminate\Http\Request;
use App\Models\MarketingTeam;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    //
    public function listMarketing() {
        $user = Auth::user();
        $marketing = User::where(["role" => "marketing"])->get();
        return view('lists.marketing', compact('marketing', 'user'));
    }

    public function indexMarketing()
    {
        $user = Auth::user();
        return view('forms.create-marketing', compact('user'));
    }

    public function storeMarketing(Request $request)
    {
        // Only admin and superadmin can access
        if (!auth()->check() || !in_array(auth()->user()->role, [ 'admin', 'superadmin' ])) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses untuk membuat akun.');
        }

        // Validate input
        $request->validate([
            'username' => 'required|unique:users,username',
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:8',
            'role' => 'required|in:marketing',
        ]);


        try {
            DB::beginTransaction();
            // Create user
            $user = User::create([
                'username' => $request->username,
                'name' => $request->name,
                'password' => Hash::make($request->password),
                'role' => 'marketing',
            ]);

            DB::commit();
            return redirect()->back()->with('success', 'Akun marketing berhasil dibuat.');
        } catch (\Exception $e) {
            DB::rollBack();
            // Optional: log error
            // \Log::error('Marketing account creation failed', ['error' => $e->getMessage()]);

            return redirect()->back()->with('error', 'Gagal membuat akun marketing: ' . $e->getMessage());
        }
    }


    public function listReferral() {
        $user = auth()->user();
        $referrals = Referral::all();
        return view('lists.referrals', compact('user', 'referrals'));
    }

    public function indexReferral()
    {
        $user = Auth::user();
        $marketing = MarketingTeam::all();
        return view('forms.create-referral', compact('marketing', 'user'));
    }

    public function storeReferral(Request $request)
    {
        // Only admin can access
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            return redirect()->route('dashboard')->with('error', 'Anda tidak memiliki akses untuk membuat akun.');
        }

        // Validate input
        $request->validate([
            'username' => 'required|unique:users,username',
            'name' => 'required|string|max:255',
            'marketing_team_id' => 'required|exists:marketing_teams,id',
            'password' => 'required|string|min:8',
            'role' => 'required|in:referral',
        ]);
        // dd($request->all());

        try {
            DB::beginTransaction();
            // Create user
            $userref = User::create([
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'role' => 'referral',
            ]);

            // Create Referral team entry
            Referral::create([
                'name' => $request->name,
                'marketing_team_id' => $request->marketing_team_id,
                'user_id' => $userref->id,
            ]);

            DB::commit();
            return redirect()->route('referral')->with('success', 'Akun referral berhasil dibuat.');
        } catch (\Exception $e) {
            DB::rollBack();
            // Optional: log error
            // \Log::error('referral account creation failed', ['error' => $e->getMessage()]);

            return redirect()->route('referral')->with('error', 'Gagal membuat akun referral: ' . $e->getMessage());
        }
    }


}
