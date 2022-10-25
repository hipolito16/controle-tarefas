@props(['url'])
<tr>
    <td class="header">
        <a href="{{ $url }}" style="display: inline-block;">
            @if(trim($slot) === 'Controle de Tarefas')
                <img src="https://w7.pngwing.com/pngs/893/48/png-transparent-task-project-management-computer-icons-service-others-miscellaneous-text-logo.png" class="logo" alt="Controle de Tarefas Logo">
            @else
                {{ $slot }}
            @endif
        </a>
    </td>
</tr>
