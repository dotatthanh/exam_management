<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Thêm vai trò
        $super_admin = Role::create(['name' => 'Admin']);
        $teacher = Role::create(['name' => 'Giáo viên']);
        $student = Role::create(['name' => 'Sinh viên']);

        // Gán vai trò
        User::find(1)->assignRole('Admin');
        User::find(2)->assignRole('Giáo viên');
        User::find(3)->assignRole('Sinh viên');

        $view_user = Permission::create(['name' => 'Xem danh sách tài khoản']);
        $create_user = Permission::create(['name' => 'Thêm tài khoản']);
        $edit_user = Permission::create(['name' => 'Chỉnh sửa tài khoản']);
        $delete_user = Permission::create(['name' => 'Xóa tài khoản']);

        $super_admin->givePermissionTo($view_user);
        $super_admin->givePermissionTo($create_user);
        $super_admin->givePermissionTo($edit_user);
        $super_admin->givePermissionTo($delete_user);

        $view_role = Permission::create(['name' => 'Xem danh sách vai trò']);
        $create_role = Permission::create(['name' => 'Thêm vai trò']);
        $edit_role = Permission::create(['name' => 'Chỉnh sửa vai trò']);
        $delete_role = Permission::create(['name' => 'Xóa vai trò']);

        $super_admin->givePermissionTo($view_role);
        $super_admin->givePermissionTo($create_role);
        $super_admin->givePermissionTo($edit_role);
        $super_admin->givePermissionTo($delete_role);

        $view_permission = Permission::create(['name' => 'Xem danh sách quyền']);
        $view_permission_detail = Permission::create(['name' => 'Xem quyền']);
        $edit_permission = Permission::create(['name' => 'Chỉnh sửa quyền']);

        $super_admin->givePermissionTo($view_permission);
        $super_admin->givePermissionTo($view_permission_detail);
        $super_admin->givePermissionTo($edit_permission);

        $view_department = Permission::create(['name' => 'Xem danh sách khoa']);
        $create_department = Permission::create(['name' => 'Thêm khoa']);
        $edit_department = Permission::create(['name' => 'Chỉnh sửa khoa']);
        $delete_department = Permission::create(['name' => 'Xóa khoa']);

        $super_admin->givePermissionTo($view_department);
        $super_admin->givePermissionTo($create_department);
        $super_admin->givePermissionTo($edit_department);
        $super_admin->givePermissionTo($delete_department);

        $view_major = Permission::create(['name' => 'Xem danh sách chuyên ngành']);
        $create_major = Permission::create(['name' => 'Thêm chuyên ngành']);
        $edit_major = Permission::create(['name' => 'Chỉnh sửa chuyên ngành']);
        $delete_major = Permission::create(['name' => 'Xóa chuyên ngành']);

        $super_admin->givePermissionTo($view_major);
        $super_admin->givePermissionTo($create_major);
        $super_admin->givePermissionTo($edit_major);
        $super_admin->givePermissionTo($delete_major);

        $view_class = Permission::create(['name' => 'Xem danh sách lớp học']);
        $create_class = Permission::create(['name' => 'Thêm lớp học']);
        $edit_class = Permission::create(['name' => 'Chỉnh sửa lớp học']);
        $delete_class = Permission::create(['name' => 'Xóa lớp học']);

        $super_admin->givePermissionTo($view_class);
        $super_admin->givePermissionTo($create_class);
        $super_admin->givePermissionTo($edit_class);
        $super_admin->givePermissionTo($delete_class);
        $teacher->givePermissionTo($view_class);
        $teacher->givePermissionTo($create_class);
        $teacher->givePermissionTo($edit_class);
        $teacher->givePermissionTo($delete_class);

        $view_course = Permission::create(['name' => 'Xem danh sách học phần']);
        $create_course = Permission::create(['name' => 'Thêm học phần']);
        $edit_course = Permission::create(['name' => 'Chỉnh sửa học phần']);
        $delete_course = Permission::create(['name' => 'Xóa học phần']);

        $super_admin->givePermissionTo($view_course);
        $super_admin->givePermissionTo($create_course);
        $super_admin->givePermissionTo($edit_course);
        $super_admin->givePermissionTo($delete_course);
        $teacher->givePermissionTo($view_course);
        $teacher->givePermissionTo($create_course);
        $teacher->givePermissionTo($edit_course);
        $teacher->givePermissionTo($delete_course);

        $view_qa = Permission::create(['name' => 'Xem danh sách câu hỏi và đáp án']);
        $create_qa = Permission::create(['name' => 'Thêm câu hỏi và đáp án']);
        $edit_qa = Permission::create(['name' => 'Chỉnh sửa câu hỏi và đáp án']);
        $delete_qa = Permission::create(['name' => 'Xóa câu hỏi và đáp án']);

        $super_admin->givePermissionTo($view_qa);
        $super_admin->givePermissionTo($create_qa);
        $super_admin->givePermissionTo($edit_qa);
        $super_admin->givePermissionTo($delete_qa);
        $teacher->givePermissionTo($view_qa);
        $teacher->givePermissionTo($create_qa);
        $teacher->givePermissionTo($edit_qa);
        $teacher->givePermissionTo($delete_qa);

        $view_room = Permission::create(['name' => 'Xem danh sách phòng thi']);
        $create_room = Permission::create(['name' => 'Thêm phòng thi']);
        $edit_room = Permission::create(['name' => 'Chỉnh sửa phòng thi']);
        $delete_room = Permission::create(['name' => 'Xóa phòng thi']);
        $exam = Permission::create(['name' => 'Thi']);

        $super_admin->givePermissionTo($view_room);
        $super_admin->givePermissionTo($create_room);
        $super_admin->givePermissionTo($edit_room);
        $super_admin->givePermissionTo($delete_room);
        $teacher->givePermissionTo($view_room);
        $teacher->givePermissionTo($create_room);
        $teacher->givePermissionTo($edit_room);
        $teacher->givePermissionTo($delete_room);
        $student->givePermissionTo($view_room);
        $student->givePermissionTo($exam);

        $view_exam_result = Permission::create(['name' => 'Xem danh sách kết quả thi']);
        $detail_exam_result = Permission::create(['name' => 'Chi tiết kết quả thi']);

        $super_admin->givePermissionTo($view_exam_result);
        $super_admin->givePermissionTo($detail_exam_result);
        $teacher->givePermissionTo($view_exam_result);
        $teacher->givePermissionTo($detail_exam_result);
        $student->givePermissionTo($view_exam_result);
        $student->givePermissionTo($detail_exam_result);
    }
}
