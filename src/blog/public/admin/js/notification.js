var pusher = new Pusher('6d6b144490a6d19374c4', {
    cluster: 'ap1',
    forceTLS: true
});

Pusher.logToConsole = true;

var channel = pusher.subscribe('commented');
channel.bind('examplee', function(data) {
var count = parseInt($('#dropdownNotification span').text());
$('#dropdownNotification span').text(count+1);
var htmlRespon = `<div class="dropdown-item d-flex">
              <div class="notification-icon">
                  <i class="i-Speach-Bubble-6 text-primary mr-1"></i>
              </div>
              <div class="notification-details flex-grow-1">
                  <a href="http://127.0.0.1:8000/adminpanel/notification">
                      <p class="m-0 d-flex align-items-center">
                          <span>New comment</span>
                          <span class="badge badge-pill badge-primary ml-1 mr-1">new</span>
                          <span class="flex-grow-1"></span>
                          <span class="text-small text-muted ml-auto">`+data.data.created_at+`</span>
                      </p>
                      <p class="text-small text-muted m-0 d-inline-block text-truncate" style="max-width: 250px;">`+data.data.user_name+` :`+data.data.comment+`</p>
                  </a>
              </div>
          </div`;
    $(htmlRespon).prependTo('.notification-dropdown');
});
