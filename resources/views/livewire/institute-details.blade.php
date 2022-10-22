@push('sub-title')
    {!! $institute['alias'] !!} |
@endpush
<div>
    <h2 class="text-2xl font-bold ml-4 mt-10 mb-10 print:hidden">Compare cut-offs of programs offered by
        {{ $institute['id'] }}</h2>

    <div class="mx-4 my-10">
        {{ $this->form }}
    </div>
    <hr class="border-gray-200 dark:border-gray-600 my-2">
    <div class="m-4">
        <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($courses as $course)
                <div class="bg-white dark:bg-gray-800 shadow-md overflow-hidden rounded-lg flex flex-col">
                    <div class="px-2 py-3 sm:px-4 flex-grow flex flex-row justify-between">
                        <div class="flex flex-col justify-between">
                            <h3 class="text-xl leading-6 font-medium text-gray-900 dark:text-white">
                                {!! $course->course_alias !!}, {{ $course->program_id }}
                            </h3>
                            <div class="mt-4">
                                @foreach (explode(',', $course->years) as $year)
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800 dark:bg-indigo-800 dark:text-indigo-100">
                                        {{ $year }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                        <div class="flex justify-between">
                            <div class="px-2">
                                <a href="{{ route('search-by-institute', ['rank' => $institute['type'] === 'iit' ? 'jee-advanced' : 'jee-main', 'institutes' => [$course->institute_id], 'courses' => [$course->course_id], 'programs' => [$course->program_id]]) }}"
                                    target="_blank" class="text-indigo-600 hover:text-indigo-900">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M3.375 19.5h17.25m-17.25 0a1.125 1.125 0 01-1.125-1.125M3.375 19.5h7.5c.621 0 1.125-.504 1.125-1.125m-9.75 0V5.625m0 12.75v-1.5c0-.621.504-1.125 1.125-1.125m18.375 2.625V5.625m0 12.75c0 .621-.504 1.125-1.125 1.125m1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125m0 3.75h-7.5A1.125 1.125 0 0112 18.375m9.75-12.75c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125m19.5 0v1.5c0 .621-.504 1.125-1.125 1.125M2.25 5.625v1.5c0 .621.504 1.125 1.125 1.125m0 0h17.25m-17.25 0h7.5c.621 0 1.125.504 1.125 1.125M3.375 8.25c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125m17.25-3.75h-7.5c-.621 0-1.125.504-1.125 1.125m8.625-1.125c.621 0 1.125.504 1.125 1.125v1.5c0 .621-.504 1.125-1.125 1.125m-17.25 0h7.5m-7.5 0c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125M12 10.875v-1.5m0 1.5c0 .621-.504 1.125-1.125 1.125M12 10.875c0 .621.504 1.125 1.125 1.125m-2.25 0c.621 0 1.125.504 1.125 1.125M13.125 12h7.5m-7.5 0c-.621 0-1.125.504-1.125 1.125M20.625 12c.621 0 1.125.504 1.125 1.125v1.5c0 .621-.504 1.125-1.125 1.125m-17.25 0h7.5M12 14.625v-1.5m0 1.5c0 .621-.504 1.125-1.125 1.125M12 14.625c0 .621.504 1.125 1.125 1.125m-2.25 0c.621 0 1.125.504 1.125 1.125m0 1.5v-1.5m0 0c0-.621.504-1.125 1.125-1.125m0 0h7.5" />
                                    </svg>
                                </a>
                            </div>
                            <div class="px-2">
                                <a href="{{ route('round-trends', ['rank' => $institute['type'] === 'iit' ? 'jee-advanced' : 'jee-main', 'institute' => $course->institute_id, 'course' => $course->course_id, 'program' => $course->program_id]) }}"
                                    target="_blank" class="text-indigo-600 hover:text-indigo-900"><svg
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M2.25 18L9 11.25l4.306 4.307a11.95 11.95 0 015.814-5.519l2.74-1.22m0 0l-5.94-2.28m5.94 2.28l-2.28 5.941" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <h2 class="text-2xl font-bold ml-4 mt-10 mb-10 print:hidden">Compare the cut-offs of all branches from 2012-2022
    </h2>

    <div class="m-4">
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5">
            @foreach ([
        'last' => 'Last Round',
        'all' => 'All Rounds',
        '1' => 'Round 1',
        '2' => 'Round 2',
        '3' => 'Round 3',
        '4' => 'Round 4',
        '5' => 'Round 5',
        '6' => 'Round 6',
    ] as $key => $value)
                <div class="bg-white dark:bg-gray-800 shadow-md overflow-hidden rounded-lg flex flex-col">
                    <div class="px-2 py-3 sm:px-4 flex-grow flex flex-row justify-between">
                        <h3 class="text-xl leading-6 font-medium text-gray-900 dark:text-white">
                            {{ $value }}
                        </h3>
                        <div class="flex justify-between">
                            <div class="px-2">
                                <a href="{{ route('search-by-institute', ['rank' => $institute['type'] === 'iit' ? 'jee-advanced' : 'jee-main', 'institutes' => [$institute['id']], 'round-display' => $key]) }}"
                                    target="_blank" class="text-indigo-600 hover:text-indigo-900">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M3.375 19.5h17.25m-17.25 0a1.125 1.125 0 01-1.125-1.125M3.375 19.5h7.5c.621 0 1.125-.504 1.125-1.125m-9.75 0V5.625m0 12.75v-1.5c0-.621.504-1.125 1.125-1.125m18.375 2.625V5.625m0 12.75c0 .621-.504 1.125-1.125 1.125m1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125m0 3.75h-7.5A1.125 1.125 0 0112 18.375m9.75-12.75c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125m19.5 0v1.5c0 .621-.504 1.125-1.125 1.125M2.25 5.625v1.5c0 .621.504 1.125 1.125 1.125m0 0h17.25m-17.25 0h7.5c.621 0 1.125.504 1.125 1.125M3.375 8.25c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125m17.25-3.75h-7.5c-.621 0-1.125.504-1.125 1.125m8.625-1.125c.621 0 1.125.504 1.125 1.125v1.5c0 .621-.504 1.125-1.125 1.125m-17.25 0h7.5m-7.5 0c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125M12 10.875v-1.5m0 1.5c0 .621-.504 1.125-1.125 1.125M12 10.875c0 .621.504 1.125 1.125 1.125m-2.25 0c.621 0 1.125.504 1.125 1.125M13.125 12h7.5m-7.5 0c-.621 0-1.125.504-1.125 1.125M20.625 12c.621 0 1.125.504 1.125 1.125v1.5c0 .621-.504 1.125-1.125 1.125m-17.25 0h7.5M12 14.625v-1.5m0 1.5c0 .621-.504 1.125-1.125 1.125M12 14.625c0 .621.504 1.125 1.125 1.125m-2.25 0c.621 0 1.125.504 1.125 1.125m0 1.5v-1.5m0 0c0-.621.504-1.125 1.125-1.125m0 0h7.5" />
                                    </svg>
                                </a>
                            </div>
                            <div class="px-2">
                                <a href="{{ route('institute-trends', ['rank' => $institute['type'] === 'iit' ? 'jee-advanced' : 'jee-main', 'institutes' => [$institute['id']], 'round-display' => $key]) }}"
                                    target="_blank" class="text-indigo-600 hover:text-indigo-900"><svg
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M2.25 18L9 11.25l4.306 4.307a11.95 11.95 0 015.814-5.519l2.74-1.22m0 0l-5.94-2.28m5.94 2.28l-2.28 5.941" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

</div>
