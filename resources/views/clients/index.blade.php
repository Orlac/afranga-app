<?php
/**
 *
 * @var \Illuminate\Contracts\Pagination\Paginator $models
 */
?>
<x-layout>

    <div class="py-12">
        <div class="mx-auto max-w-5xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="py-12">
                        <div class="mx-auto max-w-5xl sm:px-6 lg:px-8">
                            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                                <div class="p-6 bg-white border-b border-gray-200">
                                    <form method="GET" action="{{ route('clients.index') }}">
                                        @csrf
                                        <div class="mb-6">
                                            <label class="block">
                                                <span class="text-gray-700">Id: </span>
                                                <input type="text" name="id" class="" placeholder="123456"
                                                       value="{{ $request->input('id') }}" />
                                            </label>
                                            <hr>
                                            @error('id')
                                            <div class="text-sm text-red-600">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-6">
                                            <label class="block">
                                                <span class="text-gray-700">Pass Id: </span>
                                                <input type="text" name="pass_id" class="" placeholder="123456"
                                                       value="{{ $request->input('pass_id') }}" />
                                            </label>
                                            <hr>
                                            @error('pass_id')
                                            <div class="text-sm text-red-600">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-6">
                                            <label class="block">
                                                <span class="text-gray-700">Name: </span>
                                                <input type="text" name="name" class="" placeholder="Федосья Максимовна Корнилова"
                                                       value="{{ $request->input('name') }}" />
                                            </label>
                                            <hr>
                                            @error('name')
                                            <div class="text-sm text-red-600">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-6">
                                            <label class="block">
                                                <span class="text-gray-700">Phone: </span>
                                                <input type="text" name="phone" class="" placeholder="79045206981"
                                                       value="{{ $request->input('phone') }}" />
                                            </label>
                                            <hr>
                                            @error('phone')
                                            <div class="text-sm text-red-600">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-6">
                                            <input type="submit" value="Search" class="px-4 py-2 bg-red-700 rounded"/>
                                            | <input type="submit" value="Export" formaction="{{ route('clients.export') }}" class="px-4 py-2 bg-red-700 rounded"/>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-1 mb-4">

                    </div>
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <div class="p-6 bg-white border-b border-gray-200">
                            {{ $models->links() }}
                        </div>
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th  scope="col" class="px-6 py-3">Id</th>
                                        <th  scope="col" class="px-6 py-3">PassId</th>
                                        <th  scope="col" class="px-6 py-3">Name</th>
                                        <th  scope="col" class="px-6 py-3">Phones</th>
                                        <th  scope="col" class="px-6 py-3"></th>
                                    </tr>
                            </thead>
                            <tbody>
                            @foreach ($models as $model)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">{{ $model->id }}</td>
                                    <td class="px-6 py-4">{{ $model->pass_id }}</td>
                                    <td class="px-6 py-4">{{ $model->name }}</td>
                                    <td class="px-6 py-4">{{ implode(', ', $model->getLastPhones()) }}</td>
                                    <td class="px-6 py-4">
                                        <a href="{{ route('clients.show', ['id' => $model->id]) }}">Show</a>
                                        | <a href="{{ route('clients.edit', ['id' => $model->id]) }}">Update</a>
                                        | <form action="{{ route('clients.destroy', ['id' => $model->id]) }}" method="POST"
                                              onsubmit="return confirm('{{ trans('are You Sure ? ') }}');"
                                              style="display: inline-block;">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <button class="px-4 py-2 bg-red-700 rounded">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="p-6 bg-white border-b border-gray-200">
                            {{ $models->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


</x-layout>
