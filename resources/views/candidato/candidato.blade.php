@extends('home')
@section('conteudo')
    {{--{{$al}}--}}
    <section style="position: relative;">
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-users"></i>&nbsp; Candidatos</a></li>
        </ol>
    </section>
    <div class="row"  style="margin-top: -10px">
        <div class="input-field col-sm-4">
            <input type="text" id="txtPesquisar" onkeyup="filtrar()">
            <label for="txtPesquisar"><i class="fa fa-search"></i>&nbsp;Pesquisar</label>
        </div>
    </div>
    <div class="row" style=" margin-bottom: -20px" >
        <div class="col-sm-8 col-md-8 col-lg-8" id="divTableCandidatos">
            @include('candidato.candidatoTabela')
        </div>
        <div id="box-Info" class="col-sm-4 col-md-4 col-lg-4">
                <div  class="box box-widget widget-user" style="display: flex; flex-direction: column; padding: 5px; background-color: #f5f5f5;">

                    @foreach($primeiroCand as $pc)

                        <div class="lockscreen-item text-right">
                            <div class="lockscreen-image" >
                                <img id="idFoto" class="img-rounded" src="{!! asset('img/alunos/'.$pc->foto) !!}" height="110">
                            </div>
                            <input id="idCandidato" type="hidden" value="0">
                            <h5 id="nomeAluno">{{$pc->nome}}</h5>
                        </div>
                        <div class="col-sm-12" style="padding: 2px; margin-top: 10px; background-color: white">
                            <ul class="todo-list" id="contacto">
                                <li class="cont" style="margin-bottom: 5px">

                                    <h6 style="font-size: 14px">
                                        <span class="handle" style="width: 30%;">
                                            <i class="fa fa-check text-aqua"></i>
                                            Sexo:
                                        </span>
                                        <span class="text" style="width: 50%">
                                            {{$pc->sexo}}
                                        </span>
                                    </h6>
                                </li>
                                <li class="cont" style="margin-bottom: 5px">

                                    <h6 style="font-size: 14px">
                                        <span class="handle" style="width: 30%">
                                            <i class="fa fa-location-arrow text-aqua"></i>
                                            Residência:
                                        </span>
                                        <span class="text" style="width: 50%">
                                            {{$pc->residencia}}
                                        </span>
                                    </h6>
                                </li>

                                <li class="cont" style="margin-bottom: 5px">
                                    <h6 style="font-size: 14px">
                                        <span class="handle" style="width: 30%">
                                            <i class="fa fa-phone text-aqua"></i>
                                            Contacto:
                                        </span>
                                        <span class="text" style="width: 50%">
                                            {{$pc->numero}}
                                        </span>
                                    </h6>
                                </li>

                                <li class="cont" style="margin-bottom: 5px">

                                    <h6 style="font-size: 14px">
                                        <span class="handle" style="width: 30%">
                                            <i class="fa fa-phone text-aqua"></i>
                                            Email:
                                        </span>
                                        <span class="text" style="width: 50%">
                                            {{$pc->email}}
                                        </span>
                                    </h6>
                                </li>
                            </ul>
                        </div>
                    @endforeach
                </div>
                <div class="row">
                    <div class="box">
                        <div class="box-header with-border text-center">
                            <h3 class="box-title">Disciplinas Inscritas</h3>
                        </div>
                        <div class="box-body">
                            <ul class="todo-list" id="curso" style="display: flex">
                                @foreach($disciplinas as $d)
                                    <li class="crs">
                                            <span class="handle">
                                                <i class="fa fa-book" style="color: #00b0ff"></i>
                                            </span>
                                        {{--<span class="text">Disciplina</span>--}}
                                        <span class="text">{{$d->nome}}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
        </div>
    </div>

    <div class="lock-screen">
        <div class="modal fade" id="modalValidar"  role="dialog" data-keyboard="false" data-backdrop="static">
            <div class="modal-dialog">
                <div class="modal-content modal-lg">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h5 class="modal-title">Validar Pre-Inscrição</h5>
                    </div>
                    <div class="modal-body" id="modalValidar">
                        @include('candidato.validacao')
                    </div>
                    <div class="modal-footer">
                        <button style="float: left" data-dismiss="modal" class="btn btn-danger" type="button">Nao</button>
                        <a title="Validar Inscrição"> Validar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $('#li-Candidato').addClass('active');
        var anoActual =  (new Date()).getFullYear();

        function filtrar() {

            var input = document.getElementById("txtPesquisar");
            var tabela = document.getElementById("tabela1");
            var linhas = tabela.getElementsByTagName("tr");
            var tbCorpo = document.getElementById('tabela1Corpo').rows.length;

            for (var indice = 0; indice < linhas.length; indice++) {
                var coluna = linhas[indice].getElementsByTagName("td")[1];
                if (coluna) {
                    if (coluna.innerHTML.toLowerCase().indexOf(input.value.toLowerCase()) > -1) {
                        linhas[indice].style.display = "";
                    } else {
                        linhas[indice].style.display = "none";
                    }
                }
            }
            var line = $('#tabela1Corpo > tr:visible').length;
            if(line === 1){
                var idCand = $('#tabela1Corpo > tr:visible').attr('data-id');
                buscarDadosCandidato(idCand);
            }
        }

        $(window).on('hashchange', function() {
            if (window.location.hash) {
                var page = window.location.hash.replace('#', '');
                if (page == Number.NaN || page <= 0) {
                    return false;
                } else {
                    getPosts(page);
                }
            }
        });

        $(document).ready(function() {
            $(document).on('click', '.pagination a', function (e) {
                e.preventDefault();
                getPosts($(this).attr('href').split('page=')[1]);
            });
        });

        function getPosts(page) {
            $.ajax({
                url : '?page='+page
            }).done(function (data) {
                $('#divTableCandidatos').html(data);

                $('.btn-ver').click(function () {
                    var idCandidato = $(this).attr('data-id');
                    var ultimoId = parseInt(document.getElementById('idCandidato').value);
                    if (parseInt(idCandidato) === ultimoId) {
                        return;
                    }
                    buscarDadosCandidato(idCandidato);
                    $('#box-Info').animate({
                        left: '0px'
                    },"fast",voltar());
                });

            }).fail(function () {
                alert('Ocorreu Algum Erro');
            });
        }

        $('.btn-ver').click(function () {
            var idCandidato = $(this).attr('data-id');
            var ultimoId = parseInt(document.getElementById('idCandidato').value);
            if (parseInt(idCandidato) === ultimoId) {
                return;
            }
            buscarDadosCandidato(idCandidato);
//            $('#box-Info').animate({
//                left: '0px'
//            },"fast",voltar());
        });

        function voltar() {
            $('#box-Info').animate({
                left: '+=380px'
            },"fast")
        }

        function buscarDadosCandidato(idCandidato) {
            $.ajax({
                url: '/api/getInscricao',
                type: 'POST',
                data: {'idAluno': idCandidato, 'ano': anoActual},
                success: function (rs) {
                    document.getElementById('idCandidato').value = idCandidato;
                    document.getElementById('nomeAluno').innerHTML = rs.inscricao[0].nome;
                    document.getElementById('idFoto').src =  '{{asset('img/alunos')}}'.concat('/' + rs.inscricao[0].foto);

                    $('.cont').remove();
                    $('.crs').remove();
                    for (var i = 0; i < rs.inscricao.length; i++) {
                        $('#curso').append('<li class="crs" style="margin-bottom:3px"><span class="handle"> <i style="color: #00a7d0;" class="fa fa-book"></i> </span> <span class="text">' + rs.inscricao[i].disciplina + '</span></li>')
                        $('#curso2').append('<li class="crs" style="margin-bottom:3px"><span class="text">' + rs.inscricao[i].disciplina + '</span></li>')
                    }
                    $('#contacto').append('<li class="cont" style="margin-bottom: 5px"> <h6 style="font-size: 14px"> <span class="handle" style="width: 30%"> <i class="fa fa-check text-aqua"></i>&nbsp;Sexo:</span> <span class="text" style="width: 50%">'+rs.inscricao[0].sexo+' </span> </h6></li>');
                    $('#contacto').append('<li class="cont" style="margin-bottom: 5px"> <h6 style="font-size: 14px"> <span class="handle" style="width: 30%"> <i class="fa fa-location-arrow text-aqua"></i>&nbsp;Residência:</span> <span class="text" style="width: 50%">'+rs.inscricao[0].residencia+'</span> </h6></li>');
                    $('#contacto').append('<li class="cont" style="margin-bottom: 5px"> <h6 style="font-size: 14px"> <span class="handle" style="width: 30%"> <i class="fa fa-phone text-aqua"></i>&nbsp;Contacto:</span> <span class="text" style="width: 50%">'+rs.inscricao[0].numero+'</span> </h6></li>');
                    $('#contacto').append('<li class="cont" style="margin-bottom: 5px"> <h6 style="font-size: 14px"> <span class="handle" style="width: 30%"> <i class="fa fa-envelope text-aqua"></i>&nbsp;Email:</span> <span class="text" style="width: 50%">'+rs.inscricao[0].email+' </span> </h6></li>');
                }
            });
        }

//        $.ajax({
//            url: '/api/utimoCandidato',
//            type: 'POST',
//            success: function (id) {
//                buscarDadosCandidato(id)
//            }
//        });


        /*validacao de pre inscricao*/

        $('.btn-validar').click(function () {
            var idCandidato = $(this).attr('data-id');
            buscarDadosCandidato(idCandidato);
            $.ajax({
                url: '/api/getInscricao',
                type: 'POST',
                data: {'idAluno': idCandidato, 'ano': anoActual},
                success: function (rs) {
                    document.getElementById('nomeAlunoValidacao').innerHTML = rs.inscricao[0].nome;
                    document.getElementById('idFotoValidacao').src =  '{{asset('img/alunos')}}'.concat('/' + rs.inscricao[0].foto);

                    $('#modalValidar').modal({
                        show: true,
                        backdrop: "static"
                    });
                }
            })
        })
    </script>

@endsection
