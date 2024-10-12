@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
    @if (trim($slot) === 'Jisa Adventure')
    <img src="{{asset('img/brand/logo.png')}}"  class="logo" alt="Jisa Adventure Logo">
    @else
    {{ $slot }}
    @endif
</a>
</td>
</tr>
