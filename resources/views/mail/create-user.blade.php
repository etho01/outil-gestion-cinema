@extends('mail.mail')

@section('content')
Bonjour {{ $user->nom }}<br/><br>
Vous avez etait inviter a vous inscrire sur le site {{ config('APP_NAME', 'Laravel') }}. Veullez clicher
sur ce  <a href="{{ $url}}">lien</a> pour configurer ce mot de passe. <br><br>
cordialement <br><br>ce message est un mail automatique ne pas repondre a ce mail
@endsection
