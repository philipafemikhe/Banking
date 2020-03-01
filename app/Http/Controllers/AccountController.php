<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Account;
use App\Transaction;
use App\User;

class AccountController extends Controller
{
    public function withdrawal(Request $request){

    
    }

    public function depositOrWitdraw(Request $request){
        $transactType = $request->dc;
        $account = Account::where("account_no",$request->account_no)->first();
        if(!is_null($account)){
             $transaction = new Transaction([
            'accountNo'=>$request->accountNo,
             'customer'=>$request->customer, 
             'dc'=>$transactType, 
             'amount'=>$request->amount,
            ]);
            if(!is_null($transaction)){
                if($transactType == "D"){
                    $account->balance = $account->balance + $request->amount;
                    $account->save();
                }else if($transactType == "C"){
                    $account->balance = $account->balance - $request->amount;
                    $account->save();
                }else{
                    $data = $request;
                    $message = "Invalid transaction selected";
                    return response()->json(compact('data', 'message'), 500);
                }
                
                
                $data = $account;
                $message = "Successful";
                return response()->json(compact('data', 'message'), 200);
            }

        }
        $data = $request;
        $message = "There was an error";
        return response()->json(compact('data', 'message'), 500);    
    
    }
    
    public function createAccount(Request $request){
        try{
            $newAccount = new Account();
            $newAccount->account_no=$request->account_no;
            $newAccount->account_name=$request->account_name;
            $newAccount->account_signatory=$request->account_signatory;
            $newAccount->balance=$request->balance;
            $newAccount->save();

            $data = $newAccount;
            $message = "Account creation Successful";
            return response()->json(compact('data', 'message'), 200);
        }catch(Exception $ex){
            $data = $request;
            $message = "There was an error";
            return response()->json(compact('data', 'message'), 500);
        }     
        
    }

    public function getAccount(string $account_no){
        $theAccount = Account::where("account_no", $account_no)->first();
        if(!is_null($theAccount)){
            $data = $theAccount;
            $message = "Successful";
            return response()->json(compact('data', 'message'), 200);
        } else{
            $data = $request;
            $message = "There was an error";
            return response()->json(compact('data', 'message'), 500);
        }
        
    }
}
