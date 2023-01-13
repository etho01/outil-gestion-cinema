<div>
    <table class="table">
        <thead>
            <tr>
                @foreach($infostable as $infos)
                    <td>
                        {{ $infos }}
                    </td>
                @endforeach
                <td class="w-auto d-flex flex-row justify-content-end">
                    <a class="btn btn-secondary" href="type-client/new">
                        Crée un nouvel element
                    </a>
                </td>
            </tr>
        </thead>
        <tbody>
            @foreach ($typesclient as $typeclient)
                <tr>
                    @foreach($infostable as $nom => $infos)
                        <td>
                            {{ $typeclient->{$nom} }}
                        </td>
                    @endforeach
                    <td class="w-auto d-flex flex-row justify-content-end">
                        <a class="btn btn-secondary" href="type-client/{{ $typeclient->slug }}">
                            Crée un nouvel element
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>