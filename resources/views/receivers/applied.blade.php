@include('receivers/receiversLayout/header')
<title>Applied Projects</title>
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

/* Style the "No appliedTask" message */
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
        overflow:hidden;
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
            <th>Giver</th>
            <th>Deadline</th>
            <th>Urgency</th>
            <th>Description</th>
            <th>Price</th>
            <th>Completed at</th>
        </thead>
        <tbody>
            @forelse($appliedTasks as $appliedTask)
            <tr>
                <td>{{$appliedTask->name}}</td>
                
                @if($appliedTask->state === 1)
                    <td>On Progress</td>
                @elseif($appliedTask->state === 2)
                    <td>Completed</td>
                @else
                    <td>Unaccepted</td>
                @endif

                <td>{{App\Models\giver::find($appliedTask->giver_id)->name}}</td>

                <td>{{$appliedTask->deadline}}</td>
                
                @if($appliedTask->urgency === 1)
                    <td>Urgent</td>
                @else
                    <td>Not Urgent</td>
                @endif

                <td>{{$appliedTask->description}}</td>
                <td>{{$appliedTask->pod}}</td>

                @if($appliedTask->completed_at)
                    <td>{{$appliedTask->completed_at}}</td>
                @else
                    <td>-</td>
                @endif

            </tr>
            @empty
                <td colspan='9'>No applied projects to show</td>
            @endforelse
        </tbody>
    </table>
</main>