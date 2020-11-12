<thead>
<tr>
    <th>{{ __('Name') }}</th>
    <th class="td-xs text-right">{{ __('Actions') }}</th>
</tr>
</thead>
<tbody>
{{dd($friends->sender()->username)}}
@foreach ($friends as $user)
    <tr>
        <td>

        </td>

        <td class="text-right text-nowrap">
            {{-- Envoyer une demande d'ami --}}
            <a class="btn-light btn-sm" data-toggle="tooltip" href="{{ route('friendship.add', ['user' => $user]) }}" title="{{ __("Envoyer une demande d'ami") }}">
                <small>{{ __("Envoyer une demande d'ami") }}</small>
            </a>
        </td>
    </tr>
@endforeach
</tbody>
