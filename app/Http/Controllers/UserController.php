<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;


class UserController extends Controller
{
    private $loggedUser;
    //
    public function __construct(){
        $this->middleware('auth:api');
        $this->loggedUser = auth()->user();
    }


    public function update(Request $request)
    {
        $array = ['msg' => ''];

        $name = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');
        $password_confirm = $request->input('password_confirm');

        $user = User::find($this->loggedUser['id']);

        //NAME
        if($name)
        {
            $user->name = $name;
        }

        //EMAIL
        if($email)
        {
            if($email != $user->email){
                $emailExists = User::where('email',$email)->count();
                if($emailExists === 0){
                    $user->email = $email;
                } else {
                    $array['msg'] = 'E-mail já existe!';
                    return $array;
                }
            }
        }

        //PASSWORD
        if($password || $password_confirm)
        {
            if($password === $password_confirm)
            {
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $user->password = $hash;

            }
            else
            {
                $array['msg'] = 'Senha confirmada não coincide com a digitada.';
                return $array;
            }
        }

        $user->save();
        return $array;
    }

    public function delete(Request $request)
    {
        $array = ['msg' => ''];

        if($request->id)
        {
            $user = User::find($request->id);
            if($user && is_numeric($request->id))
            {
                User::destroy($request->id);
                $array['msg'] = 'Usuário excluído com sucesso.';

            }
            else
            {
                $array['msg'] = 'ID de usuário inválido ou inexistente.';
            }

        }
        else
        {
            $array['msg'] = 'Nenhuma ID passada para deletar usuário.';
            return $array;
        }

        return $array;
    }

}
