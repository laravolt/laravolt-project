<div class="ui menu top attached">
    <div class="item borderless">
        <h3>Datatable</h3>
    </div>
    <div class="right menu">
        <div class="item">
            <form>
                <div class="ui transparent icon input">
                    <input class="prompt" name="search" value="" type="text" placeholder="Cari...">
                    <i class="search link icon"></i>
                </div>
            </form>
        </div>
    </div>
</div>

<table class="ui table attached single line fixed">
    <thead>
    <tr>
        <th width="50">
            <div class="ui checkbox" data-toggle="checkall" data-selector=".checkbox[data-type='check-all-child']">
                <input type="checkbox">
            </div>
        </th>
        <th>Title</th>
        <th width="50%">Content</th>
        <th width="150">Category</th>
        <th width="100">Published Date</th>
    </tr>
    </thead>
    <tbody>
    @foreach(range(1,3) as $i => $item)
        <tr>
            <td>
                <div class="ui checkbox" data-type="check-all-child">
                    <input type="checkbox" name="_ids[]" value="{{ $i }}">
                </div>
            </td>
            <td>{{ $faker->sentence(3) }}</td>
            <td>{{ $faker->paragraph(3) }}</td>
            <td>Uncategorize</td>
            <td>{{ $faker->date('j F Y') }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

<div class="ui menu bottom attached">
    <div class="item borderless">
        <small>Menampilkan 1-9 dari total 9</small>
    </div>
    <ul class="menu attached right bottom">
        <div class="item disabled"><i class="icon angle left"></i></div>
        <a class="item active">1</a>
        <a class="item">2</a>
        <a class="item"><i class="icon angle right"></i></a>
    </ul>
</div>
