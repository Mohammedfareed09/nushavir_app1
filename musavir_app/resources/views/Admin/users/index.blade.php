<x-admin-layout>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Manage Employees</title>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link href="{{ asset('assets/auth/plugins/custom/tables/table.css') }}" rel="stylesheet" type="text/css" />

        <!-- Custom CSS for spacing -->
        <style>
            .name-column {
                width: 200px; /* Adjust based on your needs */
            }
            .email-column {
                margin-left: 50px; /* Creates space between Name and Email columns */
            }
            .action-buttons {
                display: flex;
                align-items: center;
                justify-content: end;
                gap: 30px; /* Adjust the gap between buttons as needed */
            }
        </style>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="{{ asset('assets/auth/plugins/custom/tables/table.js') }}"></script>
    </head>

    <body>
        <div class="container py-5">
            <div class="table-responsive">
                <div class="table-wrapper">
                    <div class="table-title">
                        <div class="row">
                            <div class="col-xs-6">
                                <h2>Manage <b>Employees</b></h2>
                            </div>
                            <div class="col-xs-6 text-right">
                                <a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal">
                                    <i class="material-icons">&#xE147;</i>
                                    <span>Add New Employee</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th class="name-column">Name</th> <!-- Added class for styling -->
                                <th class="email-column">Email</th> <!-- Added class for styling -->
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td class="pr-3 pl-3">{{ $user->full_name }}</td>

                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <div class="action-buttons"> <!-- Flex container for buttons -->
                                            <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-info btn-sm">
                                                Roles
                                            </a>
                                            <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-primary btn-sm">Edit</a> <!-- Edit button -->
                                            <form method="POST" action="{{ route('admin.users.destroy', $user->id) }}" onsubmit="return confirm('Are you sure?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Add Employee Modal -->
        <div id="addEmployeeModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="POST" action="{{ route('myregister') }}">
                        @csrf
                        <div class="modal-header">
                            <h4 class="modal-title">Add Employee</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="tc">TC</label>
                                <input type="text" name="tc" id="tc" value="{{ old('tc') }}" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="text" name="phone" id="phone" value="{{ old('phone') }}" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" value="{{ old('email') }}" class="form-control" required>
                            </div>
                            <div class="fv-row mb-8">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password" class="form-control" required>
                            </div>
                            <div class="fv-row mb-8">
                                <label for="password_confirmation">Confirm Password</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-success">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </body>
</x-admin-layout>
