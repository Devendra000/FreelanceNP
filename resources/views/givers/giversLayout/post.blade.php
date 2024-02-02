@forelse($tasks as $task)
        <div class="post-container">
            
            <h2 class="post-title">{{$task->name}} 
                @if($task->paid == 0)
                    <span class="post-urgent">Unpaid</span>
                @else
                    <span class="post-notUrgent">Paid</span>
                @endif
            </h2>
          

            <div class="post-details">
                <div class="post-details-item">
                <span class="post-details-label">Receiver:</span>
                <span class="post-details-value">{{App\Models\receiver::find($task->receiver_id)->name}}</span>
                </div>
                <div class="post-details-item">
                <span class="post-details-label">Deadline:</span>
                <span class="post-details-value">{{$task->deadline}}</span>
                </div>
                <div class="post-details-item">
                <span class="post-details-label">Cost:</span>
                <span class="post-details-value">NRs.{{$task->pod}}</span>
                </div>
            </div>

            <div class="post-skills">
                <div class="post-skills-label">Description:</div>
                <p class="post-desc">{{$task->description}}</p>
            </div>

            <div class="post-skills">
                <div class="post-skills-label">Completed at:</div>
                <p class="post-desc">
                    @if($task->completed_at)
                        {{$task->completed_at}}
                    @else
                        -
                    @endif
                </p>
            </div>

            @if($task->paid == 0)
            <div class="pay">
                <a id='pay-btn' target='_blanc' href="{{route('pay',['id'=>$task->task_id, 'user_id' => Auth::guard('givers')->user()->giver_id])}}">Pay</a>
            </div>
            @else
            <div class="apply">
                <a id='apply-btn'>Paid</a>
            </div>
            @endif
        </div>
      @empty
        <div class="post-container">
          <h2 class="post-title" style='color:#900000'>No Completed Projects</h2>
        </div>
      @endforelse