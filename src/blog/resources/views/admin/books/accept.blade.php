<td class="testRomeve{{ $id }}">
    @if($status == config('define.active'))
        <span class="badge badge-warning">Not Accept</span>
    @else
        <span class="badge badge-success">Accept</span>
    @endif
</td>
<td class="style-td testRomeve{{ $id }}"">
    <a class="text-infor mr-1">
        @if($status == config('define.active'))
            <i class="fas fa-user-lock" onClick="return ajaxActiveStatus({{ $id }}, 0, '{{ route("books.accept") }}')"></i>
        @else
            <i class="fas fa-unlock-alt" onClick="return ajaxActiveStatus({{ $id }}, 1, '{{ route("books.accept") }}')"></i>
        @endif
    </a>
    <a href="#" class="text-info mr-1">
        <i class="fas fa-eye"></i>
    </a>
    <a href="{{ route("users.edit", $id) }}" class="text-success mr-1">
        <i class="nav-icon i-Pen-2 font-weight-bold"></i>
    </a>
    <a href="#" class="text-danger mr-1">
        <i class="nav-icon i-Close-Window font-weight-bold"></i>
    </a>
</td>
