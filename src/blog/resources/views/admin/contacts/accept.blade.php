<td class="testRomeve{{ $id }}">
    @if($status == config('define.active'))
        <span class="badge badge-success">Accept</span>
    @else
        <span class="badge badge-warning">Non Accept</span>
    @endif
</td>   
<td class="style-td testRomeve{{ $id }}">
    @if($status == config('define.active'))
        <a href="#" class="text-success mr-2">
            <i class="fas fa-unlock-alt" onClick="return ajaxActiveStatus({{ $id }}, 0, '{{ route("contacts.accept") }}')"></i>
        </a>
    @else
        <a href="#" class="text-danger mr-2">
            <i class="nav-icon i-Close-Window font-weight-bold" onClick="return ajaxActiveStatus({{ $id }}, 1, '{{ route("contacts.accept") }}')"></i>
        </a>
    @endif
</td>
