@include('givers/giversLayout/header')

<title>Completed Projects</title>
<link rel="stylesheet" href="{{asset('css/receiverPost.css')}}">
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

    @include('givers/giversLayout/post')
</main>

