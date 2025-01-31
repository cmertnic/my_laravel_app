@extends('layouts.main')

@section('content') 
    <h1 class="text-center mb-4 mt-4 text-2xl">Заявки клиентов</h1>

    @if($reports->isEmpty())
        <p class="text-center">нет заявок.</p>
    @else
        @foreach($reports as $report)
        <x-admin-card :report="$report" :statues="$statues" />
        @endforeach

        {{ $reports->links() }} 
    @endif
@endsection
