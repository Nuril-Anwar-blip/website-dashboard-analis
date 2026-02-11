<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Surveys') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Survey List</h3>
                    <a href="{{ route('surveys.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-200">
                        + Create New Survey
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($surveys as $survey)
                        <div class="bg-gray-50 dark:bg-gray-700 p-6 rounded-xl border border-gray-200 dark:border-gray-600 hover:shadow-lg transition duration-300">
                            <h4 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-2">{{ $survey->title }}</h4>
                            <p class="text-gray-600 dark:text-gray-400 text-sm mb-4">{{ Str::limit($survey->description, 100) }}</p>
                            
                            <div class="flex items-center text-sm text-gray-500 dark:text-gray-400">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                {{ $survey->responses_count }} Respondents
                            </div>

                            <div class="mt-6 flex gap-2">
                                <a href="{{ route('surveys.show', $survey) }}" class="flex-1 text-center bg-gray-200 dark:bg-gray-600 hover:bg-gray-300 dark:hover:bg-gray-500 text-gray-900 dark:text-white py-2 rounded-lg font-semibold transition">
                                    View Details
                                </a>
                                <a href="{{ route('dashboard', ['survey' => $survey->id]) }}" class="flex-1 text-center bg-indigo-600 hover:bg-indigo-700 text-white py-2 rounded-lg font-semibold transition">
                                    Analytics
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                @if($surveys->isEmpty())
                    <div class="text-center py-12">
                        <p class="text-gray-500 dark:text-gray-400">No surveys found. Start by creating one!</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
