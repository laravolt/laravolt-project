@extends('etalase::layout')

@section('page.title', 'Inbox')

@section('content-inner')

    <div class="ui grid stackable">
        <div class="column four wide">
            <div class="ui vertical menu">
                <a class="active item">
                    <div class="ui small label">19</div>
                    <i class="icon inbox"></i>
                    Inbox
                </a>
                <a class="item">
                    <div class="ui small label">1</div>
                    <i class="icon star yellow"></i>
                    Starred
                </a>
                <a class="item">
                    <div class="ui small label">5</div>
                    <i class="icon bookmark"></i>
                    Important
                </a>
                <a class="item">
                    <div class="ui small label">12</div>
                    <i class="icon mail"></i>
                    Sent Mail
                </a>
                <a class="item">
                    <div class="ui small label">51</div>
                    <i class="icon ban"></i>
                    Spam
                </a>
            </div>

            <div class="ui vertical menu">
                <div class="item"><h4 class="ui header">Filter by label:</h4></div>
                <a class="item">
                    <div class="ui red empty circular label"></div>
                    Important
                </a>
                <a class="item">
                    <div class="ui teal empty circular label"></div>
                    Work
                </a>
                <a class="item">
                    <div class="ui blue empty circular label"></div>
                    Interesting
                </a>
                <a class="item">
                    <div class="ui orange empty circular label"></div>
                    Discussion
                </a>
            </div>

        </div>
        <div class="column twelve wide">

            <div class="ui segment top attached">
                <form action="" class="ui form">
                    <div class="field">
                        <div class="ui icon input transparent">
                            <input type="text" placeholder="Search...">
                            <i class="search icon"></i>
                        </div>
                    </div>
                </form>
            </div>
            <div class="ui segment attached secondary">
                <div class="ui checkbox" data-toggle="checkall" data-selector=".checkbox[data-type='check-all-child']">
                    <input type="checkbox">
                </div>
                <div class="ui buttons small">
                    <div class="ui button icon" data-tooltip="Archive" data-inverted="true"><i class="icon archive"></i></div>
                    <div class="ui button icon" data-tooltip="Label" data-inverted="true"><i class="icon tag"></i></div>
                    <div class="ui button icon" data-tooltip="Move to trash" data-inverted="true"><i class="icon trash"></i></div>
                </div>

                <button class="ui button primary right floated"><i class="icon plus"></i> Compose</button>

            </div>
            <table class="ui table attached single line fixed">
                @foreach(range(1, 23) as $i => $item)
                    <tr>
                        <td width="60">
                            <div class="ui checkbox" data-type="check-all-child">
                                <input type="checkbox" name="_ids[]" value="{{ $i }}">
                            </div>
                            <i class="icon star {{ $faker->randomElement(['empty', 'yellow']) }}"></i>
                        </td>
                        <td width="120"><strong>{{ $faker->name }}</strong></td>
                        <td>
                            @if($i % 4 == 0)
                                <div class="ui label red mini">Important</div>
                            @endif
                            @if($i % 3 == 0)
                                <div class="ui label red teal mini">Work</div>
                            @endif
                            {{ $faker->paragraph(3) }}
                        </td>
                        <td width="70">{{ $faker->date('j M') }}</td>
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

        </div>
    </div>
@endsection
