<?php
    use App\Inscricao;
    $anos = Inscricao::query()->distinct()->pluck('ano');
?>
@extends('home')
@section('conteudo')

    <section style="position: relative;">
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-history"></i>&nbsp; Historico</a></li>
        </ol>
    </section>

    <div class="nav-tabs-custom" style="background-color: #f2f2f2">
        <ul class="nav nav-tabs ">
            {{--<li class="pull-left active"><a data-slide-to="0" href="#carousellDiv" data-toggle="tab"><i style="color: #00a7d0" class="fa fa-list"></i>&nbsp;Todas</a></li>--}}
            {{--<li><a class="" data-slide-to="1" href="#carousellDiv" data-toggle="tab"><i style="color: #59c0d0" class="fa fa-user"></i>&nbsp;Por Aluno</a></li>--}}
            <li style="width: 100px; margin-left: 15px">
                <div>
                    <a class="myIcon"><i class="zmdi zmdi-calendar"></i></a>
                    <select class="material-control2"  id="selectAno">
                        @foreach($anos as $ano)
                            <option value="{{$ano}}">{{$ano}}</option>
                        @endforeach
                    </select>
                </div>
            </li>
        </ul>

        <div class="tab-content">
            <div class="row">
            <div class="col-lg-12">
                <table class="table-striped" id="tabela1" >
                    <thead>
                    <tr>
                        <th style="width: 10%">Foto</th>
                        <th style="width: 20%"> Nome Completo</th>
                        <th style="width: 10%">Sexo</th>
                        <th style="width: 10%">Data Nasc</th>
                        <th style="width: 15%">Naturalidade</th>
                        <th style="width: 15%">Contacto</th>
                        <th style="width: 20%">Ações</th>
                    </tr>
                    </thead>
                    <tbody id="tabela1Corpo" class="dados">
                    @foreach($alunos  as $ms)
                        <tr class="tr">
                            <td style="width: 10%">
                                <img src="{{asset('img/alunos/').'/'.$ms->foto}}" class="img-circle " width="50" height="50">
                            </td>
                            <td style="width: 20%">{{$ms->nome.' '.$ms->apelido}}</td>
                            <td style="width: 10%">{{$ms->sexo}}</td>
                            <td style="width: 10%">{{$ms->dataNasc}}</td>
                            <td style="width: 15%">{{$ms->naturalidade}}</td>
                            <td style="width: 15%">{{$ms->numero}}</td>

                            <td style="width: 20%; display: flex;" class="center">
                                <a class="btn btn-info btn-ver bt" data-id="{{$ms->id}}"><i class="zmdi zmdi-eye"></i></a>
                                <a class="btn btn-warning bt"><i class="zmdi zmdi-check"></i></a>
                                <a class="btn btn-danger bt"><i class="zmdi zmdi-delete"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $('#li-Historico').addClass('active');
        $('#li-HistoricoAluno').addClass('active');

        $('#selectAno').change(function () {
            ano = $(this).val();
            $.ajax({
                url: '/api/getAlunos',
                type: 'POST',
                data: {'ano': ano},

                success: function (rs) {
                    $('.tr').remove();
                    for (var i=0; i<rs.dados.length; i++) {
                        $('#tabela1Corpo').append('<tr class="tr">' +
                            '<td style="width: 10%"><img id="foto'+i+'" class="img-circle" height="50" width="50"></td>' +
                            '<td style="width: 20%">'+rs.dados[i].nome+' '+rs.dados[i].apelido+'</td>' +
                            '<td style="width: 10%">'+rs.dados[i].sexo+'</td>' +
                            '<td style="width: 10%">'+rs.dados[i].dataNasc+'</td>' +
                            '<td style="width: 8%">'+rs.dados[i].naturalidade+'</td>' +
                            '<td style="width: 8%">'+rs.dados[i].numero+'</td>' +
                            '</tr>');
                        document.getElementById('foto'+i).src =  '{{asset('img/alunos')}}'.concat('/' + rs.dados[i].foto);
                    }
                }
            });
        })
    </script>
@endsection