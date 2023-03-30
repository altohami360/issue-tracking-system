<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Labels') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if ($errors->any())
                <div class="p-4 mb-4 text-sm text-white rounded-lg bg-red-600"
                    role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="relative overflow-x-auto border border-1 border-gray-200 rounded p-4 bg-white mb-4">
                <form action="{{ route('tickets.store') }}" method="POST">
                    @csrf
                    <div class="mb-6">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900">
                            Title
                        </label>
                        <input type="text" id="name" name="title"
                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-1/2 p-2">
                    </div>
                    <div class="mb-6">
                        <label for="D" class="block mb-2 text-sm font-medium text-gray-900">Your
                            Description</label>
                        <textarea id="D" rows="4" name="description"
                            class="block p-2.5 w-1/2 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"></textarea>
                    </div>
                    <div class="mb-6">
                        <label for="countries_multiple"
                            class="block mb-2 text-sm font-medium text-gray-900">
                            Priority
                        </label>
                        <select name="priority"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-1/2 p-2.5">
                            <option selected>Choose countries</option>
                            @foreach ($priority as $item)
                                <option value="{{ $item }}">{{ $item }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-6">
                        <label for="countries_multiple"
                            class="block mb-2 text-sm font-medium text-gray-900">
                            Tags
                        </label>
                        <select multiple id="countries_multiple" name="labels[]"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-1/2 p-2.5">
                            @foreach ($labels as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-6">
                        <label for="countries_multiple"
                            class="block mb-2 text-sm font-medium text-gray-900">
                            Categories
                        </label>
                        <div class="flex flex-wrap items-center mb-4 space-x-4 w-1/2">
                            @foreach ($categories as $item)
                                <div>
                                    <input id="{{ $item->id }}" type="checkbox" value="{{ $item->id }}"
                                        name="categories[]"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                                    <label for="{{ $item->id }}"
                                        class="ml-2 text-sm font-medium text-gray-900">{{ $item->name }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="mb-6">
                        <label class="block mb-2 text-sm font-medium text-gray-900">
                            Role
                        </label>
                        <select name="role"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-1/2 p-2.5">
                            @foreach ($roles as $item)
                                <option value="{{ $item }}">{{ $item }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                        Create
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
