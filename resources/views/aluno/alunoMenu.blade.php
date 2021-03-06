<li class="treeview active">
    <a href="{{url('/')}}">
        <i class="fa fa-home"></i>
        <span>Inicio</span>
    </a>
</li>

<li class="treeview">
    <a href="#">
        <i class="fa fa-money"></i>
        <span>Mensalidades</span>
        <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
    </a>
    <ul class="treeview-menu">
        {{--<li><a href="{{'/mensalidade/registar'}}"><i class="fa fa-pencil"></i> Registar Mensalidades</a></li>--}}
        <li><a href="{{'/mensalidade'}}"><i class="fa fa-list"></i> Listar Mensalidades</a></li>
    </ul>
</li>



<li class="treeview">
    <a href="#">
        <i class="fa fa-bar-chart-o"></i>
        <span>Estatísticas</span>
        <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
    </a>
    <ul class="treeview-menu">
        <li><a href=""><i class="fa fa-pencil"></i>Alunos</a></li>
        <li><a href=""><i class="fa fa-money"></i> Mensalidade</a></li>
    </ul>
</li>

<li class="treeview">
    <a href="#">
        <i class="fa fa-history"></i>
        <span>Históricos</span>
        <span class="pull-right-container">
                                 <i class="fa fa-angle-left pull-right"></i>
                            </span>
    </a>
    <ul class="treeview-menu">
        {{--<li><a href=""><i class="fa fa-users"></i> Alunos</a></li>--}}
    </ul>
</li>

<li class="treeview">
    <a href="#">
        <i class="fa fa-book"></i>
        <span>Extras</span>
        <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
    </a>
    <ul class="treeview-menu">
        <li><a href="{{'/extras/lock'}}"><i class="fa fa-lock"></i> Bloquear Tela</a></li>
        <li><a href=""><i class="fa fa-list"></i> Listar</a></li>
    </ul>
</li>
