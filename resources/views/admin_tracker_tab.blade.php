@foreach ($sessions as $session)
{{--{{dd($session)}}--}}
<tr>
    <td class="log">
        {{--{{dd($log)}}--}}
        @if ($session['payload'])
        <i style="color:green" title="En ligne" class="fas fa-user-alt"></i>
        @else
        <i style="color:red" title="Hors ligne" class="fas fa-user-alt-slash"></i>
        @endif
    </td>
    <td>{{ $session->user->firstname }}</td>
    <td>{{ $session->user->name }}</td>
    <td>{{ $session['browserName'] }}</td>
    <td>@if ($session['isWindows'])
        <i title=" Windows" class="fab fa-windows"></i>
        @elseif ($session['isLinux'])
        <i title="Linux" class="fab fa-linux"></i>
        @else
        <i title="Apple" class="fab fa-apple"></i>
        @endif
    </td>
    <td>@if ($session['isMobile'])
        <i title="Téléphone" class="fas fa-mobile-alt"></i>
        @elseif ($session['isTablet'])
        <i title="Tablette" class="fas fa-tablet-alt"></i>
        @else
        <i title="Ordinateur" class="fas fa-desktop"></i>
        @endif
    </td>
    <td>{{ $session['last_activity'] }}</td>
</tr>

@endforeach