@php use App\Models\Clients; @endphp
<?php
/** @var Clients $model */
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
                                    <form action="{{ route('clients.destroy', ['id' => $model->id]) }}" method="POST"
                                          onsubmit="return confirm('{{ trans('are You Sure ? ') }}');"
                                          style="display: inline-block;">
                                        @csrf
                                        @method('delete')
                                        <button class="px-4 py-2 bg-red-700 rounded">Delete</button>
                                        <div class="mb-6">
                                            <label class="block">
                                                <b class="text-gray-700">Id: </b>
                                            </label>
                                            <pan>{{$model->id}}</pan>
                                            <hr>
                                        </div>
                                        <div class="mb-6">
                                            <label class="block">
                                                <b class="text-gray-700">Pass Id: </b>
                                            </label>
                                            <pan>{{$model->pass_id}}</pan>
                                            <hr>
                                        </div>
                                        <div class="mb-6">
                                            <label class="block">
                                                <b class="text-gray-700">Name: </b>
                                            </label>
                                            <span>{{$model->name}}</span>
                                            <hr>
                                        </div>
                                        <div class="mb-6">
                                            <label class="block"><span class="text-gray-700">Phones: </span></label>
                                            @foreach($model->phones as $i => $phone)
                                                <div class="mb-6">
                                                    <label class="block">
                                                        <span class="text-gray-700">{{ $i+1 }}: </span>
                                                    </label>
                                                    <span>{{$phone}}</span>
                                                    <hr>
                                                </div>
                                            @endforeach
                                            @error('phones')
                                            <div class="text-sm text-red-600">{{ $message }}</div>
                                            @enderror
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
