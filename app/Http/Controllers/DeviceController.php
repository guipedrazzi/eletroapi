<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Illuminate\Http\Request;

class DeviceController extends Controller
{

    private $loggedUser;
    //
    public function __construct(){
        $this->middleware('auth:api');
        $this->loggedUser = auth()->user();
    }
    public function create(Request $request)
    {
        $array = ['msg' => ''];

        $device = new Device();
        $device->brand = isset($request['brand']) ? $request['brand'] : $array['error'][] = 'Marca não expecificada.';
        $device->name = isset($request['name']) ? $request['name'] : $array['error'][] = 'Nome não expecificado.';
        $device->description = isset($request['description']) ? $request['description'] : $array['error'][] = 'Descrição não expecificada.';
        $device->voltage = isset($request['voltage']) ? $request['voltage'] : $array['error'][] = 'Voltagem não expecificada.';
        $device['id_user'] = $this->loggedUser['id'];

        if(!isset($array['error']) || count($array['error']) == 0 )
        {
            $device->save();
            $array['msg'] = 'Eletrodoméstico adicionado com sucesso.';
        }

        return $array;
    }

    public function update(Request $request)
    {
        $array = ['msg' => ''];

        if($request->id)
        {
            $device = Device::find($request->id);
            if($device && is_numeric($request->id))
            {
                $device->brand = isset($request['brand']) && !empty($request['brand']) ? $request['brand'] : $device->brand;
                $device->name = isset($request['name']) && !empty($request['name']) ? $request['name'] : $device->name;
                $device->description = isset($request['description']) && !empty($request['description']) ? $request['description'] : $device->description;
                $device->voltage = isset($request['voltage']) && !empty($request['voltage']) ? $request['voltage'] : $device->voltage;
                $device->updated_at = date('Y-m-d H:m:s');
                $device->save();
                $array['msg'] = 'Eletrodoméstico atualizado com sucesso.';

            }
            else
            {
                $array['error'][] = 'ID de eletrodoméstico inválido ou inexistente.';
            }

        }
        else
        {
            $array['error'][] = 'Nenhum ID passada para editar o eletrodoméstico.';
            return $array;
        }


        return $array;
    }
}
