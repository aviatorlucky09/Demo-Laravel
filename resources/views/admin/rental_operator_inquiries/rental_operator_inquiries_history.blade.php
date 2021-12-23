@php
  $historyArr = $obj->action_history_array;
@endphp
<ul class="media-list media-list-with-divider media-messaging">
  @foreach($historyArr as $history )
  <li class="media media-sm">
    <div class="media-body">
      <div>
			<h5 class="media-heading pull-left">
        By: {{ $history['by'] }} , Status: {{ isset($history['status'])?$history['status']:"" }}
      </h5>
      <small class="pull-right"> Date : {{ dateToStringTime($history['date']) }}</small>
      </div>
      <div style="clear: both"></div>
			  <p>
          {{ $history['note'] }}
        </p>
      </div>
		</li>
    @endforeach
</ul>