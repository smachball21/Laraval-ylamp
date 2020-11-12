<thead>
<tr>
    <th>{{ __('Name') }}</th>
    <th class="td-xs text-right">{{ __('Actions') }}</th>
</tr>
</thead>
<tbody>
@foreach ($friends as $friendship)
    <tr>
        @if ($friendship->id !== $currentuser->id)
            <td>
                {{$friendship->getAdministrativeFullName()}}
            </td>

            <td class="text-right text-nowrap">
                <a class="btn-light btn-sm" data-toggle="tooltip"
                   href="{{ route('friendship.add', ['user' => $friendship]) }}"
                   title="{{ __("Envoyer une demande d'ami") }}">
                    <small>{{ __("Envoyer une demande d'ami") }}</small>
                </a>
            </td>
        @endif
    </tr>
@endforeach
</tbody>
