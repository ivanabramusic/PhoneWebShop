<!-- Login Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModalLabel">Login</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="loginForm" method="post">
                    <div class="mb-3">
                        <label for="loginUsername" class="form-label">Username</label>
                        <input type="text" class="form-control" id="loginUsername" name="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="loginPassword" class="form-label">Password</label>
                        <input type="password" class="form-control" id="loginPassword" name="password" required>
                    </div>
                    <div id="loginError" class="text-danger" style="display:none;"></div> <!-- Error message container -->
                    <button type="submit" class="btn btn-primary">Login</button>
                    <div id="login-message" class="mt-3"></div>
                </form>
                <p class="mt-3">If you don't have an account, you need to 
                <button type="button" class="btn btn-link p-0" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#registerModal">register</button>
                </p>    
            </div>
        </div>
    </div>
</div>

<!-- Register Modal -->
<div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="registerModalLabel">Register</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="registerForm" method="post" action="register.php">
                    <div class="mb-3">
                        <label for="registerName" class="form-label">Name</label>
                        <input type="text" class="form-control" id="registerName" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="registerSurname" class="form-label">Surname</label>
                        <input type="text" class="form-control" id="registerSurname" name="surname" required>
                    </div>
                    <div class="mb-3">
                        <label for="registerUsername" class="form-label">Username</label>
                        <input type="text" class="form-control" id="registerUsername" name="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="registerEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="registerEmail" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="registerPassword" class="form-label">Password</label>
                        <input type="password" class="form-control" id="registerPassword" name="password" required>
                    </div>
                    <div class="mb-3">
                        <label for="repeatPassword" class="form-label">Repeat Password</label>
                        <input type="password" class="form-control" id="repeatPassword" name="repeat_password" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Register</button>
                    <div id="register-message" class="mt-3"></div>
                </form>
                <p class="mt-3">
                    If you have an account, you can 
                    <button type="button" class="btn btn-link p-0" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#loginModal">login</button>.
                </p>
            </div>
        </div>
    </div>
</div>


<!-- Logout Modal -->
<div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="logoutModalLabel">Logout</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to log out?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <a href="logout.php" class="btn btn-primary">Logout</a>
            </div>
        </div>
    </div>
</div>

<!-- Balance Modal -->
<div class="modal fade" id="balanceModal" tabindex="-1" aria-labelledby="balanceModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="balanceModalLabel">Add to Balance</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="balanceForm">
                    <div class="mb-3">
                        <label for="amount" class="form-label">Amount</label>
                        <input type="number" class="form-control" id="amount" name="amount" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Add</button>
                    <div id="balance-message" class="mt-3"></div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit User Modal -->
<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editUserModalLabel">Edit Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editProfileForm">
                    <div class="mb-3">
                        <label for="editName" class="form-label">Name</label>
                        <input type="text" class="form-control" id="editName" name="name" value="<?php echo htmlspecialchars($name); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="editSurname" class="form-label">Surname</label>
                        <input type="text" class="form-control" id="editSurname" name="surname" value="<?php echo htmlspecialchars($surname); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="editUsername" class="form-label">Username</label>
                        <input type="text" class="form-control" id="editUsername" name="username" value="<?php echo htmlspecialchars($username); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="editEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="editEmail" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                    <div id="edit-message" class="mt-3"></div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Change Password Modal -->
<div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="changePasswordModalLabel">Change Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="changePasswordForm">
                    <div class="mb-3">
                        <label for="current_password" class="form-label">Current Password</label>
                        <input type="password" class="form-control" id="current_password" name="current_password" required>
                    </div>
                    <div class="mb-3">
                        <label for="new_password" class="form-label">New Password</label>
                        <input type="password" class="form-control" id="new_password" name="new_password" required>
                     </div>
                    <div class="mb-3">
                        <label for="confirm_password" class="form-label">Confirm New Password</label>
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                    </div>
                     <button type="submit" class="btn btn-primary">Change Password</button>
                    <div id="password-message" class="mt-3"></div>
                </form>

            </div>
        </div>
    </div>
</div>

<!-- Cart Modal -->
<div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cartModalLabel">Your Cart</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="cart-items-container">
                    <!-- Cart items will be dynamically populated here -->
                </div>
            </div>
            <div class="modal-footer d-flex justify-content-between">
                <h5>Total: $<span id="cart-total">0.00</span></h5>
                <div>
                    <button type="button" class="btn btn-danger" id="remove-all-btn">Remove All</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="checkout-btn">Checkout</button>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Phone Modal -->
<div class="modal fade" id="addPhoneModal" tabindex="-1" aria-labelledby="addPhoneModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addPhoneModalLabel">Add New Phone</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="addPhoneForm">
          <div class="mb-3">
            <label for="phoneName" class="form-label">Name</label>
            <input type="text" class="form-control" id="phoneName" required>
          </div>
          <div class="mb-3">
            <label for="phonePrice" class="form-label">Price</label>
            <input type="number" class="form-control" id="phonePrice" step="0.01" required>
          </div>
          <div class="mb-3">
            <label for="phoneQuantity" class="form-label">Quantity</label>
            <input type="number" class="form-control" id="phoneQuantity" required>
          </div>
          <div class="mb-3">
            <label for="phoneImage" class="form-label">Image URL</label>
            <input type="text" class="form-control" id="phoneImage" required>
          </div>
          <button type="submit" class="btn btn-primary">Add Phone</button>
        </form>
        <div id="addPhoneMessage" class="mt-3"></div>
      </div>
    </div>
  </div>
</div>

<!-- Delete Phone Modal -->
<div class="modal fade" id="deletePhoneModal" tabindex="-1" aria-labelledby="deletePhoneModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deletePhoneModalLabel">Confirm Deletion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this phone?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmDelete">Delete</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Phone Modal -->
<div class="modal fade" id="editPhoneModal" tabindex="-1" aria-labelledby="editPhoneModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editPhoneModalLabel">Edit Phone</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editPhoneForm">
                    <input type="hidden" id="editPhoneId" name="id">
                    <div class="mb-3">
                        <label for="editPhoneName" class="form-label">Name</label>
                        <input type="text" class="form-control" id="editPhoneName" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="editPhonePrice" class="form-label">Price</label>
                        <input type="number" step="0.01" class="form-control" id="editPhonePrice" name="price" required>
                    </div>
                    <div class="mb-3">
                        <label for="editPhoneQuantity" class="form-label">Quantity</label>
                        <input type="number" class="form-control" id="editPhoneQuantity" name="quantity" required>
                    </div>
                    <div class="mb-3">
                        <label for="editPhoneImage" class="form-label">Image URL</label>
                        <input type="text" class="form-control" id="editPhoneImage" name="image" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Phone</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete User Modal -->
<div class="modal fade" id="deleteUserModal" tabindex="-1" aria-labelledby="deleteUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteUserModalLabel">Confirm Deletion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this user?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmUserDelete">Delete</button>
            </div>
        </div>
    </div>
</div>

<!-- Admin Edit User Modal -->
<div class="modal fade" id="adminEditUserModal" tabindex="-1" aria-labelledby="adminEditUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="adminEditUserModalLabel">Edit User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="adminEditUserForm">
                    <input type="hidden" id="adminEditUserId" name="id">
                    <div class="mb-3">
                        <label for="adminEditName" class="form-label">Name</label>
                        <input type="text" class="form-control" id="adminEditName" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="adminEditSurname" class="form-label">Surname</label>
                        <input type="text" class="form-control" id="adminEditSurname" name="surname" required>
                    </div>
                    <div class="mb-3">
                        <label for="adminEditUsername" class="form-label">Username</label>
                        <input type="text" class="form-control" id="adminEditUsername" name="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="adminEditEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="adminEditEmail" name="email" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>










