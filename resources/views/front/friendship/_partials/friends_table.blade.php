<thead>
<tr>
    <th>{{ __('Name') }}</th>
    <th class="td-xs text-right">{{ __('Actions') }}</th>
</tr>
</thead>
<tbody>
@foreach ($friends as $friendship)
    <tr>
        <td>
            @if($friendship->target_id === $currentuser->id)
                {{$friendship->sender->getAdministrativeFullName()}}
            @endif
            @if($friendship->sender_id === $currentuser->id)
                    {{$friendship->target->getAdministrativeFullName()}}
            @endif
        </td>

        <td class="text-right text-nowrap">
            <a class="btn-danger btn-sm" data-toggle="tooltip" href="{{ route('friendship.delete', ['user' => $friendship]) }}" title="{{ __("Envoyer une demande d'ami") }}">
                <small>{{ __("Supprimer cet ami") }}</small>
            </a>
        </td>
    </tr>
@endforeach
</tbody>
