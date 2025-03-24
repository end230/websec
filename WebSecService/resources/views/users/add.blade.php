<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <form>
        <!-- Name Field -->
        <div class="mb-3 row">
            <label for="name" class="col-sm-2 col-form-label">Name</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="name" placeholder="Enter name">
            </div>
        </div>

        <!-- Roles Field -->
        <div class="mb-3 row">
            <label for="roles" class="col-sm-2 col-form-label">Roles</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="roles" placeholder="Enter role">
            </div>
        </div>

        <!-- Direct Permissions Field -->
        <div class="mb-3 row">
            <label for="permissions" class="col-sm-2 col-form-label">Direct Permissions</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="permissions" placeholder="Enter permissions">
            </div>
        </div>

        <!-- Title Field -->
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" class="form-control" id="title" placeholder="Enter title" required>
        </div>

        <!-- Submit Button -->
        <div class="text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
