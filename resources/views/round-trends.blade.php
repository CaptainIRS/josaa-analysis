@extends('layouts.app')

@section('meta')
    <meta name="description"
        content="Compare the cut-offs of a course in various rounds over 10 years in the JoSAA seat allocation process.">
    <meta name="keywords"
        content="josaa, josaa analysis, josaa cut-offs, josaa closing rank, josaa counselling, josaa counselling analysis, josaa counselling tool, engineering, engineering aspirants, round trends, indian colleges, josaa closing rank in round, iits, nits, iiits">
@endsection

@section('content')
    <h1 class="text-3xl font-bold m-4 print:hidden">Analyse Round-wise Cut-off Trends</h1>

    <p class="text-lg m-4 print:hidden">
        Compare the cut-offs of a course in various rounds over 10 years in the JoSAA seat allocation process.
        This helps understand the likely range of changes to the closing ranks throught the counselling process.
    </p>
    <livewire:round-trends />
@endsection
