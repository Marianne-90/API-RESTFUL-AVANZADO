<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Seller;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuarios = User::all();
        return $this->showAll($usuarios);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ];

        $request->validate($rules);

        $campos = $request->all();

        $campos['password'] = bcrypt($request->password);
        $campos['verified'] = User::USUARIO_NO_VERIFICADO;
        $campos['verification_token'] = User::generarVerificationToken();
        $campos['admin'] = User::USUARIO_REGULAR;

        $usuario = User::create($campos);
        return $this->showOne($usuario, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $usuario = User::findOrFail($id);
        return $this->showOne($usuario, 200);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id,)
    {
        $user = User::findOrFail($id);
        $rules = [
            'email' => 'email|unique:users,email,' . $user->id,
            'password' => 'min:6|confirmed',
            'admin' => 'in:' . User::USUARIO_ADMINISTRADOR . ',' . User::USUARIO_REGULAR,
        ];

        $request->validate($rules);

        if ($request->has('name')) {
            $user->name = $request->name;
        }

        if ($request->has('email') && $user->email != $request->email) {
            $user->verified = User::USUARIO_NO_VERIFICADO;
            $user->verification_token = User::generarVerificationToken();
            $user->email = $request->email;
        }

        if ($request->has('password')) {
            $user->password = bcrypt($request->password);
        }
        if ($request->has('admin')) {
            if (!$user->esVerificado()) {
                return $this->errorResponse('Unicamente los usuarios verificados se pueden volver administrador', 409);
            }
            $user->admin = $request->admin;
        }

        if (!$user->isDirty()) {
            return $this->errorResponse('Se debe especificar al menos un valor par actualizar', 422);
        }

        $user->save();
        return $this->showOne($user, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $producto = Product::where('seller_id', $id)->get();

        foreach ($producto as $key => $value) {
            $productId = $value->id;

            Transaction::where('product_id', $productId)->orWhere('buyer_id', $id)->delete();

            DB::table('category_product')->where('product_id', $productId)->delete();

            $value->delete();
        }

        $user->delete();
        return $this->showOne($user, 200);
    }
}
