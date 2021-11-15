<?php

namespace App\Http\Controllers;

use App\Lembaga;
use App\Models\Organization;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function index(Request $request)
    {
        try {
            if ($request->ajax()) {
                $data = User::query()->with(['role', 'organization']);

                return DataTables::eloquent($data)
                    ->addColumn('action', function ($row) {

                        $btn = '<div class="list-icons">';
                        $btn .= '<a href="' . route('user.reset.index', ['user' => $row->id]) . '" data-id="' . $row->id . '" class="list-icons-item btn-icon"><i class="fas fa-unlock-alt"></i> Reset Password</a>&nbsp;';
                        $btn .= '<a href="' . route('user.show', ['user' => $row->id]) . '" data-id="' . $row->id . '" class="list-icons-item btn-icon"><i class="fas fa-edit"></i> Edit</a>&nbsp;';
                        $btn .= '</div>';

                        return $btn;
                    })
                    ->editColumn('is_access_mobile', function ($row) {
                        return $row->is_access_mobile ? 'YES' : 'NO';
                    })
                    ->editColumn('is_active', function ($row) {
                        return $row->is_active ? 'YES' : 'NO';
                    })
                    ->editColumn('created_at', function ($row) {
                        return Carbon::parse($row->created_at)->format('d-m-Y');
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }

            return view('pages.user.index');
        } catch (\Exception $e) {
            return redirect('/');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $organization = Organization::all();
        $role = Role::all();

        return view('pages.user.create', compact(['organization', 'role']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'username' => 'required|unique:users,username|min:8',
                'nik' => 'required|integer|digits:16|unique:users,nik',
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'phone' => 'required',
                'bank_name' => 'required',
                'bank_account' => 'required|numeric|min:6',
                'organization' => 'required',
                'role' => 'required',
                'password' => 'required|min:8|confirmed',
                'postal_code' => 'nullable|integer|exists:tm_kelurahan,kd_pos',
                'limit_amount' => 'nullable|integer',
                'photo' => 'nullable|image',
            ]);

            if ($validator->fails())
                return redirect()->back()->withErrors($validator)->withInput();

            $user = new User();
            $user->username = $request->username;
            $user->nik = (int)$request->nik;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->bank_name = $request->bank_name;
            $user->bank_account = $request->bank_account;
            $user->has_npwp = (bool)$request->has_npwp;
            $user->postal_code = (int)$request->postal_code;
            $user->sub_district = $request->sub_district;
            $user->district = $request->district;
            $user->city = $request->city;
            $user->province_id = $request->province;
            $user->address = $request->address;
            $user->organization_id = $request->organization;
            $user->role_id = $request->role;
            $user->password = bcrypt($request->password);
            $user->is_active = (bool)$request->active;
            $user->cti_usage = (bool)$request->cti_usage;
            $user->is_access_mobile = (bool)$request->mobile_login;
            $user->tmm = (bool)$request->tmm;
            $user->limit_days = $request->limit_day;
            $user->limit_amount = $request->limit_amount;
            $user->warehouse_request = $request->warehouse_request;
            $user->erp_user_id = $request->erp_user;

            if ($request->hasFile('photo')) {
                $photo = $request->file('photo');
                $photo_name = Str::orderedUuid()->toString() . '.' . $photo->extension();
                $photo_path = Storage::putFileAs('public/profile', $photo, $photo_name);

                $user->photo_profile_path = $photo_path;
            }

            $user->saveOrFail();

            return redirect('/user')->with('message', 'Success');
        } catch (\Throwable $e) {
            return redirect('/user')->with('message', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $data = User::query()->findOrFail($id);
        $organization = Organization::all();
        $role = Role::all();

        return view('pages.user.edit', compact(['data', 'id', 'organization', 'role']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' => [
                    'required',
                    'email',
                    Rule::unique('users', 'email')->where(function ($query) use ($id) {
                        return $query->where('id', '<>', $id);
                    })
                ],
                'phone' => 'required',
                'bank_name' => 'required',
                'bank_account' => 'required|numeric|min:6',
                'organization' => 'required',
                'role' => 'required',
                'postal_code' => 'nullable|integer|exists:tm_kelurahan,kd_pos',
                'limit_amount' => 'nullable|integer',
                'photo' => 'nullable|image',
            ]);

            if ($validator->fails())
                return redirect()->back()->withErrors($validator)->withInput();

            $user = User::query()->findOrFail($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->bank_name = $request->bank_name;
            $user->bank_account = $request->bank_account;
            $user->has_npwp = (bool)$request->has_npwp;
            $user->postal_code = (int)$request->postal_code;
            $user->sub_district = $request->sub_district;
            $user->district = $request->district;
            $user->city = $request->city;
            $user->province_id = $request->province;
            $user->address = $request->address;
            $user->organization_id = $request->organization;
            $user->role_id = $request->role;
            $user->is_active = (bool)$request->active;
            $user->cti_usage = (bool)$request->cti_usage;
            $user->is_access_mobile = (bool)$request->mobile_login;
            $user->tmm = (bool)$request->tmm;
            $user->limit_days = $request->limit_day;
            $user->limit_amount = $request->limit_amount;
            $user->warehouse_request = $request->warehouse_request;
            $user->erp_user_id = $request->erp_user;

            if ($request->hasFile('photo')) {
                $photo = $request->file('photo');

                $photo_name = Str::substr($user->photo_profile_path, strlen('public/profile') + 1);
                if (!$photo_name)
                    $photo_name = Str::orderedUuid()->toString() . '.' . $photo->extension();

                $photo_path = Storage::putFileAs('public/profile', $photo, $photo_name);

                $user->photo_profile_path = $photo_path;
            }

            $user->saveOrFail();

            return redirect('/user')->with('message', 'Success');
        } catch (\Throwable $e) {
            return redirect('/user')->with('message', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function resetPassword($id)
    {
        return view('pages.user.reset-password', compact(['id']));
    }

    public function reset(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'password' => 'required|min:8|confirmed',
            ]);

            if ($validator->fails())
                return redirect()->back()->withErrors($validator)->withInput();

            $user = User::query()->findOrFail($id);
            $user->password = bcrypt($request->password);
            $user->saveOrFail();

            return redirect('/user')->with('message', 'Success');
        } catch (\Throwable $e) {
            return redirect('/user')->with('message', $e->getMessage());
        }
    }
}
