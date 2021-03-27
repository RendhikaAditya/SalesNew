<?php

namespace App\Http\Controllers\Web;

use App\Models\User;
use App\Models\Level;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\User\addUserRequest;

class UserController extends Controller
{

    public function index() {
        $users = User::get();
        return view("pages.user.index", compact("users"));
    }

    public function getUpdateUser(User $u) {
        $level = Level::get();
        return view("pages.user.update",compact("u","level"));
    }

    public function putUpdateUser(Request $request, User $u) {
        $request->validate([
            "name" => ["required"],
            "email" => ["required"]
        ]);
        $updated = $u->update($request->all());
        $updated === true
        ? Alert::success("Berhasil", "Update Data Berhasil Dilakukan")
        : Alert::error("Gagal", "Update Data Gagal Dilakukan");
        return redirect()->route("listUsers");
    }

    public function deleteUser(User $u) {
        $deleted = $u->delete();
        $deleted === true
        ? Alert::success("Berhasil", "Data Berhasil Dihapus")
        : Alert::error("Gagal", "Data Gagal Dihapus");
        return redirect()->back();
    }

    public function getAddUser() {
        $level = Level::get();
        return view("pages.user.add",compact("level"));
    }

    public function postAddUser(addUserRequest $request) {
        $data = $request->all();
        $data["password"] = bcrypt($request->password);
        $created = User::create($data);
        $created->id > 0
        ? Alert::success("Berhasil", "Data Berhasil Ditambahkan")
        : Alert::error("Gagal", "Data Gagal Ditambahkan");
        return redirect()->route("listUsers");
    }

}
