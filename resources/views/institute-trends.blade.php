@extends('layouts.app')

@section('meta')
    <meta name="description"
        content="Compare the cut-offs of various courses offered by an institute over 10 years in the JoSAA seat allocation process.">
    <meta name="keywords"
        content="josaa, josaa analysis, josaa cut-offs, josaa closing rank, josaa counselling, josaa counselling analysis, josaa counselling tool, engineering, engineering aspirants, institute trends, indian colleges, indian institutes, institute popularity, iits, nits, iiits">
@endsection

@section('content')
    <h1 class="text-3xl font-bold m-4 print:hidden">Analyse Institute-wise Cut-off Trends</h1>

    <p class="text-lg m-4 print:hidden">
        Compare the cut-offs of various courses offered by an institute over 10 years in the JoSAA seat allocation process.
        <br>
        This helps understand the popularity and perception of programs offered by the institute, and thus helps understand
        the demand for a particular program in the institute during the counselling process.
    </p>

    <livewire:institute-trends />
@endsection
