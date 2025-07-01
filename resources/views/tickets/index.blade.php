<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tickets') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-4 gap-4 mb-4">
                <div class="w-full p-4 border border-1 border-gray-200 rounded bg-white">
                    <p class="font-medium">Total Tickets</p>
                    <span>{{ $counts['tickets_count'] }}</span>
                </div>
                <div class="w-full p-4 border border-1 border-gray-200 rounded bg-white">
                    <p class="font-medium">Resolved Tickets</p>
                    <span>{{ $counts['resolved_tickets'] }}</span>
                </div>
                <div class="w-full p-4 border border-1 border-gray-200 rounded bg-white">
                    <p class="font-medium">Closed Tickets</p>
                    <span>{{ $counts['closed_tickets'] }}</span>
                </div>
                <div class="w-full p-4 border border-1 border-gray-200 rounded bg-white">
                    <p class="font-medium">New Tickets</p>
                    <span>{{ $counts['new_tickets'] }}</span>
                </div>
            </div>
            <div class="relative overflow-x-auto border border-1 border-gray-200 rounded p-4 bg-white mb-4">
                <div class="flex justify-between items-center">
                    <div>
                        <a href="{{ route('tickets.create') }}"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 mt-8 py-2.5 text-center">
                            Create New Ticket
                        </a>
                    </div>
                    <form action="{{ route('tickets.index') }}" method="get">
                        <div class="flex space-x-4">
                            <div>
                                <input type="text" name="term"
                                    class="bg-gray-50 w-64 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2"
                                    placeholder="Search " value="{{ $term }}">
                            </div>
                            <div>
                                <button type="submit"
                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                    Search
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="max-w-7xl mx-auto">
            <div class="relative overflow-x-auto border border-1 border-gray-200 rounded">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                title
                            </th>
                            <th scope="col" class="px-6 py-3">
                                User
                            </th>
                            <th scope="col" class="px-6 py-3">
                                priority
                            </th>
                            <th scope="col" class="px-6 py-3">
                                status
                            </th>
                            <th scope="col" class="px-6 py-3">
                                resolved
                            </th>
                            <th scope="col" class="px-6 py-3">
                                time
                            </th>
                            <th scope="col" class="px-6 py-3">
                                --
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tickets as $ticket)
                            <tr class="bg-white border-b">
                                <th scope="row" class="px-6 py-4 ">
                                    <a href="{{ route('tickets.show', $ticket) }}"
                                        class="font-medium text-blue-700 whitespace-nowrap">{{ $ticket->title }}</a>
                                </th>
                                <th scope="row" class="px-6 py-4">
                                    {{ $ticket->user->name }}
                                </th>
                                <th scope="row" class="px-6 py-4">
                                    {{ $ticket->priority }}
                                </th>
                                <th scope="row" class="px-6 py-4">
                                    @if ($ticket->isNew)
                                        <span
                                            class='text-xs font-medium mr-2 px-2.5 py-0.5 rounded bg-blue-600 text-white'>
                                            {{ $ticket->status }}
                                        </span>
                                    @else
                                        {{ $ticket->status }}
                                    @endif
                                </th>
                                <th scope="row" class="px-6 py-4">
                                    <span @class(['text-xs font-medium mr-2 px-2.5 py-0.5 rounded', 'bg-green-600 text-white' => $ticket->resolved, 'bg-red-600 text-white' => !$ticket->resolved])>
                                        {{ $ticket->resolved ? 'resolved' : 'not resolved' }}
                                    </span>
                                </th>
                                <th scope="row" class="px-6 py-4">
                                    {{ $ticket->created_at->diffForHumans() }}
                                </th>
                                <td class="px-6 py-4 space-x-1">

                                    <a href="javascript:void(0)" onclick="deleteConfirm({{ $ticket->id }})"
                                        class="px-3 py-2 text-xs font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-40">
                                        Delete
                                    </a>

                                    <form action="{{ route('tickets.destroy', $ticket) }}" method="post" id="{{ $ticket->id }}"
                                        class="inline">
                                        @csrf
                                        @method('DELETE')
                                    </form>

                                    <a href="{{ route('tickets.edit', $ticket) }}"
                                        class="px-3 py-2 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-40">
                                        Edit
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $tickets->links() }}
        </div>
    </div>
</x-app-layout>
