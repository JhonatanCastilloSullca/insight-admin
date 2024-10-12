@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
    @if (trim($slot) === 'Cuzco Travel')
    <img src="{{asset('img/brand/logo.png')}}"  class="logo" alt="Cuzco Travel Logo">
    @else
    {{ $slot }}
    @endif
</a>
</td>
</tr>
