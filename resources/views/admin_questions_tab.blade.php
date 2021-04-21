    @foreach ($questions as $question)

<tr>
    <td>{{ $question->user->firstname }}</td>
    <td>{{ $question->user->name }}</td>
    <td>{{ $question->question }}</td>
    <td>{{ $question->created_at->format('H:i:s') }}</td>
    <td style="display:flex"><a style="color:black" title="Voir le profil" href="{{ route('users.show', $question->user->id) }}"><i class="fa fa-user" aria-hidden="true"></i></a>
        <form action=" {{ route('users.destroy', $question->user->id) }}" method="POST">
        @method('DELETE')
        @csrf
    	    <button style="color:red; border:none" type="submit" title="Bannir" class="btn-ban"><i class="fa fa-ban" aria-hidden="true"></i></button>
        </form>
     </td>
</tr>
    @endforeach