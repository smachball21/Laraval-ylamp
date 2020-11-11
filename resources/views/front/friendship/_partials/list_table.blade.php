<thead>
	<tr>
		<th>{{ __('Name') }}</th>
		<th class="td-xs text-right">{{ __('Actions') }}</th>
	</tr>
</thead>
<tbody>
	@foreach ($users as $user)
		<tr>
            @if (Auth::User()->id !== $user->id)
                <td>
                    {{ !empty($user->getFullName()) ? $user->getFullName() : '-' }}
                </td>
                <td class="text-right text-nowrap">
                    {{-- Envoyer une demande d'ami --}}
                    <a class="btn-light btn-sm" data-toggle="tooltip" href="{{ route('friendship.add', ['user' => $user]) }}" title="{{ __("Envoyer une demande d'ami") }}">
                        <small>{{ __("Envoyer une demande d'ami") }}</small>
                    </a>
                </td>
            @endif
		</tr>
	@endforeach
</tbody>
