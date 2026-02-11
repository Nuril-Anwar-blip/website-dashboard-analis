<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ $survey->title }}
            </h2>
            <div class="flex gap-2">
                <a href="{{ route('surveys.index') }}" class="text-gray-600 dark:text-gray-400 px-4 py-2 hover:underline">Back to List</a>
                <a href="{{ route('dashboard', ['survey' => $survey->id]) }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg font-semibold transition">
                    View Analytics
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Survey Info & Import -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="md:col-span-2 bg-white dark:bg-gray-800 p-6 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100 mb-2">Description</h3>
                    <p class="text-gray-600 dark:text-gray-400">{{ $survey->description ?? 'No description provided.' }}</p>
                    
                    <div class="mt-6 pt-6 border-t border-gray-100 dark:border-gray-700">
                        <h4 class="font-bold text-gray-900 dark:text-gray-100 mb-4">Questions ({{ $survey->questions->count() }})</h4>
                        <div class="space-y-3">
                            @foreach($survey->questions as $question)
                                <div class="p-3 bg-gray-50 dark:bg-gray-700 rounded-lg flex items-start">
                                    <span class="bg-indigo-100 dark:bg-indigo-900 text-indigo-700 dark:text-indigo-300 text-xs font-bold px-2 py-1 rounded mr-3 mt-1">
                                        {{ $question->question_type }}
                                    </span>
                                    <div>
                                        <p class="text-gray-900 dark:text-gray-100 font-medium">{{ $question->question_text }}</p>
                                    </div>
                                </div>
                            @endforeach
                            @if($survey->questions->isEmpty())
                                <p class="text-sm text-gray-500 italic">No questions defined for this survey.</p>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100 mb-4">Import Response Data</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">Upload an Excel or CSV file containing survey responses.</p>
                    
                    <form action="{{ route('surveys.import', $survey) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <input type="file" name="file" class="block w-full text-sm text-gray-500
                                file:mr-4 file:py-2 file:px-4
                                file:rounded-full file:border-0
                                file:text-sm file:font-semibold
                                file:bg-indigo-50 file:text-indigo-700
                                hover:file:bg-indigo-100" required>
                        </div>
                        <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-2 rounded-lg transition">
                            Upload & Import
                        </button>
                    </form>

                    <div class="mt-8">
                        <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100 mb-2">Respondents</h3>
                        <div class="text-3xl font-extrabold text-indigo-600">{{ $survey->responses->count() }}</div>
                        <p class="text-sm text-gray-500">Total records in database</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
