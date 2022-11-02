<x-mail::message>
# {{ $tarefa }}

Data limite de conclusão: {{ $data_limite_conclusao }}

<x-mail::button :url="$url">
Mostrar tarefa
</x-mail::button>

Atenciosamente,<br>
Equipe - {{ config('app.name') }}
</x-mail::message>
