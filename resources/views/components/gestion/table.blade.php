<div class="w-100" style="overflow-x: auto">
    <?php 
    if(!isset($canCreateDelete)) $canCreateDelete = true ;
    if (!isset($option)) $option = "";
    ?>
    <table class="table">
        <thead>
            <tr>
                @foreach($infostable as $infos)
                    <td>
                        {{ $infos['nom_col'] }}
                    </td>
                @endforeach
                <td class="text-end w-auto">
                    &nbsp;
                    @isset($route)
                        <a class="btn btn-secondary" href="{{ $route.'/new' }}">
                            Créer un nouvel element
                        </a>
                    @endisset
                    @isset ($livewireObject)
                        @if ($canCreateDelete == true)
                            <a class="btn btn-secondary" onclick="showModal('{{ $livewireObject }}',0, 0 )">
                                Créer un nouvel element
                            </a>
                        @endif
                    @endisset
                </td>
            </tr>
        </thead>
        <tbody>
            @foreach ($typesclient as $typeclient)
                <tr style="vertical-align: middle">
                    @foreach($infostable as $nom => $infos)
                        <td class="@isset($infos['class']) {{$infos['class']}} @endisset">
                            @if (isset($infos['datas']))

                                {{ isset($infos['datas'][$typeclient->{$nom}]) ? ucfirst(strtolower($infos['datas'][$typeclient->{$nom}]->nom)) : '-' }}
                           
                            @elseif (isset($infos['pop_up']))
                                <div class="d-flex d-row">
                                    @foreach ($infos['pop_up'] as $key => $pop_up)
                                        <a href="#" class="btn @if ($key == 0)align-self-center @endif" 
                                        @isset($pop_up['title']) data-bs-placement="top" title="{{$pop_up['title']}}" @endisset                                         
                                        onclick="showModal('{{ $pop_up['type'] }}', 0, {{$typeclient->{ $infos['col']} }})">
                                            <i class="{{$pop_up['icone']}}"></i>
                                        </a>
                                    @endforeach
                                </div>

                            @elseif (isset($infos['date']))
                                
                                {{ $infos['carbon']::parse($typeclient->{$nom})->format($infos['format']) }}
                            
                            @elseif (isset($infos['nomfilmDemande']))

                                    {{ $typeclient->getNomFilm() }}

                            @elseif (isset($infos['nombrefilmDemande']))

                                    {{ $typeclient->getNombreDemande($idCinema) }}

                            @elseif (isset($infos['StatutFilm']))

                                    {{ $typeclient->StatutFilm() }}

                            @elseif (isset($infos['StatutKdm']))

                                    {{ $typeclient->StatutKdm() }}

                            @else

                                {{ $typeclient->{$nom} == "" ? '-' : $typeclient->{$nom} }}
                            
                            @endif
                            
                        </td>
                    @endforeach
                    <td class="text-end w-auto">
                        @isset($route)
                        
                            <a class="btn btn-secondary" href="{{ $route.'/'.$typeclient->slug }}">
                                Modifier
                            </a>
                            <a class="btn btn-secondary ms-3" href="{{ $route.'/delete/'.$typeclient->slug }}">
                                Supprimer
                            </a>
                        @endisset
                        @isset ($livewireObject)
                            <button class="btn btn-secondary" type="button" onclick="showModal('{{ $livewireObject }}', {{$typeclient->id}}, 0)" >
                                Modifier
                            </button>
                            @if ($canCreateDelete == true)
                                <button class="btn btn-secondary ms-3" wire:click="delete({{$typeclient->id}})" type="button">
                                    Supprimer
                                </button>
                            @endif
                        @endisset
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @isset($useModal)
        @foreach ($useModal as $modal)
            <x-popup.index :livewireObject="$modal" :idCinema="$idCinema" :option="$option"/>
        @endforeach
    @endisset
</div>