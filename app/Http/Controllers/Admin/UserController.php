<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Classes;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::query();

        if ($request->search) {
            $users = $users->where('name', 'like', '%'.$request->search.'%');
        }

        $users = $users->paginate(10)->appends(['search' => $request->search]);

        $data = [
            'users' => $users,
        ];

        return view('admin.user.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        $classes = Classes::all();

        $data = [
            'classes' => $classes,
            'roles' => $roles,
        ];

        return view('admin.user.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        try {
            DB::beginTransaction();

            $file_path = '';
            if ($request->file('avatar')) {
                $name = time().'_'.$request->avatar->getClientOriginalName();
                $file_path = 'uploads/avatar/user/'.$name;
                Storage::disk('public_uploads')->putFileAs('avatar/user', $request->avatar, $name);
            }

            $create = User::create([
                'class_id' => $request->class_id,
                'code' => '',
                'name' => $request->name,
                'password' => bcrypt($request->password),
                'email' => $request->email,
                'gender' => $request->gender,
                'birthday' => date('Y-m-d', strtotime($request->birthday)),
                'phone_number' => $request->phone_number,
                'address' => $request->address,
                'avatar' => $file_path,
            ]);

            foreach ($request->roles as $role_id) {
                $role = Role::find($role_id)->name;
                $create->assignRole($role);
            }

            $create->update([
                'code' => 'TK'.str_pad($create->id, 6, '0', STR_PAD_LEFT),
            ]);

            DB::commit();

            return redirect()->route('users.index')->with('alert-success', 'Thêm tài khoản thành công!');
        } catch (Exception $e) {
            dd($e);
            DB::rollback();

            return redirect()->back()->with('alert-error', 'Thêm tài khoản thất bại!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $roles = Role::all();

        $data = [
            'user' => $user,
            'roles' => $roles,
        ];

        return view('admin.user.profile', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        $classes = Classes::all();

        $data = [
            'data_edit' => $user,
            'roles' => $roles,
            'classes' => $classes,
        ];

        return view('admin.user.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        try {
            DB::beginTransaction();

            $auth = auth()->user();

            $data = [
                'class_id' => $request->class_id,
                'name' => $request->name,
                'email' => $request->email,
                'gender' => $request->gender,
                'birthday' => date('Y-m-d', strtotime($request->birthday)),
                'phone_number' => $request->phone_number,
                'address' => $request->address,
            ];

            if ($request->file('avatar')) {
                $name = time().'_'.$request->avatar->getClientOriginalName();
                $file_path = 'uploads/avatar/user/'.$name;
                Storage::disk('public_uploads')->putFileAs('avatar/user', $request->avatar, $name);
                $data['avatar'] = $file_path;

            }
            $user->update($data);

            $user->roles()->detach();

            foreach ($request->roles as $role_id) {
                $role = Role::find($role_id)->name;
                $user->assignRole($role);
            }

            DB::commit();

            return redirect()->route('users.index')->with('alert-success', 'Sửa tài khoản thành công!');
        } catch (Exception $e) {
            DB::rollback();

            return redirect()->back()->with('alert-error', 'Sửa tài khoản thất bại!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        try {
            DB::beginTransaction();

            $user->roles()->detach();
            $user->destroy($user->id);

            DB::commit();

            return redirect()->route('users.index')->with('alert-success', 'Xóa tài khoản thành công!');
        } catch (Exception $e) {
            DB::rollback();

            return redirect()->back()->with('alert-error', 'Xóa tài khoản thất bại!');
        }
    }

    public function viewChangePassword(User $user)
    {
        $data = [
            'user' => $user,
        ];

        return view('admin.user.change-password', $data);
    }

    public function changePassword(ChangePasswordRequest $request, User $user)
    {
        try {
            DB::beginTransaction();

            if (Hash::check($request->password_old, $user->password)) {
                $user->update([
                    'password' => Hash::make($request->password),
                ]);
            }

            DB::commit();

            return redirect()->back()->with('alert-success', 'Đổi mật khẩu thành công!');
        } catch (Exception $e) {
            DB::rollback();

            return redirect()->back()->with('alert-error', 'Đổi mật khẩu thất bại!');
        }
    }

    public function getUserListByDepartment($departmentId)
    {
        $users = User::where('department_id', $departmentId)->get();

        return response()->json(['data' => $users]);
    }
}
