<div>
    <table class="table">
        <thead>
            <tr>
                @foreach($infostable as $infos)
                    <td>
                        {{ $infos['nom_col'] }}
                    </td>
                @endforeach
                <td class="justify-content-end">
                    @isset($route)
                        <a class="btn btn-secondary" href="{{ $route.'/new' }}">
                            Crée un nouvel element
                        </a>
                    @endisset
                    @isset ($livewireObject)
                        @if ($canCreateDelete == true)
                            <a class="btn btn-secondary" href="{{ $route.'/new' }}">
                                Crée un nouvel element
                            </a>
                        @endif
                    @endisset
                </td>
            </tr>
        </thead>
        @if ($elementUpdate != -1)
            <!-- zone popup -->
            <x-popup.index :elementUpdate="$elementUpdate" :livewireObject="$livewireObject" :idCinema="$idCinema"/>
            <!-- fin zone popup -->
        @endif
        <tbody>
            @foreach ($typesclient as $typeclient)
                <tr>
                    @foreach($infostable as $nom => $infos)
                        <td class="">
                            @if (isset($infos['datas']))
                            {{ $infos['datas'][$typeclient->{$nom}]->nom }}
                            @else
                                {{ $typeclient->{$nom} == "" ? '-' : $typeclient->{$nom} }}
                            @endif
                            
                        </td>
                    @endforeach
                    <td class="w-auto d-flex flex-row justify-content-end">
                        @isset($route)
                        
                            <a class="btn btn-secondary" href="{{ $route.'/'.$typeclient->slug }}">
                                Modifier
                            </a>
                            <a class="btn btn-secondary ms-3" href="{{ $route.'/delete/'.$typeclient->slug }}">
                                Supprimer
                            </a>
                        @endisset
                        @isset ($livewireObject)
                            <button class="btn btn-secondary" wire:click="update({{ $typeclient->id }})">
                                Modifier
                            </button>
                            @if ($canCreateDelete == true)
                                <button class="btn btn-secondary ms-3" type="button">
                                    Supprimer
                                </button>
                            @endif
                        @endisset
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>