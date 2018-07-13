<table class="ui table fixed">
    <thead>
    <tr>
        <th>Nama</th>
        <th width="25%">Email</th>
        <th width="25%">Status</th>
        <th width="150">Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach(range(1,3) as $item)
        <tr>
            <td>{{ $faker->name }}</td>
            <td>{{ $faker->safeEmail }}</td>
            <td>
                <div class="ui label">ACTIVE</div>
            </td>
            <td>
                <a class="ui button mini" href="">Edit</a>
                <a class="ui button icon mini" href=""><i class="icon trash"></i></a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
