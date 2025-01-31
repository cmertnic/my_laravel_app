@extends('layouts.main')

@section('content') 

<a href="{{ route('request.create') }}">
        <button class="bg-blue-500/100 rounded text-white p-3 pl-4 pr-4 m-9 hover:bg-blue-700/100 transition">Создать заявку</button>
    </a>
    <h1 class="text-center mb-4 text-2xl">Мои заявки</h1>

    @if($reports->isEmpty())
        <p class="text-center">У вас нет заявок.</p>
    @else
        @foreach($reports as $report)
            <x-report-card :report="$report" />
        @endforeach

        {{ $reports->links() }} 
    @endif
@endsection
