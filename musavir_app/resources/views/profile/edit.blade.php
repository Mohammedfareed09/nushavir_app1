{{-- <!-- resources/views/layouts/user/profile/edit.blade.php -->

<x-admin-layout>
    <div class="container py-5">
        <h2>Edit User</h2>
        <form action="{{ route('admin.users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="full_name">Full Name</label>
                <input type="text" name="full_name" id="full_name" value="{{ old('full_name', $user->full_name) }}" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" name="phone" id="phone" value="{{ old('phone', $user->phone) }}" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="tc">TC</label>
                <input type="text" name="tc" id="tc" value="{{ old('tc', $user->tc) }}" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control">
                <small>Leave blank if you don't want to change the password</small>
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
            </div>

            <div class="form-group">
                <label for="avatar_path">Avatar</label>
                @if ($user->avatar_path)
                    <img src="{{ Storage::url($user->avatar_path) }}" alt="Avatar" style="width: 100px;">
                    <input type="checkbox" name="remove_avatar" value="1"> Remove avatar
                @endif
                <input type="file" name="avatar_path" id="avatar_path" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">Update</button>

            <td>
                <div class="action-buttons"> <!-- Flex container for buttons -->
                    <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-info btn-sm">Roles</a>
                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-primary btn-sm">Edit</a> <!-- Edit button -->
                    <form method="POST" action="{{ route('admin.users.destroy', $user->id) }}" onsubmit="return confirm('Are you sure?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </div>
            </td>

        </form>
    </div>
</x-admin-layout> --}}
