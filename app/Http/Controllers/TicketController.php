<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TicketRequest;
use App\Models\Ticket;
use App\Models\Department;


class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
public function index(Request $request)
{
    // 1. Captura dos filtros da requisição
    $search = $request->search;
    $departmentId = $request->department_id;
    $status = $request->status;

    // 2. Construção da consulta
    $query = Ticket::with('department');

    $query->when($search, function ($q) use ($search) {
        $q->where(function ($subQuery) use ($search) {
            $subQuery->where('title', 'like', "%{$search}%")
                     ->orWhere('requester_name', 'like', "%{$search}%");
        });
    });

    $query->when($departmentId, function ($q) use ($departmentId) {
        $q->where('department_id', $departmentId);
    });

    $query->when($status, function ($q) use ($status) {
        $q->where('status', $status);
    });

    // 3. Execução com ordenação e paginação
    $tickets = $query->latest()->paginate(6)->withQueryString();

    // 4. Busca dos departamentos para o select do filtro
    $departments = Department::all();

    // 5. Retorno da view com os dados
    return view('tickets.index', compact('tickets', 'departments'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments = Department::all();

        return view('tickets.create', compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TicketRequest $request)
    {
        //validação do request e criação no banco
        Ticket::create($request->validated());

        //redirect
        return redirect()->route('tickets.index')->with('success','Chamado cadastrado com sucesso!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function update(TicketRequest $request, Ticket $ticket)
    {
        $ticket->update($request->validated());

        return redirect()->route('tickets.index')->with('success','Chamado atualizado com sucesso!');
    }

    /**
     * Update the specified resource in storage.
     */
    public function edit(Ticket $ticket)
    {
        $departments = Department::all();

        return view('tickets.edit', compact('ticket', 'departments'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket)
    {
        $ticket->delete();

        return redirect()->route('tickets.index')->with('success','Chamado excluído com sucesso');
    }
}
