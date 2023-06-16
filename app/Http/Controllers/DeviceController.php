<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Illuminate\Http\Request;

class DeviceController extends Controller
{

    /* HTTP Response Code*/
    public $code = 200;
    //
    public function __construct(){
    }
    public function create(Request $request)
    {
        $array = ['msg' => ''];

        $device = new Device();
        $device->brand = isset($request['brand']) && !empty($request['brand']) ? $request['brand'] : $array['error'][] = 'input [brand] not expecified';
        $device->name = isset($request['name']) && !empty($request['name']) ? $request['name'] : $array['error'][] = 'input [name] not expecified.';
        $device->description = isset($request['description']) && !empty($request['description']) ? $request['description'] : $array['error'][] = 'input [description] not expecified.';
        $device->voltage = isset($request['voltage']) && !empty($request['voltage']) ? $request['voltage'] : $array['error'][] = 'input [voltage] not expecified.';
        $device['id_user'] = 1;

        if(!isset($array['error']) || count($array['error']) == 0 )
        {
            $device->save();
            $this->code = 200;
            $array['msg'] = 'Eletrodoméstico adicionado com sucesso.';
        }
        else{

            $this->code = 405;
        }

        return response()->json($array,$this->code);
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
                if($device->save())
                {
                    $array['error'][] = '';
                    $array['msg'] = 'Eletrodoméstico atualizado com sucesso.';
                    $this->code = 200;
                }

            }
            else
            {
                $array['error'][] = 'ID de eletrodoméstico inválido ou inexistente.';
                $this->code = 404;

            }

        }
        else
        {
            $array['error'][] = 'Nenhum ID passada para editar o eletrodoméstico.';
            $this->code = 404;
        }


        return response()->json($array,$this->code);
    }

    public function delete(Request $request)
    {
        $array = ['error' => '','msg' => ''];

        if($request->id)
        {
            $device = Device::find($request->id);
            if($device && is_numeric($request->id))
            {
                Device::destroy($request->id);
                $array['msg'] = 'Eletrodoméstico excluído com sucesso.';
                $this->code = 200;

            }
            else
            {
                $array['error'] = 'ID de Eletrodoméstico inválido ou inexistente.';
                $this->code = 404;
            }

        }
        else
        {
            $array['error'] = 'Nenhuma ID passada para deletar Eletrodoméstico.';
            $this->code = 404;
        }

        return response()->json($array,$this->code);
    }

    public function list()
    {
        $array = ['msg' => ''];
        $this->code = 200;

        $array['devices'] = Device::all();
        if(!$array['devices']){
            $this->code = 204;
            $array['msg'] = 'Nenhum eletrodoméstico registrado';
        }

        return response()->json($array,$this->code);
    }
}
