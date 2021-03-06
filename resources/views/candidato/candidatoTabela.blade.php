{{--@sortablelink('estado')--}}
<table class="table-striped" id="tabela1" >
    <thead>
        <tr>
            <th style="width: 10%">Foto</th>
            <th style="width: 30%"> Nome Completo</th>
            <th style="width: 20%">Nº de BI</th>
            <th style="width: 20%">Data Nasc</th>
            <th style="width: 20%">Ações</th>
        </tr>
    </thead>
    <tbody id="tabela1Corpo" class="dados">

        @foreach($candidato  as $ms)
            <tr data-id="{{$ms->id}}">
                <td style="width: 10%">
                    <img src="{{asset('img/alunos/').'/'.$ms->foto}}" class="img-rounded " width="50" height="50">
                </td>
                <td style="width: 30%">{{ucwords(strtolower($ms->nome.' '.$ms->apelido))}}</td>
                <td style="width: 20%">{{$ms->numBi}}</td>
                <td style="width: 20%">{{date('d-M-Y',strtotime($ms->dataNasc))}}</td>

                <td style="width: 20%; display: flex;" class="center">
                    <a class="btn btn-info btn-ver bt" data-id="{{$ms->id}}"><i class="zmdi zmdi-eye"></i>&nbsp;Mais Info</a>
                    <a class="btn btn-success btn-validar bt" data-id="{{$ms->id}}"><i class="zmdi zmdi-check"></i>&nbsp;&nbsp;Validar&nbsp;&nbsp;</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<h6 class="center">{{$candidato->links()}}</h6>