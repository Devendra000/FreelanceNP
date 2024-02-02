
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    @forelse($tasks as $task)
        <div class="post-container">
            
            <h2 class="post-title">{{$task->name}} 
                @if($task->urgency == 1)
                    <span class="post-urgent">Urgent</span>
                @else
                    <span class="post-notUrgent">Not Urgent</span>
                @endif
            </h2>
          

            <div class="post-details">
                <div class="post-details-item">
                <span class="post-details-label">Giver:</span>
                <span class="post-details-value">{{App\Models\giver::find($task->giver_id)->name}}</span>
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
            <div class="post-skills-label">Skills required:</div>
            <ul class="post-skills-list">
              <li class="post-skill">HTML</li>
              <li class="post-skill">CSS</li>
              <li class="post-skill">JavaScript</li>
            </ul>
          </div>

          <div class="apply">
            <a id='apply-btn' href="{{route('apply',['task_id'=>$task->task_id])}}">Apply</a>
          </div>
        </div>
      @empty
        <div class="post-container">
          <h2 class="post-title" style='color:#900000'>No new projects available right now</h2>
        </div>
      @endforelse