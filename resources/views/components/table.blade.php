

<table class="w-full text-sm text-left rtl:text-right text-gray-500">
    <thead class="text-xs text-gray-700 uppercase bg-gray-200">
        <tr>
            @foreach ($columns as $column)
                <th scope="col" class="px-6 py-3 text-center">{{ $column }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @forelse ($data as $item)
            <tr class="bg-white border-b border-gray-200">
                @foreach ($item as $cell)
                    <td class="px-6 py-4 align-top text-center">{!! $cell !!}</td>
                @endforeach
            </tr>
        @empty
            <tr>
                <td colspan="{{ count($columns) }}" class="text-center py-4 text-gray-500 italic">Data tidak tersedia.</td>
            </tr>
        @endforelse
    </tbody>
</table>
