@extends('etalase::layout')
@section('content-inner')

    @etalase('Dashboard')

    <div class="ui grid four column stackable celled">
        <div class="column center aligned middle aligned">
            <div class="ui statistic red">
                <div class="label">
                    Pegawai
                </div>
                <div class="value">
                    45
                </div>
                <div class="label">
                    <i class="icon triangle up green"></i><span class="green text">12%</span>
                </div>
            </div>
        </div>
        <div class="column center aligned middle aligned">
            <div class="ui statistic orange">
                <div class="label">
                    Total Proyek
                </div>
                <div class="value">
                    98
                </div>
                <div class="label">
                    <i class="icon triangle down red"></i><span class="red text">-5%</span>
                </div>
            </div>
        </div>
        <div class="column center aligned middle aligned">
            <div class="ui statistic yellow">
                <div class="label">
                    Total Omzet
                </div>
                <div class="value">
                    9.1 M
                </div>
                <div class="label">
                    <i class="icon triangle down red"></i><span class="red text">-10%</span>
                </div>
            </div>
        </div>
        <div class="column center aligned middle aligned">
            <div class="ui statistic teal">
                <div class="label">
                    Klien
                </div>
                <div class="value">
                    27
                </div>
                <div class="label">
                    <i class="icon triangle up green"></i><span class="green text">-17%</span>
                </div>
            </div>
        </div>
    </div>

    <div class="ui grid four column stackable">
        <div class="column">
            <div class="ui segment inverted red center aligned">
                <div class="ui statistic inverted">
                    <div class="value">
                        45
                    </div>
                    <div class="label">
                        Pegawai
                    </div>
                </div>
            </div>
        </div>
        <div class="column">
            <div class="ui segment inverted orange center aligned">
                <div class="ui statistic inverted">
                    <div class="value">
                        98
                    </div>
                    <div class="label">
                        Total Proyek
                    </div>
                </div>
            </div>
        </div>
        <div class="column">
            <div class="ui segment inverted yellow center aligned">
                <div class="ui statistic inverted">
                    <div class="value">
                        9.1 M
                    </div>
                    <div class="label">
                        Total Omzet
                    </div>
                </div>
            </div>
        </div>
        <div class="column">
            <div class="ui segment inverted teal center aligned">
                <div class="ui statistic inverted">
                    <div class="value">
                        27
                    </div>
                    <div class="label">
                        Klien
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="ui grid stackable">
        <div class="ten wide column">

            <div class="ui segment padded top attached">
                <h3 class="ui header">Top 10 Performer</h3>
                <div id="chart-top-performer" style="height: 300px;"></div>
            </div>
            <div class="ui segment bottom attached" style="padding: 0">
                <div class="ui grid four column stackable internally celled" style="margin:0">
                    <div class="column center aligned middle aligned">
                        <div class="ui statistic red">
                            <div class="value">
                                45
                            </div>
                            <div class="label">
                                Pegawai
                            </div>
                        </div>
                    </div>
                    <div class="column center aligned middle aligned">
                        <div class="ui statistic orange">
                            <div class="value">
                                98
                            </div>
                            <div class="label">
                                Total Proyek
                            </div>
                        </div>
                    </div>
                    <div class="column center aligned middle aligned">
                        <div class="ui statistic yellow">
                            <div class="value">
                                9M
                            </div>
                            <div class="label">
                                Total Omzet
                            </div>
                        </div>
                    </div>
                    <div class="column center aligned middle aligned">
                        <div class="ui statistic teal">
                            <div class="value">
                                27
                            </div>
                            <div class="label">
                                Klien
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="six wide column">
            <div class="ui segment">
                <h3 class="ui header">Project State</h3>
                <!-- HTML -->
                <div id="chart-pie" style="margin: auto; max-width: 360px;"></div>
                <div id="chart-pie-legend" style="max-width: 360px; margin: auto;"></div>

            </div>
        </div>
    </div>

    @endetalase

@endsection

@push('head')
<link rel="stylesheet" href="{{ asset('lib/graf/grafs.css') }}">
@endpush

@push('body')
<script src="{{ asset('lib/graf/grafs.js') }}"></script>
<!-- JS -->
<script>
    var data = {
        labels: ['Ardin', 'Bayu', 'Citra', 'Dani', 'Eko', 'Fitrop', 'Ginanjar', 'Hendra', 'Indra', 'Joko'],
        data: [130, 98, 92, 80, 80, 77, 67, 65, 63, 50],
        colors: ['#DB2828']
    };

    var options = {shadow: false};

    var line = new Grafs.Bar('#chart-top-performer', data, options);
</script>

<!-- JS -->
<script>
    var data = {
        labels: ["Active", "Maintenance", "Closed"],
        data: [8, 3, 16],
        colors: ['#96d759', '#ff8c42', '#ff4053']
    };

    var options = {
        shadow: false,
        legend: {
            target: '#chart-pie-legend'
        }
    };

    var pie = new Grafs.Pie('#chart-pie', data, options);
</script>
@endpush
