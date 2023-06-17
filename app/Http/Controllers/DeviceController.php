<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Illuminate\Http\Request;

class DeviceController extends Controller
{


    /* HTTP Response Code*/
    public $code = 200;
    public $brands = array('Eletrolux', 'Brastemp', 'Fischer', 'Samsung', 'LG');
    //
    public function __construct(){
    }
    public function create(Request $request)
    {
        $errors = [];

        $device = new Device();

        if (in_array($request['brand'], $this->brands)) {
            $device->brand = isset($request['brand']) && !empty($request['brand']) ? $request['brand'] : $errors['brand'] = 'campo marca não pode ser nulo';
        }
        else{
            $errors['brand'] = 'marca inexistente';
        }

        $device->name = isset($request['name']) && !empty($request['name']) ? $request['name'] : $errors['name'] = 'campo nome não pode ser nulo';
        $device->description = isset($request['description']) && !empty($request['description']) ? $request['description'] : $errors['description'] = 'campo descrição não pode ser nulo';
        $device->voltage = isset($request['voltage']) && !empty($request['voltage']) ? $request['voltage'] : $errors['voltage'] = 'campo voltagem não pode ser nulo';

        if (empty($errors)) {
            $device->save();
            $response = [
                'msg' => 'Eletrodoméstico adicionado com sucesso.'
            ];
            $this->code = 200;
        } else {
            $response = [
                'errors' => $errors
            ];
            $this->code = 405;
        }

        return response()->json($response, $this->code);
    }

    public function update(Request $request)
    {
        $array = ['msg' => ''];

        if ($request->id) {
            $device = Device::find($request->id);
            if ($device && is_numeric($request->id)) {
                // $device->brand = isset($request['brand']) && !empty($request['brand']) ? $request['brand'] : $device->brand;
                if (isset($request['brand']) && !empty($request['brand']) && in_array($request['brand'], $this->brands)) {
                    $device->brand = $request['brand'];
                }
                else{

                    $array['error'][] = 'Marca inválida';
                }

                $device->name = isset($request['name']) && !empty($request['name']) ? $request['name'] : $device->name;
                $device->description = isset($request['description']) && !empty($request['description']) ? $request['description'] : $device->description;
                $device->voltage = isset($request['voltage']) && !empty($request['voltage']) ? $request['voltage'] : $device->voltage;
                $device->updated_at = date('Y-m-d H:i:s');

                if ($device->save()) {
                    $array['error'] = [];
                    $array['msg'] = 'Eletrodoméstico atualizado com sucesso.';
                    $this->code = 200;
                }
            } else {
                $array['error'][] = 'ID de eletrodoméstico inválido ou inexistente.';
                $this->code = 404;
            }
        } else {
            $array['error'][] = 'Nenhum ID passado para editar o eletrodoméstico.';
            $this->code = 404;
        }

        return response()->json($array, $this->code);
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
