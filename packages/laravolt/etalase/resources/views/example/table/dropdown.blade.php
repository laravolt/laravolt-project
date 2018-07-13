<table class="ui table">
    <thead>
    <tr>
        <th>Nama</th>
        <th width="25%">Email</th>
        <th width="25%">Status</th>
        <th width="150"></th>
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
                <div class="ui dropdown button mini">
                    Action
                    <i class="dropdown icon"></i>
                    <div class="menu">
                        <a href="#" class="item"><i class="icon user"></i> View Profile</a>
                        <a href="#" class="item"><i class="icon edit"></i> Edit</a>
                        <a href="#" class="item"><i class="icon ban"></i> Ban...</a>
                        <div class="divider"></div>
                        <a href="#" class="item"><i class="icon trash"></i> Delete...</a>
                    </div>
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
