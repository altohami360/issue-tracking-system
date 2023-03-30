<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto"><div class="relative overflow-x-auto border border-1 border-gray-200 rounded p-4 bg-white mb-4">
                <div class="flex justify-between items-center">
                    <div>
                        <a href="{{ route('users.create') }}"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 mt-8 py-2.5 text-center">
                            Create New User
                        </a>
                    </div>
                    <form action="{{ route('users.index') }}" method="get">
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
                                user name
                            </th>
                            <th scope="col" class="px-6 py-3">
                                email
                            </th>
                            <th scope="col" class="px-6 py-3">
                                role
                            </th>
                            <th scope="col" class="px-6 py-3">
                                status
                            </th>
                            <th scope="col" class="px-6 py-3">
                                --
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr class="bg-white border-0">
                                <th scope="row" class="px-6 py-4">
                                    {{ $user->name }}
                                </th>
                                <th scope="row" class="px-6 py-4">
                                    {{ $user->email }}
                                </th>
                                <th scope="row" class="px-6 py-4">
                                    {{ $user->role }}
                                </th>
                                <th scope="row" class="px-6 py-4">
                                    <span @class([
                                        'text-xs font-medium mr-2 px-2.5 py-0.5 rounded',
                                        'bg-green-600 text-white' =>
                                            $user->status,
                                        'bg-red-600 text-white' => !$user->status,
                                    ])>
                                        {{ $user->status ? 'active' : 'not active' }}
                                    </span>
                                </th>
                                <td class="px-6 py-4">
                                    <a href="#" onclick="deleteConfirm({{ $user->id }})" {{-- send id of form in deleteConfirm('form-id') --}}
                                        class="px-3 py-2 text-xs font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-40">Delete</a>
                                    <form action="{{ route('users.destroy', $user) }}" id="{{ $user->id }}"
                                        method="post" class="inline">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                    <a href="{{ route('users.edit', $user) }}"
                                        class="px-3 py-2 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-40">
                                        Edit
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
