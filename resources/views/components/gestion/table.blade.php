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
                            <a class="btn btn-secondary" data-bs-toggle="modal" data-bs-dimiss="modal" data-bs-target="#modal{{$livewireObject}}0">
                                Créer un nouvel element
                            </a>
                            <x-popup.index elementUpdate="0" :livewireObject="$livewireObject" :idCinema="$idCinema"/>
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

                                @foreach ($infos['pop_up'] as $key => $pop_up)
                                    <a href="#" class="btn @if ($key == 0)align-self-center @endif" 
                                    @isset($pop_up['title']) data-bs-placement="top" title="{{$pop_up['title']}}" @endisset 
                                    data-bs-toggle="modal" data-bs-target="#modal{{$pop_up['type']}}0">
                                        <i class="{{$pop_up['icone']}}"></i>
                                    </a>
                                    <x-popup.index elementUpdate="0" :livewireObject="$pop_up['type']" :idCinema="$idCinema" :idBase="$typeclient->id"/>
                                @endforeach

                            @elseif (isset($infos['date']))
                                
                                {{ $infos['carbon']::parse($typeclient->{$nom})->format($infos['format']) }}
                            
                            @elseif (isset($infos['nomfilmDemande']))

                                    {{ $typeclient->getNomFilm() }}

                            @elseif (isset($infos['nombrefilmDemande']))

                                    {{ $typeclient->getNombreDemande($idCinema) }}

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
                            <button class="btn btn-secondary" type="button" data-bs-toggle="modal" data-bs-dimiss="modal" data-bs-target="#modal{{$livewireObject}}{{$typeclient->id}}" >
                                Modifier
                            </button>
                            @if ($canCreateDelete == true)
                                <button class="btn btn-secondary ms-3" wire:click="delete({{$typeclient->id}})" type="button">
                                    Supprimer
                                </button>
                            @endif
                            <x-popup.index :elementUpdate="$typeclient->id" :livewireObject="$livewireObject" :idCinema="$idCinema" :option="$option"/>
                        @endisset
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @isset($importOtherPopUp)
        @foreach ($importOtherPopUp as $importPopUp)
            <x-popup.index elementUpdate="0" :livewireObject="$importPopUp['name']" :idCinema="$idCinema" option=""/>
            @foreach ($importPopUp['ids'] as $element)
                <x-popup.index :elementUpdate="$element" :livewireObject="$importPopUp['name']" :idCinema="$idCinema" option="" isUpdated="true"/>
            @endforeach
        @endforeach
    @endisset
</div>