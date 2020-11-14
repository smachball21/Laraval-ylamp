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
           {{$friendship->getAdministrativeFullName()}}
        </td>

        <td class="text-right text-nowrap">
            <a class="btn-danger btn-sm" data-toggle="tooltip" href="{{ route('friendship.delete', ['user' => $friendship]) }}" title="{{ __("Supprimer cet ami") }}">
                <small>{{ __("Supprimer cet ami") }}</small>
            </a>
        </td>
    </tr>
@endforeach
</tbody>
