@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6">
    <div class="mb-6">
        <a href="{{ route('eventos.index') }}" class="text-blue-600 hover:underline">
            &larr; Voltar para a lista de eventos
        </a>
        <h1 class="text-3xl font-bold mt-2">{{ $evento->titulo }}</h1>
        <p class="text-gray-600 mt-1">{{ $evento->descricao }}</p>
    </div>

    {{-- Ticket #007: Formulário de envio de pergunta --}}
    <div class="bg-white p-6 rounded-lg shadow-md mb-8 border border-gray-100">
        <h2 class="text-xl font-bold mb-4">Faça sua Pergunta</h2>

        <form action="{{ route('perguntas.store', $evento) }}" method="POST">
            @csrf

            <div class="mb-4">
                <textarea 
                    name="conteudo" 
                    rows="3" 
                    placeholder="Digite sua pergunta..."
                    class="w-full p-3 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('conteudo') border-red-500 @enderror"
                >{{ old('conteudo') }}</textarea>

                @error('conteudo')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Ticket #008: Botão estilizado com Tailwind --}}
            <button 
                type="submit" 
                class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition duration-200 font-medium"
            >
                Enviar Pergunta
            </button>
        </form>
    </div>

    {{-- Ticket #008: Mural de perguntas estilo balões de chat --}}
    <div class="space-y-4">
        <h3 class="text-xl font-semibold mb-4">Perguntas do Evento</h3>

        @forelse($evento->perguntas as $pergunta)
            <div class="bg-blue-50 p-4 rounded-xl shadow-sm border border-blue-100 mb-4 max-w-2xl">
                <p class="text-gray-800 text-base mb-2">{{ $pergunta->conteudo }}</p>
                <span class="text-xs text-gray-500 block text-right">
                    {{ $pergunta->created_at ? $pergunta->created_at->diffForHumans() : 'Agora mesmo' }}
                </span>
            </div>
        @empty
            <p class="text-gray-500 italic">Nenhuma pergunta foi enviada ainda. Seja o primeiro a perguntar!</p>
        @endforelse
    </div>
</div>
@endsection