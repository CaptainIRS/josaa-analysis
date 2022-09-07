@extends('layouts.app')

@section('meta')
    <meta name="description"
        content="Compare the cut-offs for courses in a particular field of engineering over 10 years in the JoSAA seat allocation process.">
    <meta name="keywords"
        content="josaa, josaa analysis, josaa cut-offs, josaa closing rank, josaa counselling, josaa counselling analysis, josaa counselling tool, engineering, engineering aspirants, field trends, indian institutes, course popularity, iits, nits, iiits">

    <meta property="og:title" content="Field Trends - JoSAA Analysis">
    <meta property="og:description"
        content="Compare the cut-offs for courses in a particular field of engineering over 10 years in the JoSAA seat allocation process.">
    <meta property="og:url" content="{{ route('field-trends') }}">

    <title>Field Trends | {{ config('app.name') }}</title>
@endsection

@section('content')
    <h1 class="text-3xl font-bold m-4">Field Trends</h1>

    <h2 class="text-lg m-4">
        Field trends highlight the trends of courses in a particular field over the years. This helps understand the
        popularity and perception of a field among engineering aspirants, and thus helps understand the demand for a
        particular field during the counselling process.
    </h2>
    <livewire:field-trends />
@endsection
