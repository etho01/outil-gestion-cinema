<div>
    <table class="table">
        <thead>
            <tr>
                @foreach($infostable as $infos)
                    <td>
                        {{ $infos['nom_col'] }}
                    </td>
                @endforeach
                <td class="w-auto d-flex flex-row justify-content-end">
                    <a class="btn btn-secondary" href="{{ $route.'/new' }}">
                        Crée un nouvel element
                    </a>
                </td>
            </tr>
        </thead>
        <tbody>
            @foreach ($typesclient as $typeclient)
                <tr>
                    @foreach($infostable as $nom => $infos)
                        <td class="">
                            @if (isset($infos['datas']))
                            {{ $infos['datas'][$typeclient->{$nom}]->nom }}
                            @else
                                {{ $typeclient->{$nom} }}
                            @endif
                            
                        </td>
                    @endforeach
                    <td class="w-auto d-flex flex-row justify-content-end">
                        <a class="btn btn-secondary" href="{{ $route.'/'.$typeclient->slug }}">
                            Modifier
                        </a>
                        <a class="btn btn-secondary ms-3" href="{{ $route.'/delete/'.$typeclient->slug }}">
                            Supprimer
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>