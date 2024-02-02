@include('receivers/receiversLayout/header')
<title>Receiver Projects</title>
@include('layout/message')

<style>
    table {
    width: 100%;
    margin-top: 20px;
}

thead{
    position:sticky;
    top:6.5%;
}

thead th, tbody td {
    top:0;
    border: 1px solid #ddd;
    padding: 10px;
    text-align: center;
}

thead th {
    background-color: #f2f2f2;
}

tbody tr:nth-child(even) {
    background-color: #f9f9f8;
}

tbody tr:nth-child(odd) {
    background-color: #d9d9d9;
}

td[colspan='8'] {
    text-align: center;
    padding: 10px;
}

/* Add spacing between table cells */
table td, table th {
    padding: 10px;
}

/* Style the "No task" message */
td[colspan='8'] {
    text-align: center;
    padding: 10px;
    color: #555; /* Adjust the color as needed */
}

.paid{
    background: #09dd09;
    color:black;
}

.unpaid{
    color:white;
    background: #dd0909;
}

/* Responsive styling for small screens */
@media (max-width: 600px) {
    table {
        border: 1px solid #ddd;
    }

    table, thead, tbody, th, td, tr {
        display: block;
    }

    thead {
        display: none;
    }

    tr {
        margin-bottom: 10px;
        border: 1px solid #ddd;
    }

    td {
        border: none;
        position: relative;
        padding-left: 50%;
    }

    td:before {
        position: absolute;
        left: 6px;
        content: attr(data-label);
        font-weight: bold;
    }

    .jobs-container {
        box-sizing:border-box;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        width:19%;
        margin:3px 0 0 3px;
        padding:2px;
        height:auto;
        background:#581111;
        border-radius: 8px;
    }

    .job-count {
        text-align: center;
    }

    .count-number {
        font-size: 20px;
        font-weight: bold;
        color: #0077b5; /* LinkedIn Blue color */
    }

    .count-label {
        display:inline-flex;
        font-size: 12px;
        color: #333;
    }
}
</style>
@include('layout/message')

<div class="jobs-container">
        <div class="job-count">
            <span class="count-number">@if($tasks)
                            {{$tasks->count()}} Jobs Available
                        @else
                    0 Jobs Available
                @endif</span>
            
        </div>
    </div>

<main>
    <table>
        <thead>
            <th>Name</th>
            <th>Status</th>
            <th>Giver</th>
            <th>Deadline</th>
            <th>Urgency</th>
            <th>Description</th>
            <th>Paid state</th>
            <th>Created at</th>
            <th>Completed at</th>
        </thead>
        <tbody>
            @forelse($tasks as $task)
            <tr>
                <td>{{$task->name}}</td>
                
                @if($task->state == 1)
                    <td>On Progress</td>
                @elseif($task->state == 2)
                    <td>Completed</td>
                @else
                    <td>Unaccepted</td>
                @endif

                @if($task->giver_id)
                    <td>{{App\Models\giver::find($task->giver_id)->name}}</td>
                @else
                    <td>-</td>
                @endif

                <td>{{$task->deadline}}</td>
                
                @if($task->urgency == 1)
                    <td>Urgent</td>
                @else
                    <td>Not Urgent</td>
                @endif

                <td>{{$task->description}}</td>
                
                @if($task->pidx !== null)
                    <td class='paid'>NRs.{{$task->pod}}({{$task->pidx}})</td>
                @else
                    <td class='unpaid'>NRs.{{$task->pod}}</td>
                @endif

                <td>{{$task->created_at}}</td>
                
                @if($task->completed_at === null)
                    <td><a href="{{route('projectComplete',['id'=>$task->task_id])}}">Mark Complete</a></td>
                @else
                    <td>{{$task->completed_at}}</td>
                @endif
                
            </tr>
            @empty
                <td colspan='9'>No projects to show</td>
            @endforelse
        </tbody>
    </table>
</main>