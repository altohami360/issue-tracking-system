<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Labels') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto">
            <div class="relative overflow-x-auto border border-1 border-gray-200 rounded p-4 bg-white mb-4">

                <div class="flex justfiy-between border border-1 border-gray-200 p-4 mb-6">
                    <div class="w-1/2 space-y-4">
                        <p><span class="font-bold">Priority : </span> <span>{{ $ticket->priority }}</span></p>
                        <p><span class="font-bold">Status : </span> <span>{{ $ticket->status }}</span></p>
                        <p><span class="font-bold">User : </span> <span>{{ $ticket->user->name }}</span></p>
                        <p><span class="font-bold">Role : </span> <span>{{ $ticket->role }}</span></p>
                    </div>
                    <div class="w-1/2 space-y-4">
                        <p>
                            Resolved :
                            <span @class([
                                'text-xs font-medium mr-2 px-2.5 py-0.5 rounded',
                                'bg-green-600 text-white' =>
                                    $ticket->resolved,
                                'bg-red-600 text-white' => !$ticket->resolved,
                            ])>
                                {{ $ticket->resolved ? 'resolved' : 'not resolved' }}
                            </span>
                        </p>
                        <p>
                            Labels :
                            @foreach ($ticket->labels as $item)
                                <span
                                    class="bg-blue-100 text-blue-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded">{{ $item->name }}</span>
                            @endforeach
                        </p>
                        <p>
                            Categories :
                            @foreach ($ticket->categories as $item)
                                <span
                                    class="bg-blue-100 text-blue-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded">{{ $item->name }}</span>
                            @endforeach
                        </p>
                        <div>
                            @if (!$ticket->resolved && !$ticket->isArchive)
                                <form action="{{ route('tickets.solve', $ticket) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit"
                                        class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-4 py-2 text-center">
                                        Solved
                                    </button>
                                </form>
                            @endif
                            @if (!$ticket->isClose && !$ticket->isArchive)
                                <form action="{{ route('tickets.close', $ticket) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit"
                                        class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-4 py-2 text-center">
                                        Close
                                    </button>
                                </form>
                            @endif
                            @if ($ticket->isClose && !$ticket->isArchive)
                                <form action="{{ route('tickets.reopen', $ticket) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit"
                                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                        Reopen
                                    </button>
                                </form>
                            @endif
                            @if (!$ticket->isArchive)
                                <form action="{{ route('tickets.archive', $ticket) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit"
                                        class="text-white bg-yellow-700 hover:bg-yellow-800 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-yellow-600 dark:hover:bg-yellow-700 dark:focus:ring-yellow-800">
                                        Archive
                                    </button>
                                </form>
                            @endif
                            @if ($ticket->isArchive)
                                <form action="{{ route('tickets.unarchive', $ticket) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit"
                                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                        Un Archive
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>

                <div class=" p-4 mb-6 space-y-4">



                    <h2 class="text-xl">{{ $ticket->title }}</h2>

                    <p>{{ $ticket->description }}</p>
                </div>

            </div>

            <div class="relative border border-1 border-gray-200 rounded p-4 bg-white mb-4">
                <div class="mb-6 grid justify-items-stretch overflow-auto h-96 border border-gray-300">
                    @foreach ($messages as $message)
                        @if (is_null($message->sender_id))
                            <div class="justify-self-end grid justify-items-end text-white w-1/2">
                                <div class="bg-blue-600 px-4 py-2 mx-4 mt-2 rounded-t-xl  rounded-l-xl">
                                    {{ $message->content }}
                                </div>
                                <span
                                    class=" py-2 px-4 my-1 mx-4 bg-blue-600 block w-fit h-fit rounded-b-full rounded-tl-full">
                                    admin
                                </span>
                            </div>
                        @else
                            <div class="justify-self-start grid justify-items-start w-1/2 text-white">
                                <div class="bg-gray-600 px-4 py-2 mx-4 mt-2 rounded-t-xl  rounded-r-xl">
                                    {{ $message->content }}
                                </div>
                                <span
                                    class=" py-2 px-4 my-1 mx-4 bg-gray-600 block w-fit h-fit rounded-b-full rounded-tr-full">
                                    U
                                </span>
                            </div>
                        @endif
                    @endforeach
                </div>
                <form action="{{ route('messages.send') }}" method="post">
                    @csrf
                    <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
                    <div class="mb-6">
                        <label for="D" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your
                            Message</label>
                        <textarea id="D" rows="4" name="content"
                            class="block p-2.5 w-1/2 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"></textarea>
                    </div>
                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                        Send
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
