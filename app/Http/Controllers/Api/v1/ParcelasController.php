<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Boleto;
use Illuminate\Http\Request;
use App\Models\Parcelas;
use App\Models\RegistrosWebservice;
use Illuminate\Http\Response;


class ParcelasController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return Parcelas::all();
        return response()->json(['parcelas' => Parcelas::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    }

    public function conciliar(Request $request){
        try {
            foreach($request->all() as $r){
                // inserção dos registros via webhook
                $rws = new RegistrosWebservice;
                $rws->fill($r)->save();

                if($r['flg_pago'] == 'sim') {
                    $boleto = Boleto::where('nosso_numero', $r['nosso_numero'])->get()->first();
                    $parcela = Parcelas::find($boleto->parcela_id);
                    $parcela->flg_pago = 'sim';
                    $parcela->update();
                }
            }
            return response()->json('ok');
            
        } catch (\Throwable $th) {
            return response()->json(['erro' => $th->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
