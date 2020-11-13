<thead>
<tr>
    <th>{{ __('Name') }}</th>
    <th class="td-xs text-right">{{ __('Actions') }}</th>
</tr>
</thead>
<tbody>
@if ($friends->count() > 0)
    @foreach ($friends as $friendship)
        <tr>
            @if($friendship->target_id === $currentuser->id)
                <td>
                    {{$friendship->sender->getAdministrativeFullName()}}
                </td>
                <td class="text-center text-nowrap">
                    {{--    Accepter la demande d'ami    --}}
                    <a class="btn-success btn-sm" data-toggle="tooltip"
                       href="{{ route('friendship.accept', ['user' => $friendship]) }}"
                       title="{{ __("Accepter") }}">
                        <small>{{ __("Accepter") }}</small>
                    </a>

                    {{--    Refuser la demande d'ami    --}}
                    <a class="btn-danger btn-sm" data-toggle="tooltip"
                       href="{{ route('friendship.reject', ['user' => $friendship]) }}"
                       title="{{ __("Refuser") }}">
                        <small>{{ __("Refuser") }}</small>
                    </a>
                </td>
            @endif
            @if($friendship->sender_id === $currentuser->id)
                <td>
                    {{$friendship->target->getAdministrativeFullName()}}
                </td>
                <td class="text-center text-nowrap">
                    {{--    Annuler la demande d'ami    --}}
                    <a class="btn-danger btn-sm" data-toggle="tooltip"
                       href="{{ route('friendship.delete', ['user' => $friendship]) }}"
                       title="{{ __("Annuler la demande") }}">
                        <small>{{ __("Annuler la demande") }}</small>
                    </a>
                </td>
            @endif
        </tr>
    @endforeach
@else
    <tr>
        <td>
            Vous n'avez pas de demande actuellement
        </td>
        <td>

        </td>
    </tr>
@endif
</tbody>
