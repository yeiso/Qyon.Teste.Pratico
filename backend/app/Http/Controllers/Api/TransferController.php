<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\API\ApiError;
use App\Models\Transfer;
use App\Models\bank;
use PhpParser\Node\Stmt\Return_;

class TransferController extends Controller
{
    public function index()
    {
        $transfer = Transfer::join('banks', 'transfers.conta_id', '=', 'banks.id')
            ->select('transfers.*', 'banks.conta')
            ->get();

        return $transfer;
    }

    public function show($conta_id)
    {
        //Decidi ordenar por update_at ao inves de created_at
        $transfer = Transfer::where('conta_id', $conta_id)->join('banks', 'transfers.conta_id', '=', 'banks.id')
            ->select('transfers.*', 'banks.conta')->orderBy('updated_at', 'desc')->get();

        return $transfer;
    }

    public function calculateDeposit(Request $request, $transfer, $bank)
    {
        $total = $bank->total;
        if ($transfer->movimento == 'withdraw') {
            $total = $total + $transfer->valor + $request->valor;
        } else {
            $total = $total - $transfer->valor + $request->valor;
        }

        return [$transfer, $bank, $total];
    }

    public function calculateWithdraw(Request $request, $transfer, $bank)
    {

        $total = $bank->total;

        if ($transfer->movimento == 'deposit') {
            $total = $total - $transfer->valor - $request->valor;
        } else {
            $total = $total + $transfer->valor - $request->valor;
        }

        return [$transfer, $bank, $total];
    }

    public function update(Request $request, $id)
    {

        $transfer = Transfer::find($id);

        if (!$transfer) {
            //retun http code
            return response()->json(ApiError::errorMessage("Transferencia não localizada com ID {$request->id}!", 1030), 500);
        }

        $bank = bank::find($request->conta_id);

        if (!$bank) {
            //retun http code
            return response()->json(ApiError::errorMessage("Conta não localizada com a conta_id {$request->conta_id}!", 1030), 500);
        }

        //Verificar primeiro se é alterada a conta, para desfazer a operação na conta anterior
        if ($request->conta_id != $transfer->conta_id) {
            $bankOld = bank::find($transfer->conta_id);

            $total = $bankOld->total;

            if ($transfer->movimento == 'deposit') {
                $total = $total - $transfer->valor;
            } else {
                $total = $total + $transfer->valor;
            }
            if ($total < 0) {
               return response()->json(ApiError::errorMessage("Não foi possivel atualizar o lançamento. Verifique saldo.", 1030), 400);
            }
            $bankOld->total = $total;
            $bankOld->save();
        }

        if ($request->movimento == 'deposit') {
          [$transfer, $bank, $total] = TransferController::calculateDeposit($request, $transfer, $bank);
        } else {
          [$transfer, $bank, $total] = TransferController::calculateWithdraw($request, $transfer, $bank);
        }

        if ($total < 0) {
            return response()->json(ApiError::errorMessage("Não foi possivel atualizar o lançamento. Verifique saldo.", 1030), 400);
        }

        $bank->total = $total;
        $bank->save();
        $transferData = $request->all();
        $transfer->update($transferData);

        $return = [
            'data' => [
                'msg' => 'Transferencia alterada com sucesso!',
                $transfer
            ]
        ];

        return response()->json($return);

    }





    public function destroy($id)
    {
        $transfer = Transfer::find($id);

        if (!$transfer) {
            return response()->json(ApiError::errorMessage("Transferencia não localizada com ID {$id}!", 1030), 400);
        }

        $bank = bank::find($transfer->conta_id);

        if ($transfer->movimento == 'withdraw') {
            $bank->total = $bank->total + $transfer->valor;
            $bank->save();
            $transfer->delete();
        }
        if ($transfer->movimento == 'deposit') {
            if ($bank->total - $transfer->valor >= 0) {
                $bank->total = $bank->total - $transfer->valor;
                $bank->save();
                $transfer->delete();
            } else {
                return ('Não foi possivel apagar o lançamento. Verifique saldo.');
            }
        }

        $return = [
            'data' => [
                'msg' => 'Transferencia apagada com sucesso!',
                $transfer
            ]
        ];

        return response()->json($return);
    }
}
