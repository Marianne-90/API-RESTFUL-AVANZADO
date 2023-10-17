<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Seller;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuarios = User::all();
        return response()->json(['data' => $usuarios, 200]);
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
        return response()->json(['data' => $usuario, 201]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $usuario = User::findOrFail($id);

        return response()->json(['data' => $usuario, 200]);
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
                return response()->json(['error' => 'Unicamente los usuarios verificados se pueden volver administrador', 'code' => 409], 409);
            }
            $user->admin = $request->admin;
        }

        if (!$user->isDirty()) {
            return response()->json(['error' => 'Se debe especificar al menos un valor par actualizar', 'code' => 422], 422);
        }

        $user->save();

        return response()->json(['data' => $user, 200]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
;
        $producto = Product::where('seller_id', $id)->get();

        foreach ($producto as $key => $value) {
            $productId = $value->id;

            Transaction::where('product_id', $productId)->orWhere('buyer_id', $id)->delete();

            DB::table('category_product')->where('product_id', $productId)->delete();

            $value->delete();
        }

        $user->delete();

        return response()->json(['data' => $user, 200]);
    }
}
