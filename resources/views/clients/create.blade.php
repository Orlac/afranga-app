<x-layout>

    <div class="py-12">
        <div class="mx-auto max-w-5xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="py-12">
                        <div class="mx-auto max-w-5xl sm:px-6 lg:px-8">
                            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                                <div class="p-6 bg-white border-b border-gray-200">
                                    <form method="POST" action="{{ route('clients.store') }}">
                                        @csrf
                                        <div class="mb-6">
                                            <label class="block">
                                                <span class="text-gray-700">Pass Id: </span>
                                                <input type="text" name="pass_id" class="" placeholder="123456"
                                                       value="{{ old('pass_id') }}" />
                                            </label>
                                            <hr>
                                            @error('pass_id')
                                            <div class="text-sm text-red-600">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-6">
                                            <label class="block"><span class="text-gray-700">Name: </span></label>
                                            <input type="text" name="name" style="width: 100%" placeholder="Федосья Максимовна Корнилова"
                                                   value="{{ old('name') }}" />

                                            <hr>
                                            @error('name')
                                            <div class="text-sm text-red-600">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-6">
                                            <label class="block"><span class="text-gray-700">Phones: </span></label>
                                            @for ($i=0; $i < env('CLIENTS_MAX_PHONE_COUNT'); $i++)
                                                <div class="mb-6">
                                                    <label class="block">
                                                        <span class="text-gray-700">{{ $i+1 }}: </span>
                                                        <input type="text"
                                                               name="phones[{{ $i }}]"
                                                               value="{{ old('phones['.$i.']') }}" />
                                                    </label>
                                                    <hr>
                                                </div>
                                            @endfor
                                            @error('phones')
                                            <div class="text-sm text-red-600">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-6">
                                            <button class="px-4 py-2 bg-red-700 rounded">Create</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</x-layout>
