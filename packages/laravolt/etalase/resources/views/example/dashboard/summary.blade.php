@extends('etalase::layout')
@section('content-inner')

    @etalase('Summary Board')


    <div class="ui celled grid">
        <div class="row">
            <div class="six wide column">
                <div class="ui segment basic">
                    <h4 class="ui header centered block">Goals</h4>
                    <ul class="ui list">
                        <li>Membuat sistem pengkajian yang membantu perawat dan dokter dalam penanganan pasien</li>
                    </ul>
                </div>
                <div class="ui segment basic">
                    <h4 class="ui header centered block">Stakeholders</h4>
                    <ul class="ui list relaxed">
                        <li class="item">
                            <strong>Bu Intan (Praktisi Keperawatan dari UGM)</strong> sebagai praktisi dan knowledge source
                        </li>
                        <li class="item"><strong>Wiley (penerbit internasional)</strong> sebagai pemegang lisensi NANDA
                        </li>
                    </ul>
                </div>
            </div>
            <div class="five wide column">
                <div class="ui segment basic">
                    <h4 class="ui header centered block">Issues/Risks</h4>
                    <ul class="ui list">
                        <li>Belum pernah requirement secara langsung dengan user</li>
                        <li>Non-CRUD, secara teknis cukup menantang</li>
                        <li>Pengurusan lisensi melibatkan pihak asing, tidak bisa cepat</li>
                    </ul>
                </div>
            </div>
            <div class="five wide column">
                <div class="ui segment basic">
                    <h4 class="ui header centered block">Action Plan</h4>
                    <ul class="ui list">
                        <li>-</li>
                        <li>Assign senior programmer</li>
                        <li>-</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="six wide column">
                <h4 class="ui header centered block attached top">Line Up</h4>
                <table class="ui table striped attached bottom padded">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Position</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>
                            <img src="http://a4.dev/img/bayu.jpg" class="ui image avatar">
                            Bayu Hendra Winata
                        </td>
                        <td>Manager</td>
                    </tr>
                    <tr>
                        <td>
                            <img src="http://a4.dev/img/sugihartono.png" class="ui image avatar">
                            Sugihartono
                        </td>
                        <td>Analyst</td>
                    </tr>
                    <tr>
                        <td>
                            <img src="http://a4.dev/img/dani.jpg" class="ui image avatar">
                            Dani Ramadani
                        </td>
                        <td>Programmer</td>
                    </tr>
                    <tr>
                        <td>
                            <img src="http://a4.dev/img/akbar.jpg" class="ui image avatar">
                            Akbar Adhatama
                        </td>
                        <td>Programmer</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="ten wide column">
                <h4 class="ui header centered block attached top">Schedule</h4>
                <table class="ui table attached bottom very compact">
                    <thead>
                    <tr>
                        <th class="left aligned">Agenda</th>
                        <th class="right aligned" style="width: 100px">Fixtures</th>
                        <th class="left aligned" style="width: 100px">Results</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="disabled">
                        <td><i class="icon soccer"></i> Kick Off</td>
                        <td class="right aligned">
                            <div class="ui label basic">22 Dec '15</div>
                        </td>
                        <td>
                            <div class="ui label red">12 Jan '16</div>
                        </td>
                    </tr>
                    <tr class="disabled">
                        <td>Requirement 1</td>
                        <td></td>
                        <td>
                            <div class="ui label">12 Jan</div>
                        </td>
                    </tr>
                    <tr class="disabled">
                        <td>Review 1</td>
                        <td></td>
                        <td>
                            <div class="ui label">12 Jan</div>
                        </td>
                    </tr>
                    <tr class="warning">
                        <td>Launching 1</td>
                        <td class="right aligned">
                            <div class="ui label basic">W4 Februari</div>
                        </td>
                        <td></td>
                    </tr>
                    <tr class="">
                        <td>Beta testing di RS UGM</td>
                        <td class="right aligned">
                            <div class="ui label basic">Mar-Jul</div>
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Demo di depan Presiden NANDA</td>
                        <td class="right aligned">
                            <div class="ui label basic">Agustus</div>
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td><i class="icon flag checkered"></i> Final Whistle</td>
                        <td class="right aligned"></td>
                        <td></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @endetalase
@endsection
