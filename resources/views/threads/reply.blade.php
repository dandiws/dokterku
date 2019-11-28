
            <div class="card mt-2">
                <div class="card-header">
                    <a href="#">
                      @php
                          $user = $reply->owner;
                          $detail = $user->doctorDetails()
                      @endphp
                      {{ $detail->title_start ?? null }} {{ $user->name }} {{ $detail->title_end ?? null}}
                    </a> reply {{ $reply ->created_at->diffForHumans() }} ...
                </div>
                    <div class="card-body">
                      {{ $reply->description }}
                    </div>
            </div>