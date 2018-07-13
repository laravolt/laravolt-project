<table class="ui table single line fixed">
    <thead>
    <tr>
        <th>Title</th>
        <th width="50%">Content</th>
        <th width="150">Category</th>
        <th width="150">Published Date</th>
    </tr>
    </thead>
    <tbody>
    @foreach(range(1,3) as $item)
        <tr>
            <td>{{ $faker->sentence(10) }}</td>
            <td>{{ $faker->paragraph(3) }}</td>
            <td>Uncategorized</td>
            <td>{{ $faker->date('j F Y') }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
