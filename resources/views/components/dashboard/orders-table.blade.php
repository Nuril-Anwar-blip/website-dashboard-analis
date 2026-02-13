@props(['theme' => 'light', 'orders' => []])

@php
    $bgClass = $theme === 'dark' ? 'bg-gray-800' : 'bg-white';
    $borderClass = $theme === 'dark' ? 'border-gray-700' : 'border-gray-200';
    $textPrimaryClass = $theme === 'dark' ? 'text-white' : 'text-gray-900';
    $textSecondaryClass = $theme === 'dark' ? 'text-gray-400' : 'text-gray-600';
    $textTertiaryClass = $theme === 'dark' ? 'text-gray-300' : 'text-gray-700';
    $hoverClass = $theme === 'dark' ? 'hover:bg-gray-700' : 'hover:bg-gray-50';
    $rowBgProcessed = $theme === 'dark' ? 'bg-gray-700/50' : 'bg-blue-50';
    $rowBgCancelled = $theme === 'dark' ? 'bg-gray-700/50' : 'bg-red-50';
@endphp

<div class="{{ $bgClass }} rounded-xl p-6 shadow-sm border {{ $borderClass }}">
    <h3 class="text-lg font-bold {{ $textPrimaryClass }} mb-4">Customer Order</h3>
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="text-left text-sm font-semibold {{ $textSecondaryClass }} border-b {{ $borderClass }}">
                    <th class="pb-3">Profile</th>
                    <th class="pb-3">Address</th>
                    <th class="pb-3">Date</th>
                    <th class="pb-3">Status</th>
                    <th class="pb-3 text-right">Price</th>
                </tr>
            </thead>
            <tbody class="text-sm">
                @forelse($orders as $order)
                    <tr class="border-b {{ $borderClass }} {{ $hoverClass }} transition-colors">
                        <td class="py-4">
                            <div class="flex items-center gap-3">
                                <img src="{{ $order['avatar'] ?? 'https://ui-avatars.com/api/?name=' . urlencode($order['name'] ?? 'User') . '&size=40' }}" class="w-10 h-10 rounded-lg">
                                <span class="font-semibold {{ $textPrimaryClass }}">{{ $order['name'] ?? 'Customer' }}</span>
                            </div>
                        </td>
                        <td class="py-4 {{ $textTertiaryClass }}">{{ $order['address'] ?? 'Unknown' }}</td>
                        <td class="py-4 {{ $textTertiaryClass }}">{{ $order['date'] ?? 'N/A' }}</td>
                        <td class="py-4">
                            @php
                                $status = $order['status'] ?? 'Delivered';
                                $statusClasses = [
                                    'Delivered' => $theme === 'dark' ? 'bg-green-900/30 text-green-400' : 'bg-green-100 text-green-800',
                                    'Processed' => $theme === 'dark' ? 'bg-blue-900/30 text-blue-400' : 'bg-blue-100 text-blue-800',
                                    'Cancelled' => $theme === 'dark' ? 'bg-red-900/30 text-red-400' : 'bg-red-100 text-red-800',
                                ];
                                $statusClass = $statusClasses[$status] ?? $statusClasses['Delivered'];
                            @endphp
                            <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $statusClass }}">
                                {{ $status }}
                            </span>
                        </td>
                        <td class="py-4 text-right font-semibold {{ $textPrimaryClass }}">{{ $order['price'] ?? '$0' }}</td>
                    </tr>
                @empty
                    <tr class="border-b {{ $borderClass }}">
                        <td class="py-4">
                            <div class="flex items-center gap-3">
                                <img src="https://ui-avatars.com/api/?name=Press&size=40" class="w-10 h-10 rounded-lg">
                                <span class="font-semibold {{ $textPrimaryClass }}">Press</span>
                            </div>
                        </td>
                        <td class="py-4 {{ $textTertiaryClass }}">London</td>
                        <td class="py-4 {{ $textTertiaryClass }}">22.08.2022</td>
                        <td class="py-4">
                            <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $theme === 'dark' ? 'bg-green-900/30 text-green-400' : 'bg-green-100 text-green-800' }}">Delivered</span>
                        </td>
                        <td class="py-4 text-right font-semibold {{ $textPrimaryClass }}">$920</td>
                    </tr>
                    <tr class="border-b {{ $borderClass }} {{ $rowBgProcessed }}">
                        <td class="py-4">
                            <div class="flex items-center gap-3">
                                <img src="https://ui-avatars.com/api/?name=Marina&size=40" class="w-10 h-10 rounded-lg">
                                <span class="font-semibold {{ $textPrimaryClass }}">Marina</span>
                            </div>
                        </td>
                        <td class="py-4 {{ $textTertiaryClass }}">Man city</td>
                        <td class="py-4 {{ $textTertiaryClass }}">24.08.2022</td>
                        <td class="py-4">
                            <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $theme === 'dark' ? 'bg-blue-900/30 text-blue-400' : 'bg-blue-100 text-blue-800' }}">Processed</span>
                        </td>
                        <td class="py-4 text-right font-semibold {{ $textPrimaryClass }}">$452</td>
                    </tr>
                    <tr class="border-b {{ $borderClass }} {{ $rowBgCancelled }}">
                        <td class="py-4">
                            <div class="flex items-center gap-3">
                                <img src="https://ui-avatars.com/api/?name=Alex&size=40" class="w-10 h-10 rounded-lg">
                                <span class="font-semibold {{ $textPrimaryClass }}">Alex</span>
                            </div>
                        </td>
                        <td class="py-4 {{ $textTertiaryClass }}">Unknown</td>
                        <td class="py-4 {{ $textTertiaryClass }}">18.08.2022</td>
                        <td class="py-4">
                            <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $theme === 'dark' ? 'bg-red-900/30 text-red-400' : 'bg-red-100 text-red-800' }}">Cancelled</span>
                        </td>
                        <td class="py-4 text-right font-semibold {{ $textPrimaryClass }}">$1200</td>
                    </tr>
                    <tr>
                        <td class="py-4">
                            <div class="flex items-center gap-3">
                                <img src="https://ui-avatars.com/api/?name=Robert&size=40" class="w-10 h-10 rounded-lg">
                                <span class="font-semibold {{ $textPrimaryClass }}">Robert</span>
                            </div>
                        </td>
                        <td class="py-4 {{ $textTertiaryClass }}">New York</td>
                        <td class="py-4 {{ $textTertiaryClass }}">03.08.2022</td>
                        <td class="py-4">
                            <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $theme === 'dark' ? 'bg-green-900/30 text-green-400' : 'bg-green-100 text-green-800' }}">Delivered</span>
                        </td>
                        <td class="py-4 text-right font-semibold {{ $textPrimaryClass }}">$1235</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

