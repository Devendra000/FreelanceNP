@include('givers/giversLayout/header')
<title>Uploaded projects</title>
<style>
    table {
    width: 100%;
    margin-top: 20px;
}

thead th, tbody td {
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

/* Responsive styling for small screens */
@media (max-width: 600px) {
    table {
        border: 1px solid #ddd;
    }

    table, thead, tbody, th, td, tr {
        display: block;
        word-wrap: break-word;
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
}

</style>
@include('layout/message')

<main>
    <table>
        <thead>
            <th>Name</th>
            <th>Status</th>
            <th>Worker</th>
            <th>Appliers</th>
            <th>Deadline</th>
            <th>Urgency</th>
            <th>Price</th>
            <th>Details</th>
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

                @if($task->receiver_id)
                    <td>{{App\Models\receiver::find($task->receiver_id)->name}}</td>
                @else
                    <td>-</td>
                @endif

                @if($task->appliers)
                        <td>@foreach($task->appliers as $applier)
                            {{App\Models\receiver::find($applier)->name}}<a href="{{route('acceptApplier',['applier_id'=>$applier, 'task_id'=>$task->task_id])}}">Accept</a><br>
                    @endforeach</td>
                @else
                    <td>-</td>
                @endif

                <td>{{$task->deadline}}</td>
                
                @if($task->urgency == 1)
                    <td>Urgent</td>
                @else
                    <td>Not Urgent</td>
                @endif

                <td>{{$task->pod}}</td>
                
                <td><a href="">Details</a></td>
                
            </tr>
            @empty
                <td colspan='9'>No task to show</td>
            @endforelse
        </tbody>
    </table>
</main>