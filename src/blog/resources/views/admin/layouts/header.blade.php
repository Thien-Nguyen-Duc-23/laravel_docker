<div class="logo">
    <img src="{{ asset('admin/images/avatars/logo.png') }}" alt="">
</div>
<div class="menu-toggle">
    <div></div>
    <div></div>
    <div></div>
</div>
<div style="margin: auto">
</div>
<div class="header-part-right">
    <!-- Full screen toggle -->
    <i class="i-Full-Screen header-icon d-none d-sm-inline-block" data-fullscreen></i>
    @php
        $user = App\Models\Account::find(Auth::guard('admin')->user()->userInformation->account->id);
    @endphp
    <!-- Notificaiton -->
    <div class="dropdown">
        <div class="badge-top-container" role="button" id="dropdownNotification" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="badge badge-primary">{{ $user->unreadNotifications->count() }}</span>
            <i class="i-Bell text-muted header-icon"></i>
        </div>
        <!-- Notification dropdown -->
        <div class="dropdown-menu dropdown-menu-right notification-dropdown" aria-labelledby="dropdownNotification" data-perfect-scrollbar data-suppress-scroll-x="true">

            @foreach ($user->unreadNotifications as $notification)
                <div class="dropdown-item d-flex">
                    <div class="notification-icon">
                        <i class="i-Speach-Bubble-6 text-primary mr-1"></i>
                    </div>
                    <div class="notification-details flex-grow-1">
                        <a href="{{ route('mark_a_read', $notification->id) }}">
                            <p class="m-0 d-flex align-items-center">
                                <span>New comment</span>
                                <span class="badge badge-pill badge-primary ml-1 mr-1">new</span>
                                <span class="flex-grow-1"></span>
                                <span class="text-small text-muted ml-auto">{{ diffNow($notification->created_at) }}</span>
                            </p>
                            <p class="text-small text-muted m-0 d-inline-block text-truncate" style="max-width: 250px;">{{ $notification->data['user_name'] }}: {{ $notification->data['comment'] }}</p>
                        </a>
                    </div>
                </div>
            @endforeach

            @if ($user->unreadNotifications->count() != 0)
                <div class="d-flex justify-content-center">
                    <a href="{{ route('mark_all_read', Auth::guard('admin')->user()->userInformation->account->id) }}" class="font-weight-bold text-muted m-2">Mark all as read</a>
                </div>
            @else
                <div class="d-flex justify-content-center">
                    <span class="font-weight-bold text-muted m-2">No notification</span>
                </div>
            @endif
        </div>

    </div>
    <!-- Notificaiton End -->
    <!-- User avatar dropdown -->
    <div class="dropdown">
        <div class="user col align-self-end">
            @php
                $image = \Storage::disk('public')->exists('/admin/accounts/'.Auth::guard('admin')->user()->userInformation->avatar) ? \Storage::url('admin/accounts/'.Auth::guard('admin')->user()->userInformation->avatar) : asset('admin/images/no-image.png');
            @endphp
            <img src="{{ $image }}" id="userDropdown" alt="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                <div class="dropdown-header">
                    <i class="i-Lock-User mr-1"></i> {{ Auth::guard('admin')->user()->userInformation->full_name }}
                </div>
                <a class="dropdown-item" href="{{ route('admin.profile_index') }}">Account settings</a>
                <a class="dropdown-item" href="{{ route('admin.logout') }}">Sign out</a>
            </div>
        </div>
    </div>
</div>
