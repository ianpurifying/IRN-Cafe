<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="editFeedbackMessage" class="alert d-none" role="alert"></div>
                <form id="editUserForm" novalidate>
                    <input type="hidden" id="editUserId" name="id">
                    <div class="mb-3">
                        <label for="editFirstName" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="editFirstName" name="first_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="editLastName" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="editLastName" name="last_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="editUsername" class="form-label">Username</label>
                        <input type="text" class="form-control" id="editUsername" name="username" required minlength="3" maxlength="15">
                        <div class="invalid-feedback">Invalid username: must be 3-15 characters and unique.</div>
                    </div>
                    <div class="mb-3">
                        <label for="editEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="editEmail" name="email" required>
                        <div class="invalid-feedback">Invalid email: must be a valid format and unique.</div>
                    </div>
                    <div class="mb-3">
                        <label for="editPassword" class="form-label">Password</label>
                        <input type="password" class="form-control" id="editPassword" name="password" required minlength="8" maxlength="49">
                        <div class="invalid-feedback">Password must be 8-49 characters long, include uppercase, lowercase, numbers, and special characters.</div>
                    </div>
                    <div class="mb-3">
                        <label for="editConfirmPassword" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="editConfirmPassword" name="confirm_password" required>
                        <div class="invalid-feedback">Passwords do not match.</div>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>