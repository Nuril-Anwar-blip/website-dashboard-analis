@props(['stats' => [], 'employees' => [], 'theme' => 'light'])

@php
    $bgClass = $theme === 'dark' ? 'bg-gray-800' : 'bg-white';
    $borderClass = $theme === 'dark' ? 'border-gray-700' : 'border-gray-200';
    $textPrimaryClass = $theme === 'dark' ? 'text-white' : 'text-gray-900';
    $textSecondaryClass = $theme === 'dark' ? 'text-gray-400' : 'text-gray-600';
    $tableBorderClass = $theme === 'dark' ? 'border-gray-700' : 'border-gray-200';
    $tableHoverClass = $theme === 'dark' ? 'hover:bg-gray-700/50' : 'hover:bg-gray-50';
@endphp

<div class="{{ $bgClass }} rounded-2xl p-6 shadow-2xl {{ $textPrimaryClass }} border-2 {{ $borderClass }} hover:border-gray-600 transition-all duration-300 group">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h2 class="text-2xl font-black mb-1">Understand</h2>
            <p class="text-sm {{ $textSecondaryClass }} font-semibold">Time Entry Week</p>
        </div>
        <div class="w-12 h-12 bg-blue-500/20 rounded-xl flex items-center justify-center group-hover:bg-blue-500/30 transition-colors">
            <svg class="w-7 h-7 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
            </svg>
        </div>
    </div>
    
    <!-- Stats Boxes -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        @forelse($stats as $stat)
            <div class="bg-gradient-to-br {{ $stat['bg'] ?? 'from-orange-500 to-orange-600' }} rounded-xl p-5 shadow-lg hover:scale-105 transition-transform duration-300 group/stat">
                <div class="text-3xl font-black mb-2 group-hover/stat:scale-110 transition-transform">{{ $stat['value'] ?? '0' }}</div>
                <div class="text-sm font-bold text-white/90">{{ $stat['label'] ?? 'Label' }}</div>
            </div>
        @empty
            <div class="bg-gradient-to-br from-orange-500 to-orange-600 rounded-xl p-5 shadow-lg hover:scale-105 transition-transform">
                <div class="text-3xl font-black mb-2">3,458</div>
                <div class="text-sm font-bold text-white/90">Contract Hours</div>
            </div>
            <div class="bg-gradient-to-br from-orange-500 to-orange-600 rounded-xl p-5 shadow-lg hover:scale-105 transition-transform">
                <div class="text-3xl font-black mb-2">1,059</div>
                <div class="text-sm font-bold text-white/90">Client Hours</div>
            </div>
            <div class="bg-gradient-to-br from-green-600 to-green-700 rounded-xl p-5 shadow-lg hover:scale-105 transition-transform">
                <div class="text-3xl font-black mb-2">30.62%</div>
                <div class="text-sm font-bold text-white/90">Utilization</div>
            </div>
        @endforelse
    </div>

    <!-- Filters -->
    <div class="flex items-center gap-4 mb-6 pb-4 border-b {{ $tableBorderClass }} overflow-x-auto">
        <button class="text-sm font-bold {{ $textSecondaryClass }} hover:{{ $textPrimaryClass }} transition-colors border-b-2 border-transparent hover:border-blue-500 pb-2 whitespace-nowrap">Last 12 week</button>
        <button class="text-sm font-bold {{ $textSecondaryClass }} hover:{{ $textPrimaryClass }} transition-colors border-b-2 border-transparent hover:border-blue-500 pb-2 whitespace-nowrap">Specific week</button>
        <button class="text-sm font-black {{ $textPrimaryClass }} border-b-2 border-blue-500 pb-2 whitespace-nowrap">Active employee</button>
        <button class="text-sm font-bold {{ $textSecondaryClass }} hover:{{ $textPrimaryClass }} transition-colors border-b-2 border-transparent hover:border-blue-500 pb-2 whitespace-nowrap">Employee</button>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="text-left text-sm font-black {{ $textSecondaryClass }} border-b-2 {{ $tableBorderClass }}">
                    <th class="pb-4">Employee</th>
                    <th class="pb-4">Contract</th>
                    <th class="pb-4">Client</th>
                    <th class="pb-4">Intern</th>
                    <th class="pb-4">Sick/Leave</th>
                    <th class="pb-4">Unsubmitted</th>
                    <th class="pb-4">Overtime</th>
                </tr>
            </thead>
            <tbody class="text-sm">
                @forelse($employees as $employee)
                    <tr class="border-b {{ $tableBorderClass }} {{ $tableHoverClass }} transition-colors group/row">
                        <td class="py-4 font-bold flex items-center gap-2">
                            {{ $employee['name'] ?? 'Employee Name' }}
                            @if(isset($employee['hasComment']) && $employee['hasComment'])
                                <svg class="w-4 h-4 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10c0 3.866-3.582 7-8 7a8.841 8.841 0 01-4.083-.98L2 17l1.338-3.123C2.493 12.767 2 11.434 2 10c0-3.866 3.582-7 8-7s8 3.134 8 7zM7 9H5v2h2V9zm8 0h-2v2h2V9zM9 9h2v2H9V9z" clip-rule="evenodd" />
                                </svg>
                            @endif
                        </td>
                        <td class="py-4">{{ $employee['contract'] ?? '0' }}</td>
                        <td class="py-4">{{ $employee['client'] ?? '0' }}</td>
                        <td class="py-4">{{ $employee['intern'] ?? '0' }}</td>
                        <td class="py-4">{{ $employee['sickLeave'] ?? '0/0' }}</td>
                        <td class="py-4">{{ $employee['unsubmitted'] ?? '0' }}</td>
                        <td class="py-4">{{ $employee['overtime'] ?? '-' }}</td>
                    </tr>
                @empty
                    <tr class="border-b {{ $tableBorderClass }} {{ $tableHoverClass }} transition-colors">
                        <td class="py-4 font-bold">Leon Nijs</td>
                        <td class="py-4">432</td>
                        <td class="py-4">296</td>
                        <td class="py-4">78</td>
                        <td class="py-4">0/5</td>
                        <td class="py-4">23</td>
                        <td class="py-4">-</td>
                    </tr>
                    <tr class="border-b {{ $tableBorderClass }} {{ $tableHoverClass }} transition-colors">
                        <td class="py-4 font-bold flex items-center gap-2">
                            Friedrich Beren
                            <svg class="w-4 h-4 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10c0 3.866-3.582 7-8 7a8.841 8.841 0 01-4.083-.98L2 17l1.338-3.123C2.493 12.767 2 11.434 2 10c0-3.866 3.582-7 8-7s8 3.134 8 7zM7 9H5v2h2V9zm8 0h-2v2h2V9zM9 9h2v2H9V9z" clip-rule="evenodd" />
                            </svg>
                        </td>
                        <td class="py-4">589</td>
                        <td class="py-4">189</td>
                        <td class="py-4">48</td>
                        <td class="py-4">2/1</td>
                        <td class="py-4">12</td>
                        <td class="py-4">1.5</td>
                    </tr>
                    <tr class="border-b {{ $tableBorderClass }} {{ $tableHoverClass }} transition-colors">
                        <td class="py-4 font-bold">Bruno Soares</td>
                        <td class="py-4">298</td>
                        <td class="py-4">489</td>
                        <td class="py-4">109</td>
                        <td class="py-4">8/12</td>
                        <td class="py-4">8</td>
                        <td class="py-4">-</td>
                    </tr>
                    <tr class="border-b {{ $tableBorderClass }} {{ $tableHoverClass }} transition-colors">
                        <td class="py-4 font-bold flex items-center gap-2">
                            Serhan Tekin
                            <svg class="w-4 h-4 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10c0 3.866-3.582 7-8 7a8.841 8.841 0 01-4.083-.98L2 17l1.338-3.123C2.493 12.767 2 11.434 2 10c0-3.866 3.582-7 8-7s8 3.134 8 7zM7 9H5v2h2V9zm8 0h-2v2h2V9zM9 9h2v2H9V9z" clip-rule="evenodd" />
                            </svg>
                        </td>
                        <td class="py-4">97</td>
                        <td class="py-4">309</td>
                        <td class="py-4">37</td>
                        <td class="py-4">29</td>
                        <td class="py-4">-</td>
                        <td class="py-4">-</td>
                    </tr>
                    <tr class="{{ $tableHoverClass }} transition-colors">
                        <td class="py-4 font-bold">David Gomes</td>
                        <td class="py-4">374</td>
                        <td class="py-4">190</td>
                        <td class="py-4">48</td>
                        <td class="py-4">3/8</td>
                        <td class="py-4">5</td>
                        <td class="py-4">-</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

