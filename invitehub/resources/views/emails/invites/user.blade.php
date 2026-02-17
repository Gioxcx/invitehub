<x-mail::message>
# Você foi convidado para o Invite Hub

Você recebeu um convite para participar do Invite Hub. Para visualizar os detalhes do convite e aceitar, clique no botão abaixo.

<x-mail::button :url="$acceptUrl ?? config('app.url')">
Aceitar Convite
</x-mail::button>

Obrigado,<br>
{{ config('app.name') }}
</x-mail::message>
