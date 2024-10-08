document.addEventListener('DOMContentLoaded', function () {

    const loginForm = document.getElementById('loginForm');
    const loginMessage = document.getElementById('login-message');
    const registerForm = document.getElementById('registerForm');
    const registerMessage = document.getElementById('register-message');
    const balanceForm = document.getElementById('balanceForm');
    const balanceMessage = document.getElementById('balance-message');
        
    // Kada se user login-a, update cartbadge
    if (typeof isLoggedIn !== 'undefined' && isLoggedIn) {
        updateCartBadge();
    }
    

    //LOGIN USERA
    if (loginForm) {
        loginForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(loginForm);
            const xhttp = new XMLHttpRequest();
            xhttp.open('POST', 'login.php');
            xhttp.onload = function() {
                if (xhttp.status === 200) {
                    try {
                        const response = JSON.parse(xhttp.responseText);
                        if (response.success) {
                            loginMessage.innerHTML = '<div class="alert alert-success mt-3" role="alert">Successfully logged in!</div>';
                            // Redirect based on the response's redirect URL
                            setTimeout(function() {
                                window.location.href = response.redirect;
                            }, 1000);
                        } else {
                            loginMessage.innerHTML = '<div class="alert alert-danger mt-3" role="alert">' + response.error + '</div>';
                        }
                    } catch (error) {
                        console.error('Error parsing JSON response:', error);
                    }
                } else {
                    console.error('Request failed. Status:', xhttp.status);
                }
            };
            xhttp.onerror = function() {
                console.error('Request error.');
            };
            xhttp.send(formData);
        });
    }

    //REGISTER USERA
    if (registerForm) {
        registerForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(registerForm);
            const xhttp = new XMLHttpRequest();
            xhttp.open('POST', 'register.php');
            xhttp.onload = function() {
                if (xhttp.status === 200) {
                    try {
                        const response = JSON.parse(xhttp.responseText);
                        if (response.success) {
                            registerMessage.innerHTML = '<div class="alert alert-success mt-3" role="alert">Registration successful! Logging you in...</div>';
                            setTimeout(function() {
                                window.location.href = response.redirect; // Redirect to the provided URL
                            }, 2000);
                        } else {
                            registerMessage.innerHTML = '<div class="alert alert-danger mt-3" role="alert">' + response.error + '</div>';
                        }
                    } catch (error) {
                        console.error('Error parsing JSON response:', error);
                    }
                } else {
                    console.error('Request failed. Status:', xhr.status);
                }
            };
            xhttp.onerror = function() {
                console.error('Request error.');
            };
            xhttp.send(formData);
        });
    }

    //SORTING
    const sortSelect = document.getElementById('sort-select');
    
    if (sortSelect) {

        const urlParams = new URLSearchParams(window.location.search);
        const sortValue = urlParams.get('sort') || 'default';
        sortSelect.value = sortValue;

        sortSelect.addEventListener('change', updateURL);
    }

    function updateURL() {
        const sortValue = document.getElementById('sort-select').value;
        let url = new URL(window.location.href);

        if (url.hash) {
            url.hash = '';
        }

        if (sortValue) {
            url.searchParams.set('sort', sortValue);
        } else {
            url.searchParams.delete('sort');
        }

        window.location.href = url.href;
    }

    //DODAVANJE BALANCE
    if (balanceForm) {
        balanceForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(balanceForm);
            const xhttp = new XMLHttpRequest();
            xhttp.open('POST', 'add_balance.php');
            xhttp.onload = function() {
                if (xhttp.status === 200) {
                    try {
                        const response = JSON.parse(xhttp.responseText);
                        if (response.success) {
                            balanceMessage.innerHTML = '<div class="alert alert-success mt-3" role="alert">Balance updated successfully!</div>';
                            // Update balance on the screen
                            document.getElementById('user-balance').textContent = 'Balance: $' + response.new_balance;
                            setTimeout(function() {
                                $('#balanceModal').modal('hide');
                                balanceForm.reset();
                            }, 2000);
                        } else {
                            balanceMessage.innerHTML = '<div class="alert alert-danger mt-3" role="alert">' + response.error + '</div>';
                        }
                    } catch (error) {
                        console.error('Error parsing JSON response:', error);
                    }
                } else {
                    console.error('Request failed. Status:', xhttp.status);
                }
            };
            xhttp.onerror = function() {
                console.error('Request error.');
            };
            xhttp.send(formData);
        });
    }

    //EDIT PROFILA KAO USER
    const editProfileForm = document.getElementById('editProfileForm');
    const editMessage = document.getElementById('edit-message');

    if (editProfileForm) {
    editProfileForm.addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent default form submission

        const formData = new FormData(editProfileForm);
        const xhr = new XMLHttpRequest();

        xhr.open('POST', 'edit_profile.php', true);
        xhr.onload = function() {
            if (xhr.status === 200) {
                try {
                const response = JSON.parse(xhr.responseText);

                if (response.success) {
                    editMessage.innerHTML = '<div class="alert alert-success mt-3" role="alert">Profile updated successfully!</div>';
                    document.querySelector('span#user-name').textContent = response.name;
                    document.querySelector('span#user-surname').textContent = response.surname;
                    document.querySelector('span#user-username').textContent = response.username;
                    document.querySelector('span#user-email').textContent = response.email;

                    setTimeout(function() {
                        const modal = bootstrap.Modal.getInstance(document.getElementById('editUserModal'));
                        modal.hide();
                    }, 1500);

                } else {
                    editMessage.innerHTML = '<div class="alert alert-danger mt-3" role="alert">' + response.error + '</div>';
                }
            }catch (error) {
                console.error('Error parsing JSON response:', error);
            }
         } else {
            console.error('Request failed. Status:', xhr.status);
            }
        };
        xhr.send(formData); // Send FormData object directly
    });
}

//EDIT PASSWORDA KAO USER
const changePasswordForm = document.getElementById('changePasswordForm');

if (changePasswordForm) {
    changePasswordForm.addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent form from submitting the traditional way

        const formData = new FormData(changePasswordForm);
        const xhr = new XMLHttpRequest();

        xhr.open('POST', 'change_password.php', true);
        xhr.onload = function() {
            if (xhr.status === 200) {
                try {
                    const response = JSON.parse(xhr.responseText);
                    const passwordMessage = document.getElementById('password-message');

                    if (response.success) {
                        passwordMessage.innerHTML = '<div class="alert alert-success mt-3" role="alert">Password changed successfully!</div>';

                        // Close modal after 1-2 seconds
                        setTimeout(function() {
                            const modal = bootstrap.Modal.getInstance(document.getElementById('changePasswordModal'));
                            modal.hide();
                        }, 1500);
                    } else {
                        passwordMessage.innerHTML = '<div class="alert alert-danger mt-3" role="alert">' + response.error + '</div>';
                    }
                } catch (error) {
                    console.error('Error parsing JSON response:', error);
                }
            } else {
                console.error('Request failed. Status:', xhr.status);
            }
        };

        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.send(new URLSearchParams(formData).toString());
    });
}

//DODAVANJE U CART
document.querySelectorAll('.add-to-cart').forEach(button => {
    button.addEventListener('click', function() {
        const productId = this.getAttribute('data-product-id');

        // Send AJAX request to add item to cart
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'add_to_cart.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        // Prepare the data to be sent
        const data = `product_id=${encodeURIComponent(productId)}`;

        xhr.onload = function() {
            if (xhr.status === 200) {
                try {
                    const response = JSON.parse(xhr.responseText);
                    const message = document.getElementById('cart-message');

                    if (response.success) {
                        message.innerHTML = '<div class="alert alert-success mt-3" role="alert">' + response.message + '</div>';
                        // Optionally, you can clear the message after 2 seconds
                        setTimeout(() => {
                            message.innerHTML = '';
                        }, 2000);
                    } else {
                        message.innerHTML = '<div class="alert alert-danger mt-3" role="alert">' + response.message + '</div>';
                    }
                } catch (error) {
                    console.error('Error parsing JSON response:', error);
                }
            } else {
                console.error('Request failed. Status:', xhr.status);
            }
        };

        xhr.send(data);
    });
});

//UPDATE CARTBADGE
function updateCartBadge() {
    const xhttp = new XMLHttpRequest();
    xhttp.open('GET', 'get_cart_items.php');
    xhttp.onload = function() {
        if (xhttp.status === 200) {
            const cartContents = JSON.parse(xhttp.responseText);
            let totalItems = 0;
            cartContents.forEach(item => {
                totalItems += parseInt(item.quantity);
            });
            const cartBadge = document.querySelector('#cart-badge');
            cartBadge.textContent = totalItems > 0 ? `(${totalItems})` : '';
        } else {
            console.error('Failed to fetch cart contents.');
        }
    };
    xhttp.onerror = function() {
        console.error('Error fetching cart contents.');
    };
    xhttp.send();
}

//NAKON SVAKOG DODAVANJA U CART UPDATE BADGE
document.querySelectorAll('.add-to-cart').forEach(button => {
    button.addEventListener('click', function() {
        // After successfully adding item to cart
        updateCartBadge();
    });
});

//UCITAVANJE ITEMA IZ CARTA KAD SE OTVORI CARTMODAL
document.querySelector('#cartModal').addEventListener('show.bs.modal', function () {
    loadCartItems();
});
    
//FUNKCIJA ZA DOHVACANJE ITEMA IZ DATABASE IZ CARTA
function loadCartItems() {
    const xhttp = new XMLHttpRequest();
    xhttp.open('GET', 'get_cart_items.php');
    xhttp.onload = function() {
        if (xhttp.status === 200) {
            const cartItems = JSON.parse(xhttp.responseText);
            const container = document.querySelector('#cart-items-container');
            let total = 0;
            container.innerHTML = ''; // Clear existing items
            
            if (cartItems.length === 0) {
                container.innerHTML = '<p>Your cart is empty.</p>';
            } else {
                cartItems.forEach(item => {
                    const itemElement = document.createElement('div');
                    itemElement.classList.add('cart-item', 'd-flex', 'align-items-center', 'mb-3');
                    const itemPrice = parseFloat(item.price) * parseInt(item.quantity);
                    total += itemPrice;
                    
                    console.log(`Product ID: ${item.product_id}`);

                    itemElement.innerHTML = `
                        <img src="${item.image}" class="img-thumbnail me-3" style="width: 100px;" alt="${item.name}">
                        <div>
                        <h5 class="mb-1">${item.name}</h5>
                        <p class="mb-1">Price: $${item.price}</p>
                        <p class="mb-1">Quantity: ${item.quantity}</p>
                        <button class="btn btn-danger remove-item-btn" data-product-id="${item.product_id}">Remove</button>
                        </div>
                    `;
                    container.appendChild(itemElement);
                });
            }

            // Update the total price
            document.getElementById('cart-total').textContent = total.toFixed(2);
        } else {
            console.error('Failed to fetch cart items.');
        }
    };
    xhttp.onerror = function() {
        console.error('Error fetching cart items.');
    };
    xhttp.send();
}


//REMOVE SVE IZ CARTA
document.querySelector('#remove-all-btn').addEventListener('click', function() {
    const xhttp = new XMLHttpRequest();
    xhttp.open('POST', 'remove_all_from_cart.php', true);
    xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    xhttp.onload = function() {
        if (xhttp.status === 200) {
            const response = JSON.parse(xhttp.responseText);
            if (response.success) {
                loadCartItems();  // Reload cart items after removing
                updateCartBadge(); // Update the cart badge
                showPopUpMessage('All items removed successfully', 'success');
            } else {
                showPopUpMessage(response.message, 'error');
            }
        }
    };

    xhttp.onerror = function() {
        console.error('Error removing all items from cart.');
    };

    xhttp.send();  // No data needed for the "remove all" request
});

//REMOVANJE POJEDINACNOG ITEMA JEDAN PO JEDAN IZ CARTA
document.addEventListener('click', function(event) {
    if (event.target && event.target.classList.contains('remove-item-btn')) {
        const productId = event.target.getAttribute('data-product-id');
        
        console.log('Product ID to remove:', productId); // Debug statement
        
        const xhttp = new XMLHttpRequest();
        xhttp.open('POST', 'remove_from_cart.php', true);
        xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhttp.onload = function() {
            if (xhttp.status === 200) {
                try {
                    const response = JSON.parse(xhttp.responseText);
                    if (response.success) {
                        showPopUpMessage('Item removed successfully', 'success');
                        loadCartItems(); // Reload cart items to reflect changes
                        updateCartBadge(); // Update cart badge number
                    } else {
                        showPopUpMessage(response.message, 'error');
                    }
                } catch (e) {
                    console.error('Error parsing JSON:', e);
                }
            } else {
                console.error('Failed to remove item. Status:', xhttp.status);
            }
        };
        xhttp.onerror = function() {
            console.error('Error while removing item.');
        };
        xhttp.send(`productId=${productId}`);
    }
});

//CHECKOUT, KUPOVINA STVARI
document.querySelector('#checkout-btn').addEventListener('click', function() {
    const cartItems = document.querySelectorAll('.cart-item'); // Get all cart items
    if (cartItems.length === 0) {
        showPopUpMessage('Your cart is empty!', 'error');  // Display error message
        return;  // Stop the function if the cart is empty
    }
    const xhttp = new XMLHttpRequest();
    xhttp.open('POST', 'checkout.php', true);
    xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    xhttp.onload = function() {
        if (xhttp.status === 200) {
            const response = JSON.parse(xhttp.responseText);
            if (response.success) {
                loadCartItems();  // Reload the cart to show it's empty
                updateCartBadge();  // Update the cart badge
                updateUserBalance();
                showPopUpMessage('Checkout successful! Your cart has been emptied.', 'success');

                setTimeout(function() {
                    window.location.reload();
                }, 2000); 
            } else {
                showPopUpMessage(response.message, 'error');
            }
        }
    };

    xhttp.onerror = function() {
        console.error('Error during checkout.');
    };

    xhttp.send();  // No additional data needed; all checks will be done on the server
});

//UPDATE USERBALANCE NAKON KUPOVINE
function updateUserBalance() {
    const xhttp = new XMLHttpRequest();
    xhttp.open('GET', 'get_balance.php', true);  // A new script to fetch the current balance

    xhttp.onload = function() {
        if (xhttp.status === 200) {
            const response = JSON.parse(xhttp.responseText);
            if (response.success) {
                // Update the balance display in the navigation bar
                document.querySelector('#user-balance').textContent = "Balance: $" + response.balance;
            }
        }
    };

    xhttp.onerror = function() {
        console.error('Error fetching balance.');
    };

    xhttp.send();  // Send the request to get the balance
}


// ADMIN SCRIPTS FOR PHONES

//UCITAVANJE MOBITELA KAO ADMIN
if (document.getElementById('phones-list')) {
    loadPhones();
}


// FUNCKIJA ZA UCITAVANJE MOBITELA
const phonesList = document.querySelector('#phones-list');

function loadPhones() {
    const xhttp = new XMLHttpRequest();
    xhttp.open('GET', 'get_phones.php', true);
    xhttp.onload = function() {
        if (xhttp.status === 200) {
            try {
                const response = JSON.parse(xhttp.responseText);
                if (response.success) {
                    phonesList.innerHTML = ''; // Clear the table body
                    response.phones.forEach(phone => {
                        const row = document.createElement('tr');
                        row.innerHTML = `
                            <td>${phone.id}</td>
                            <td><img src="${phone.image}" alt="${phone.name}"></td>
                            <td>${phone.name}</td>
                            <td>${phone.quantity}</td>
                            <td>$${parseFloat(phone.price).toFixed(2)}</td>
                            <td>
                                <button class="btn btn-warning btn-sm edit-phone-btn" data-phone-id="${phone.id}">Edit</button>
                                <button class="btn btn-danger btn-sm delete-phone-btn" data-phone-id="${phone.id}">Delete</button>

                            </td>
                        `;
                        phonesList.appendChild(row);
                    });
                } else {
                    phonesList.innerHTML = `<tr><td colspan="6">${response.message}</td></tr>`;
                }
            } catch (error) {
                console.error('Error parsing JSON response:', error);
            }
        } else {
            console.error('Request failed. Status:', xhttp.status);
        }
    };
    xhttp.onerror = function() {
        console.error('Request error.');
    };
    xhttp.send();
}

    // DODAVANJE NOVOG MOBITELA KAO ADMIN
    const addPhoneForm = document.querySelector('#addPhoneForm');
    const addPhoneMessage = document.querySelector('#addPhoneMessage');


    if (addPhoneForm) {
        addPhoneForm.addEventListener('submit', function(e) {
            e.preventDefault();

            const phoneName = document.querySelector('#phoneName').value;
            const phonePrice = document.querySelector('#phonePrice').value;
            const phoneQuantity = document.querySelector('#phoneQuantity').value;
            const phoneImage = document.querySelector('#phoneImage').value;

            const formData = new FormData();
            formData.append('name', phoneName);
            formData.append('price', phonePrice);
            formData.append('quantity', phoneQuantity);
            formData.append('image', phoneImage);

            const xhttp = new XMLHttpRequest();
            xhttp.open('POST', 'add_phone.php', true);
            xhttp.onload = function() {
                if (xhttp.status === 200) {
                    try {
                        const response = JSON.parse(xhttp.responseText);
                        if (response.success) {
                            addPhoneMessage.innerHTML = '<div class="alert alert-success">Phone added successfully!</div>';
                            // Reload the phone list
                            loadPhones();
                            setTimeout(function() {
                                // Hide the modal
                                var myModal = new bootstrap.Modal(document.getElementById('addPhoneModal'));
                                myModal.hide();
                                // Reset the form
                                addPhoneForm.reset();
                                addPhoneMessage.innerHTML = '';
                            }, 2000);
                        } else {
                            addPhoneMessage.innerHTML = '<div class="alert alert-danger">' + response.message + '</div>';
                        }
                    } catch (error) {
                        console.error('Error parsing JSON response:', error);
                    }
                } else {
                    console.error('Request failed. Status:', xhttp.status);
                }
            };
            xhttp.onerror = function() {
                console.error('Request error.');
            };
            xhttp.send(formData);
        });
    }

    //BRISANJE MOBITELA KAO ADMIN, BUTTON ZA OTVARANJE DELETE MODALA

    let phoneIdToDelete = null;

    // Show modal when delete button is clicked
    document.addEventListener('click', function(event) {
        if (event.target && event.target.classList.contains('delete-phone-btn')) {
            phoneIdToDelete = event.target.getAttribute('data-phone-id');
            const deletePhoneModal = new bootstrap.Modal(document.getElementById('deletePhoneModal'));
            deletePhoneModal.show();
        }
    });

    //DELETE BUTTON U MODALU DELETE ZA BRISANJE MOBITELA
    document.getElementById('confirmDelete').addEventListener('click', function() {
        if (phoneIdToDelete) {
            const xhttp = new XMLHttpRequest();
            xhttp.open('POST', 'delete_phone.php', true);
            xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhttp.onload = function() {
                if (xhttp.status === 200) {
                    try {
                        const response = JSON.parse(xhttp.responseText);
                        if (response.success) {
                            showPopUpMessage(response.message, 'success');
                            loadPhones(); // Reload phones to reflect changes
                            // Close the modal
                            const deletePhoneModal = bootstrap.Modal.getInstance(document.getElementById('deletePhoneModal'));
                            if (deletePhoneModal) {
                                deletePhoneModal.hide();
                            }
                        } else {
                            showPopUpMessage(response.message, 'error');
                        }
                    } catch (error) {
                        console.error('Error parsing JSON response:', error);
                    }
                } else {
                    console.error('Failed to delete phone. Status:', xhttp.status);
                }
            };
            xhttp.onerror = function() {
                console.error('Error while deleting phone.');
            };
            xhttp.send(`phoneId=${phoneIdToDelete}`);
        }
    });

    //OTVARANJE EDIT MODALA KAO ADMIN ZA EDIT PHONE
    document.addEventListener('click', function(event) {
        if (event.target && event.target.classList.contains('edit-phone-btn')) {
            const phoneId = event.target.getAttribute('data-phone-id');
            
            // Fetch phone data and open modal
            const xhttp = new XMLHttpRequest();
            xhttp.open('GET', `get_phone.php?id=${phoneId}`, true);
            xhttp.onload = function() {
                if (xhttp.status === 200) {
                    try {
                        const response = JSON.parse(xhttp.responseText);
                        if (response.success) {
                            const phone = response.phone;
                            document.getElementById('editPhoneId').value = phone.id;
                            document.getElementById('editPhoneName').value = phone.name;
                            document.getElementById('editPhonePrice').value = phone.price;
                            document.getElementById('editPhoneQuantity').value = phone.quantity;
                            document.getElementById('editPhoneImage').value = phone.image;

                            // Show modal
                            const editPhoneModal = new bootstrap.Modal(document.getElementById('editPhoneModal'));
                            editPhoneModal.show();
                        } else {
                            console.error('Failed to fetch phone details:', response.message);
                        }
                    } catch (error) {
                        console.error('Error parsing JSON response:', error);
                    }
                } else {
                    console.error('Request failed. Status:', xhttp.status);
                }
            };
            xhttp.onerror = function() {
                console.error('Request error.');
            };
            xhttp.send();
        }
    });

    //UPDATE EDITIRANOG PHONE-A U BAZU I NA SCREENU
    document.getElementById('editPhoneForm').addEventListener('submit', function(event) {
        event.preventDefault();
        const formData = new FormData(this);
        
        const xhttp = new XMLHttpRequest();
        xhttp.open('POST', 'update_phone.php', true);
        xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhttp.onload = function() {
            if (xhttp.status === 200) {
                try {
                    const response = JSON.parse(xhttp.responseText);
                    if (response.success) {
                        // Close modal and reload phone list
                        const editPhoneModal = bootstrap.Modal.getInstance(document.getElementById('editPhoneModal'));
                        editPhoneModal.hide();
                        loadPhones(); // Reload phone list
                        showPopUpMessage('Phone updated successfully', 'success');
                    } else {
                        showPopUpMessage(response.message, 'error');
                    }
                } catch (error) {
                    console.error('Error parsing JSON response:', error);
                }
            } else {
                console.error('Request failed. Status:', xhttp.status);
            }
        };
        xhttp.onerror = function() {
            console.error('Request error.');
        };
        xhttp.send(new URLSearchParams(formData).toString());
    });


    // ADMIN SCRIPTS FOR USERS

    //UCITAVANJE USERA
    if (document.getElementById('users-list')) {
    loadUsers();
    }

    // FUNKCIJA ZA UCITAVANJE USERA
const usersList = document.querySelector('#users-list');

function loadUsers() {
    const xhttp = new XMLHttpRequest();
    xhttp.open('GET', 'get_users.php', true);
    xhttp.onload = function() {
        if (xhttp.status === 200) {
            try {
                const response = JSON.parse(xhttp.responseText);
                if (response.success) {
                    usersList.innerHTML = ''; // Clear the table body
                    response.users.forEach(user => {
                        const row = document.createElement('tr');
                        row.innerHTML = `
                            <td>${user.id}</td>
                            <td>${user.username}</td>
                            <td>${user.email}</td>
                            <td>$${parseFloat(user.balance).toFixed(2)}</td>
                            <td>
                                <button class="btn btn-warning btn-sm edit-user-btn" data-user-id="${user.id}">Edit</button>

                                <button class="btn btn-danger btn-sm delete-user-btn" data-user-id="${user.id}">Delete</button>
                            </td>
                        `;
                        usersList.appendChild(row);
                    });
                } else {
                    usersList.innerHTML = `<tr><td colspan="5">${response.message}</td></tr>`;
                }
            } catch (error) {
                console.error('Error parsing JSON response:', error);
            }
        } else {
            console.error('Request failed. Status:', xhttp.status);
        }
    };
    xhttp.onerror = function() {
        console.error('Request error.');
    };
    xhttp.send();
}

    // CLICK NA DELETE BUTTON PORED USERA

let userIdToDelete = null;

// Show modal when delete button is clicked
document.addEventListener('click', function(event) {
    if (event.target && event.target.classList.contains('delete-user-btn')) {
        userIdToDelete = event.target.getAttribute('data-user-id');
        const deleteUserModal = new bootstrap.Modal(document.getElementById('deleteUserModal'));
        deleteUserModal.show();
    }
});

// BRISANJE USERA IZ DATABASEA
document.getElementById('confirmUserDelete').addEventListener('click', function() {
    if (userIdToDelete) {
        const xhttp = new XMLHttpRequest();
        xhttp.open('POST', 'delete_user.php', true);
        xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhttp.onload = function() {
            if (xhttp.status === 200) {
                try {
                    const response = JSON.parse(xhttp.responseText);
                    if (response.success) {
                        showPopUpMessage(response.message, 'success');
                        loadUsers(); // Reload users to reflect changes
                        // Close the modal
                        const deleteUserModal = bootstrap.Modal.getInstance(document.getElementById('deleteUserModal'));
                        if (deleteUserModal) {
                            deleteUserModal.hide();
                        }
                    } else {
                        showPopUpMessage(response.message, 'error');
                    }
                } catch (error) {
                    console.error('Error parsing JSON response:', error);
                }
            } else {
                console.error('Failed to delete user. Status:', xhttp.status);
            }
        };
        xhttp.onerror = function() {
            console.error('Error while deleting user.');
        };
        xhttp.send(`userId=${userIdToDelete}`);
    }
});


    // EDIT BUTTON CLICK ZA EDIT USERA
document.addEventListener('click', function(event) {
    if (event.target && event.target.classList.contains('edit-user-btn')) {
        const userId = event.target.getAttribute('data-user-id');
        
        // Fetch user data and open modal
        const xhttp = new XMLHttpRequest();
        xhttp.open('GET', `get_user.php?id=${userId}`, true);
        xhttp.onload = function() {
            if (xhttp.status === 200) {
                try {
                    const response = JSON.parse(xhttp.responseText);
                    if (response.success) {
                        const user = response.user;
                        document.getElementById('adminEditUserId').value = user.id;
                        document.getElementById('adminEditName').value = user.name;
                        document.getElementById('adminEditSurname').value = user.surname;
                        document.getElementById('adminEditUsername').value = user.username;
                        document.getElementById('adminEditEmail').value = user.email;

                        // Show modal
                        const adminEditUserModal = new bootstrap.Modal(document.getElementById('adminEditUserModal'));
                        adminEditUserModal.show();
                    } else {
                        console.error('Failed to fetch user details:', response.message);
                    }
                } catch (error) {
                    console.error('Error parsing JSON response:', error);
                }
            } else {
                console.error('Request failed. Status:', xhttp.status);
            }
        };
        xhttp.onerror = function() {
            console.error('Request error.');
        };
        xhttp.send();
    }
});

    //EDIT USERA U BAZI
document.getElementById('adminEditUserForm').addEventListener('submit', function(event) {
    event.preventDefault();
    const formData = new FormData(this);
    
    const xhttp = new XMLHttpRequest();
    xhttp.open('POST', 'update_user.php', true);
    xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhttp.onload = function() {
        if (xhttp.status === 200) {
            try {
                const response = JSON.parse(xhttp.responseText);
                if (response.success) {
                    // Close modal and reload user list
                    const adminEditUserModal = bootstrap.Modal.getInstance(document.getElementById('adminEditUserModal'));
                    adminEditUserModal.hide();
                    loadUsers(); // Reload user list
                    showPopUpMessage('User updated successfully', 'success');
                } else {
                    showPopUpMessage(response.message, 'error');
                }
            } catch (error) {
                console.error('Error parsing JSON response:', error);
            }
        } else {
            console.error('Request failed. Status:', xhttp.status);
        }
    };
    xhttp.onerror = function() {
        console.error('Request error.');
    };
    xhttp.send(new URLSearchParams(formData).toString());
});






    // FUNCIJA ZA POPUP MESSAGE
    function showPopUpMessage(message, type) {
        const popup = document.createElement('div');
        popup.classList.add('popup-message', type === 'success' ? 'popup-success' : 'popup-error');
        popup.textContent = message;

        // Style the popup
        popup.style.position = 'fixed';
        popup.style.top = '20px';
        popup.style.left = '50%';
        popup.style.transform = 'translateX(-50%)';
        popup.style.padding = '10px 20px';
        popup.style.backgroundColor = type === 'success' ? '#4caf50' : '#f44336'; // Green for success, red for error
        popup.style.color = 'white';
        popup.style.fontSize = '16px';
        popup.style.borderRadius = '5px';
        popup.style.zIndex = '9999';
        popup.style.boxShadow = '0 4px 8px rgba(0, 0, 0, 0.2)';
        popup.style.opacity = '1';
        popup.style.transition = 'opacity 0.5s ease';

        document.body.appendChild(popup);

        // Automatically remove the popup after 3 seconds
        setTimeout(function() {
            popup.style.opacity = '0';
            setTimeout(function() {
                document.body.removeChild(popup);
            }, 500); // Wait for the fade-out transition to complete before removing
        }, 3000);
    }
});
