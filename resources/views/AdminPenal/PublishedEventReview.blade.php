
@include('Include.header')

<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
    <!-- Navbar -->
    @include('Include.head')
    <!-- End Navbar -->
    <style>
    /* General Table Styling */
    table {
        width: 100%;
        border-collapse: collapse;
        margin: 20px 0;
        font-size: 16px;
        font-family: Arial, sans-serif;
        background-color: #ffffff;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    th,
    td {
        padding: 14px 20px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    /* Header Styling */
    th {
        background-color: #4CAF50;
        color: white;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-weight: bold;
    }

    /* Row Styling */
    tr:nth-child(even) {
        background-color: #f9f9f9;
    }



    /* Responsive Table */
    @media (max-width: 768px) {
        table {
            font-size: 14px;
        }

        th,
        td {
            padding: 10px;
        }
    }
</style>


    <div class="container-fluid py-2">
        <div class="card">
            <div class="card-body">
                <div class="container mt-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="fw-bold py-3 mb-0 pull-left">Events Types</h4>
                        <a href="{{route('admin.createEventType')}}"><button type="button" class="btn btn-primary">Add Event Type</button></a>
                    </div>

                    <!-- Success Message -->
                    @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif

                    <!-- Error Message -->
                    @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                    @endif

                    <!-- Event Types Table -->
                    <table>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Event Name</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>