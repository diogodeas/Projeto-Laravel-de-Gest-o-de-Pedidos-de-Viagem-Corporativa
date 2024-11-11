<?php

namespace App\Http\Controllers;

use App\Models\TravelRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Requests\StoreTravelRequest;
use App\Http\Requests\UpdateTravelRequest;

class TravelRequestsController extends Controller
{
    public function index(Request $request)
    {
        try {
            $status = $request->query('status');

            $travelRequests = $status
                ? TravelRequests::where('status', $status)->get()
                : TravelRequests::all();

            return response()->json($travelRequests);
        } catch (\Exception $e) {
            Log::error('Erro ao buscar pedidos de viagem: ' . $e->getMessage());
            return response()->json(['error' => 'Ocorreu um erro ao buscar os pedidos de viagem.'], 500);
        }
    }

    public function store(StoreTravelRequest $request)
    {
        try {
            $travelRequest = TravelRequests::create($request->validated());

            return response()->json($travelRequest, 201);
        } catch (\Exception $e) {
            Log::error('Erro na criação do pedido de viagem: ' . $e->getMessage());
            return response()->json(['error' => 'Ocorreu um erro na criação dos pedidos de viagem'], 500);
        }
    }
    public function show($id)
    {
        try {
            $travelRequest = TravelRequests::findOrFail($id);

            return response()->json($travelRequest);
        } catch (ModelNotFoundException $e) {
            Log::warning("Pedido de viagem com ID {$id} não encontrado.");
            return response()->json(['error' => 'Pedido de viagem não encontrado.'], 404);
        } catch (\Exception $e) {
            Log::error("Erro ao buscar pedido de viagem com ID {$id}: " . $e->getMessage());
            return response()->json(['error' => 'Ocorreu um erro ao buscar o pedido de viagem.'], 500);
        }
    }

    public function update(UpdateTravelRequest $request, $id)
    {
        try {
            $travelRequest = TravelRequests::findOrFail($id);
            $travelRequest->update($request->validated());

            return response()->json($travelRequest, 200);
        } catch (ModelNotFoundException $e) {
            Log::warning("Pedido de viagem com ID {$id} não encontrado para atualização.");
            return response()->json(['error' => 'Pedido de viagem não encontrado.'], 404);
        } catch (\Exception $e) {
            Log::error("Erro ao atualizar pedido de viagem com ID {$id}: " . $e->getMessage());
            return response()->json(['error' => 'Ocorreu um erro ao atualizar o pedido de viagem.'], 500);
        }
    }
}
