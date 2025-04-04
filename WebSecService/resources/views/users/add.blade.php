<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2 class="mb-4">Add New User</h2>
    
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form method="POST" action="{{ route('user_store') }}">
        @csrf
        
        <!-- Name Field -->
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" required value="{{ old('name') }}">
        </div>

        <!-- Email Field -->
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required value="{{ old('email') }}">
        </div>

        <!-- Password Field -->
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required>
        </div>

        <!-- Password Confirmation Field -->
        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm password" required>
        </div>

        @can('admin_users')
        <!-- Roles Field -->
        <div class="mb-3">
            <label for="roles" class="form-label">Roles</label>
            <select multiple class="form-select" id="roles" name="roles[]">
                @foreach($roles as $role)
                <option value="{{ $role->name }}" {{ $role->taken ? 'selected' : '' }}>
                    {{ $role->name }}
                </option>
                @endforeach
            </select>
        </div>

        <!-- Permissions Field -->
        <div class="mb-3">
            <label for="permissions" class="form-label">Direct Permissions</label>
            <select multiple class="form-select" id="permissions" name="permissions[]">
                @foreach($permissions as $permission)
                <option value="{{ $permission->name }}" {{ $permission->taken ? 'selected' : '' }}>
                    {{ $permission->display_name }}
                </option>
                @endforeach
            </select>
        </div>
        @endcan

        <!-- Submit Button -->
        <div class="text-center">
            <button type="submit" class="btn btn-primary">Create User</button>
            <a href="{{ route('users') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
