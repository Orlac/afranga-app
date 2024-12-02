<x-layout>
    <div class="p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400" role="alert">
        <span class="font-medium">file is too long, we are send this of email</span>
    </div>
    <form action="{{ route('clients.export.lazy') }}" method="POST">
        @csrf
        <div style="display: none">
            <input type="text" name="id" class="" value="{{ $request->input('id') }}"  />
            <input type="text" name="pass_id" class="" value="{{ $request->input('pass_id') }}"  />
            <input type="text" name="name" class="" value="{{ $request->input('name') }}"  />
            <input type="text" name="phone" class="" value="{{ $request->input('phone') }}"  />
        </div>

        <div class="mb-6">
            <input type="text" name="mail" style="width: 100%" class="" placeholder="mail@exmpl.com" value="{{ $request->input('mail') ?? 'mail@exmpl.com' }}" />
            <hr>
            @error('mail')
            <div class="text-sm text-red-600">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-6">
            <button class="px-4 py-2 bg-red-700 rounded">Export</button>
        </div>
    </form>

</x-layout>
