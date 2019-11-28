
            <div class="card">
                <div class="card-header">
                    <a href="#">
                      {{ $reply->owner->name }}
                    </a> reply {{ $reply ->created_at->diffForHumans() }} ...
                </div>
                    <div class="card-body">
                      {{ $reply->description }}
                    </div>
            </div>