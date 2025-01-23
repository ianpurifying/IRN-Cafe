<?php 
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // Check if the user is an admin (replace with your admin verification logic)
    if (!isset($_SESSION['user']) || $_SESSION['user']['username'] !== 'admin' || $_SESSION['user']['email'] !== 'admin@irncafe.com') {
        echo "<script>window.location.href = '../index.php?page=login';</script>";
        exit;
    }
?>

<div>
    <div class="d-flex flex-column align-items-center text-center">
        <h2 class="modal-title mb-3" id="registerModalLabel">User Registration</h2>
        <button class="btn btn-primary my-3" data-bs-toggle="modal" data-bs-target="#registerModal">Register</button>
    </div>

    <!-- Registration Modal -->
    <div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="registerModalLabel">Registration</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="feedbackMessage" class="alert d-none" role="alert"></div>
                        <form id="registrationForm" novalidate>
                            <div class="mb-3">
                                <label for="firstName" class="form-label">First Name</label>
                                <input type="text" class="form-control" id="firstName" name="first_name" required>
                            </div>
                            <div class="mb-3">
                                <label for="lastName" class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="lastName" name="last_name" required>
                            </div>
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username" required minlength="3" maxlength="15">
                                <div class="invalid-feedback">Invalid username: must be 3-15 characters and unique.</div>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                                <div class="invalid-feedback">Invalid email: must be a valid format and unique.</div>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required minlength="8" maxlength="49">
                                <div class="invalid-feedback">
                                    Password must be 8-49 characters long, include uppercase, lowercase, numbers, and special characters.
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="confirmPassword" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" id="confirmPassword" name="confirm_password" required>
                                <div class="invalid-feedback">Passwords do not match.</div>
                            </div>
                            <button type="submit" class="btn btn-primary">Register</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Users List -->
    <div id="usersList" class="mt-4">
        <h3>Registered Users</h3>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Password (Hashed)</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody id="usersTableBody">
                <!-- Dynamically loaded rows -->
            </tbody>
        </table>
    </div>
</div>


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

<script>
const validateEmail = (email) => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
const validatePasswordStrength = (password) => /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/.test(password);

const feedbackMessage = document.getElementById('feedbackMessage');
const form = document.getElementById('registrationForm');
const usernameField = document.getElementById('username');
const emailField = document.getElementById('email');
const passwordField = document.getElementById('password');
const confirmPasswordField = document.getElementById('confirmPassword');

const editFeedbackMessage = document.getElementById('editFeedbackMessage');
const editForm = document.getElementById('editUserForm');
const editUsernameField = document.getElementById('editUsername');
const editEmailField = document.getElementById('editEmail');
const editPasswordField = document.getElementById('editPassword');
const editConfirmPasswordField = document.getElementById('editConfirmPassword');

// Create User
form.addEventListener('submit', (e) => {
    e.preventDefault();
    if (form.checkValidity()) {
        const formData = new FormData(form);
        fetch('crud/users/create_users.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                displayFeedback(data.message, 'success');
                form.reset();
                setTimeout(() => bootstrap.Modal.getInstance(document.getElementById('registerModal')).hide(), 2000);
            } else {
                displayFeedback(data.message, 'danger');
            }
        })
        .catch(() => displayFeedback('An unexpected error occurred.', 'danger'));
    } else {
        form.classList.add('was-validated');
    }
});

// Fetch and Display User
const fetchUsers = () => {
    fetch('crud/users/read_users.php')
        .then(response => response.json())
        .then(users => {
            const usersTableBody = document.getElementById('usersTableBody');
            usersTableBody.innerHTML = ''; // Clear existing rows

            users.forEach(user => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${user.id}</td>
                    <td>${user.first_name}</td>
                    <td>${user.last_name}</td>
                    <td>${user.username}</td>
                    <td>${user.email}</td>
                    <td>${user.password}</td>
                    <td>${user.created_at}</td>
                    <td>
                        <button class="btn btn-danger" onclick="deleteUser(${user.id})">Delete</button>
                        <button class="btn btn-warning" onclick="editUser(${user.id})">Edit</button>
                    </td>
                `;
                usersTableBody.appendChild(row);
            });
        })
        .catch(error => console.error('Error fetching users:', error));
};
document.addEventListener('DOMContentLoaded', fetchUsers);

// Edit and Update user
const editUser = (userId) => {
    fetch(`crud/users/read_user.php?id=${userId}`)
        .then(response => response.json())
        .then(user => {
            document.getElementById('editUserId').value = user.id;
            document.getElementById('editFirstName').value = user.first_name;
            document.getElementById('editLastName').value = user.last_name;
            document.getElementById('editUsername').value = user.username;
            document.getElementById('editEmail').value = user.email;
            document.getElementById('editPassword').value = user.password;
            
            // Show the modal
            const modal = new bootstrap.Modal(document.getElementById('editModal'));
            modal.show();
        })
        .catch(error => console.error('Error fetching user data:', error));
};

editForm.addEventListener('submit', (e) => {
    e.preventDefault();
    if (editForm.checkValidity()) {
        const formData = new FormData(editForm);
        fetch('crud/users/update_users.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                displayEditFeedback(data.message, 'success');
                setTimeout(() => bootstrap.Modal.getInstance(document.getElementById('editModal')).hide(), 2000);
            } else {
                displayEditFeedback(data.message, 'danger');
            }
        })
        .catch(() => displayEditFeedback('An unexpected error occurred.', 'danger'));
    } else {
        editForm.classList.add('was-validated');
    }
});

// Delete user
const deleteUser = (userId) => {
    if (confirm("Are you sure you want to delete this user?")) {
        fetch(`crud/users/delete_users.php?id=${userId}`, {
            method: 'GET',
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert("User deleted successfully!");
                fetchUsers(); // Reload the users list
            } else {
                alert("Error deleting user.");
            }
        })
        .catch(() => alert('An unexpected error occurred.'));
    }
};
</script>


<script>
// Function to display feedback messages
const displayFeedback = (message, type) => {
        const feedbackMessage = document.getElementById('feedbackMessage');
        feedbackMessage.textContent = message;
        feedbackMessage.className = `alert alert-${type}`;
        feedbackMessage.classList.remove('d-none');
    };

usernameField.addEventListener('blur', () => {
    if (usernameField.value.length < 3 || usernameField.value.length > 15) {
        usernameField.setCustomValidity('Invalid');
        usernameField.classList.add('is-invalid');
    } else {
        fetch(`crud/users/read_users.php?username=${encodeURIComponent(usernameField.value)}`)
            .then(response => response.json())
            .then(data => {
                if (data.exists) {
                    usernameField.setCustomValidity('Username already taken.');
                    usernameField.classList.add('is-invalid');
                } else {
                    usernameField.setCustomValidity('');
                    usernameField.classList.remove('is-invalid');
                }
            });
    }
});

emailField.addEventListener('blur', () => {
    if (!validateEmail(emailField.value)) {
        emailField.setCustomValidity('Invalid email format.');
        emailField.classList.add('is-invalid');
    } else {
        fetch(`crud/users/read_users.php?email=${encodeURIComponent(emailField.value)}`)
            .then(response => response.json())
            .then(data => {
                if (data.exists) {
                    emailField.setCustomValidity('Email already taken.');
                    emailField.classList.add('is-invalid');
                } else {
                    emailField.setCustomValidity('');
                    emailField.classList.remove('is-invalid');
                }
            });
    }
});

passwordField.addEventListener('input', () => {
    if (!validatePasswordStrength(passwordField.value)) {
        passwordField.setCustomValidity('Weak password.');
        passwordField.classList.add('is-invalid');
    } else {
        passwordField.setCustomValidity('');
        passwordField.classList.remove('is-invalid');
    }
});

confirmPasswordField.addEventListener('input', () => {
    if (confirmPasswordField.value !== passwordField.value) {
        confirmPasswordField.setCustomValidity('Passwords do not match.');
        confirmPasswordField.classList.add('is-invalid');
    } else {
        confirmPasswordField.setCustomValidity('');
        confirmPasswordField.classList.remove('is-invalid');
    }
});

// Function to display feedback messages
const displayEditFeedback = (message, type) => {
    editFeedbackMessage.textContent = message;
    editFeedbackMessage.className = `alert alert-${type}`;
    editFeedbackMessage.classList.remove('d-none');
};

// Validate username availability
editUsernameField.addEventListener('blur', () => {
    if (editUsernameField.value.length < 3 || editUsernameField.value.length > 15) {
        editUsernameField.setCustomValidity('Invalid');
        editUsernameField.classList.add('is-invalid');
    } else {
        fetch(`crud/users/read_users.php?username=${encodeURIComponent(editUsernameField.value)}`)
            .then(response => response.json())
            .then(data => {
                if (data.exists) {
                    editUsernameField.setCustomValidity('Username already taken.');
                    editUsernameField.classList.add('is-invalid');
                } else {
                    editUsernameField.setCustomValidity('');
                    editUsernameField.classList.remove('is-invalid');
                }
            });
    }
});

// Validate email availability
editEmailField.addEventListener('blur', () => {
    if (!validateEmail(editEmailField.value)) {
        editEmailField.setCustomValidity('Invalid email format.');
        editEmailField.classList.add('is-invalid');
    } else {
        fetch(`crud/users/read_users.php?email=${encodeURIComponent(editEmailField.value)}`)
            .then(response => response.json())
            .then(data => {
                if (data.exists) {
                    editEmailField.setCustomValidity('Email already taken.');
                    editEmailField.classList.add('is-invalid');
                } else {
                    editEmailField.setCustomValidity('');
                    editEmailField.classList.remove('is-invalid');
                }
            });
    }
});

// Validate password strength
editPasswordField.addEventListener('input', () => {
    if (!validatePasswordStrength(editPasswordField.value)) {
        editPasswordField.setCustomValidity('Weak password.');
        editPasswordField.classList.add('is-invalid');
    } else {
        editPasswordField.setCustomValidity('');
        editPasswordField.classList.remove('is-invalid');
    }
});

// Check password confirmation
editConfirmPasswordField.addEventListener('input', () => {
    if (editConfirmPasswordField.value !== editPasswordField.value) {
        editConfirmPasswordField.setCustomValidity('Passwords do not match.');
        editConfirmPasswordField.classList.add('is-invalid');
    } else {
        editConfirmPasswordField.setCustomValidity('');
        editConfirmPasswordField.classList.remove('is-invalid');
    }
});
</script>


