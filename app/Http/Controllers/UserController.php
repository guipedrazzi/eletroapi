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
        $array = ['error' => '','msg' => ''];

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
                    $array['error'] = 'E-mail já existe!';
                    return $array;
                }
            }
        }

        //PASSWORD
        if($password && $password_confirm)
        {
            if($password === $password_confirm)
            {
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $user->password = $hash;

            }
            else
            {
                $array['error'] = 'Senhas não batem!';
                return $array;
            }
        }

        $array['msg'] = empty($array['error']) ? 'Usuário editado com sucesso.' : '';
        $user->save();
        return $array;
    }

    public function delete(Request $request)
    {
        $array = ['error' => '','msg' => ''];

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
                $array['error'] = 'ID de usuário inválido ou inexistente.';
            }

        }
        else
        {
            $array['error'] = 'Nenhuma ID passada para deletar usuário.';
            return $array;
        }

        return $array;
    }

}
