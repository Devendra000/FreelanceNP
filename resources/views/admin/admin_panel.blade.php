    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        @include('layout/logo')

        <style>
            body, h1, h2, p, ul, li {
                margin: 0;
                padding: 0;
            }

            body {
                font-family: 'Arial', sans-serif;
                background-color: #f4f4f4;
            }

            .table-container {
                position: absolute;
                top: 15%;
                left: 25%;
            }

            .admin-table {
                border-collapse: collapse;
                width: 100%;
                margin-top: 20px;
                background-color: #fff;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }

            .admin-table th, .admin-table td {
                border: 1px solid #ddd;
                padding: 12px;
                text-align: center;
            }

            .admin-table th {
                background-color: #f2f2f2;
            }

            .admin-table tr:hover {
                background-color: #f5f5f5;
            }

            .edit-button, .trash-button {
                padding: 8px 12px;
                margin-right: 5px;
                cursor: pointer;
                background-color: #4caf50;
                color: #fff;
                border: none;
                border-radius: 3px;
            }

            .trash-button {
                background-color: #e74c3c;
            }

            /* Style for More Information link */
            .more-info-link {
                text-decoration: none;
                color: #3498db;
            }

        </style>
    </head>
    <body>
        <div class="table-container">       
            <div class="d-felx justify-content-center">
                <table class="admin-table">
                    <thead>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Type</th>
                        <th>Action</th>
                        <th>Status</th>
                        <th>More Information</th>
                    </thead>

                    