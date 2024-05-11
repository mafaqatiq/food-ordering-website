function displayBurgerItems() {
    // Display burger items and set active state
    document.getElementById("burger-items").style.display = "flex";
    document.getElementById("pizza-items").style.display = "none";
    document.getElementById("icecream-items").style.display = "none";
    document.getElementById("burger-btn").style.backgroundColor = "#EB5757";
    document.getElementById("pizza-btn").style.backgroundColor = "#FFFFFF";
    document.getElementById("icecream-btn").style.backgroundColor = "#FFFFFF";

}

function displayPizzaItems() {
    // Display pizza items and set active state
    document.getElementById("burger-items").style.display = "none";
    document.getElementById("pizza-items").style.display = "flex";
    document.getElementById("icecream-items").style.display = "none";

    document.getElementById("pizza-btn").style.backgroundColor = "#EB5757";
    document.getElementById("burger-btn").style.backgroundColor = "#FFFFFF";
    document.getElementById("icecream-btn").style.backgroundColor = "#FFFFFF";

}

function displayIceCreamItems() {
    // Display ice cream items and set active state
    document.getElementById("burger-items").style.display = "none";
    document.getElementById("pizza-items").style.display = "none";
    document.getElementById("icecream-items").style.display = "flex";

    document.getElementById("icecream-btn").style.backgroundColor = "#EB5757";
    document.getElementById("pizza-btn").style.backgroundColor = "#FFFFFF";
    document.getElementById("burger-btn").style.backgroundColor = "#FFFFFF";


}




// Initial state
document.getElementById("burger-items").style.display = "flex";
document.getElementById("pizza-items").style.display = "none";
document.getElementById("icecream-items").style.display = "none";
document.getElementById("burger-btn").style.backgroundColor = "#EB5757";
document.getElementById("pizza-btn").style.backgroundColor = "#FFFFFF";
document.getElementById("icecream-btn").style.backgroundColor = "#FFFFFF";



function changeActive(event, id) {
    event.preventDefault(); // Prevent default anchor behavior
    var lists = document.querySelectorAll('.list');
    lists.forEach(function (item) {
        item.querySelector('a').classList.remove('default-color');
        item.classList.remove('active');
    });
    document.getElementById(id).classList.add('active');
    document.getElementById(id).querySelector('a').classList.add('default-color');

    // Scroll to the target section
    var targetId = document.getElementById(id).querySelector('a').getAttribute('href').substring(1);
    document.getElementById(targetId).scrollIntoView({ behavior: 'smooth' });
}

function scrollToMenu() {
    var menuSection = document.getElementById('menu-containerr');
    var offset = menuSection.offsetTop;
    window.scrollTo({
        top: offset,
        behavior: 'smooth'
    });
}

// navbar issue
function changeActive(id) {
    var lists = document.querySelectorAll('.list');
    lists.forEach(function (item) {
        item.classList.remove('active');
    });

    document.getElementById(id).classList.add('active');

    var page;
    switch (id) {
        case 'list1':
            page = 'admin-page.php';
            break;
        case 'list2':
            page = 'admin-products.php';
            break;
        case 'list3':
            page = 'admin-orders.php';
            break;
        case 'list4':
            page = 'admin-users.php';
            break;
        default:
            page = 'admin-page.php';
            break;
    }


    // You can use window.location.href to navigate to the specified page
    window.location.href = page;
}




// play video
const playButtons = document.querySelectorAll('.play-video-btn');
const videoPopup = document.getElementById('videoPopup');
const closeButton = document.getElementById('closeButton');
const videoPlayer = document.getElementById('videoPlayer');

playButtons.forEach(button => {
    button.addEventListener('click', () => {
        videoPopup.style.display = 'block';
        videoPlayer.play();
    });
});

closeButton.addEventListener('click', () => {
    videoPopup.style.display = 'none';
    videoPlayer.pause();
    videoPlayer.currentTime = 0;
});



function togglePasswordVisibility(fieldId) {
    let field = document.getElementById(fieldId);
    let icon = field.nextElementSibling.querySelector('i.fa');

    if (field.type === 'password') {
        field.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        field.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
}

function togglePasswordVisibility(fieldId) {
    let field = document.getElementById(fieldId);
    let icon = field.nextElementSibling.querySelector('i.fa');

    if (field.type === 'password') {
        field.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        field.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
}


//  Edit Form pop up
function close_edit_form() {
    document.getElementById("edit-form").style.display = "none";
}


// show cart modal of customer
const cartopenModalBtn = document.getElementById('cart-openModalBtn');
const cartcloseModalBtn = document.getElementById('cart-closeModalBtn');
const cartmodal = document.getElementById('cart-modal');
const cartoverlay = document.getElementById('cart-overlay');

cartopenModalBtn.addEventListener('click', () => {
    cartmodal.style.bottom = '0';
    cartoverlay.style.display = 'block';
    cartmodal.style.display = 'block';

});

cartcloseModalBtn.addEventListener('click', () => {
    cartmodal.style.bottom = '-500px';
    cartoverlay.style.display = 'none';
    cartmodal.style.display = 'none';
});

cartoverlay.addEventListener('click', () => {
    cartmodal.style.bottom = '-500px';
    cartoverlay.style.display = 'none';
    cartmodal.style.display = 'none';
});



document.addEventListener('DOMContentLoaded', function () {
    const addToCartButtons = document.querySelectorAll('.card button');
    let labelsAdded = false;
    let cartProducts = [];

    addToCartButtons.forEach(button => {
        button.addEventListener('click', function () {
            const card = button.closest('.card');
            const productName = card.querySelector('h2').innerText;
            const productPrice = card.querySelector('.price').innerText;
            const quantity = card.querySelector('.counter').value;

            const cartContent = document.querySelector('.cart-modal-content');

            document.getElementById("empty-cart").style.display = 'none';
            if (!labelsAdded) {
                // Create a div for the labels
                const labelsDiv = document.createElement('div');
                labelsDiv.classList.add('cart-labels');
                labelsDiv.innerHTML = `
                    <div>
                        <span style="float: left; font-weight: bold;">Product Name</span>
                        <span style="float: right; font-weight: bold;">Price x Quantity</span>
                    </div>
                `;
                cartContent.appendChild(labelsDiv);
                labelsAdded = true;
            }

            // Create a div for the product info
            const productDiv = document.createElement('div');
            productDiv.classList.add('cart-product');
            productDiv.style.background = 'rgb(249, 249, 249)';
            productDiv.style.boxShadow = 'rgba(0, 0, 0, 0.3) 0px 0px 5px';
            productDiv.style.display = 'inline-block';
            productDiv.style.width = '261px';
            productDiv.style.height = '74px';
            productDiv.style.borderRadius = '7px';
            productDiv.style.marginTop = '5px';
            productDiv.style.marginBottom = '5px';
            productDiv.style.overflow = 'auto';
            productDiv.innerHTML = `
    <p style="margin: 0; padding: 10px;">
        <span style="float: left;">${productName}</span>
        <span style="float: right; margin-left:10px;">
            ${productPrice} x <input type="number" value="${quantity}" style="width: 40px; text-align: center;"> 
        </span>
    </p>
    <button class="remove-btn" style="width: 94%;
    margin: auto;
    display: block;
    padding: 5px;
    background: red;
    color: white;
    border: none;
    cursor:pointer;
    border-radius: 5px;
    margin-top: 22px;">Remove</button>
`;
            cartContent.appendChild(productDiv);

            // Add product to cartProducts array
            cartProducts.push({
                name: productName,
                price: productPrice,
                quantity: quantity,
                element: productDiv // Store the product's div for removal
            });

            // Show alert message
            alert(`${productName} added to cart successfully`);

            // Clear the input fields
            card.querySelector('.counter').value = 1;

            // Hide the cart modal
            document.querySelector('#cart-modal').style.display = 'none';
            document.querySelector('#cart-overlay').style.display = 'none';
        });
    });

    const cartCloseButton = document.querySelector('#cart-closeModalBtn');
    cartCloseButton.addEventListener('click', function () {
        document.querySelector('#cart-modal').style.display = 'none';
        document.querySelector('#cart-overlay').style.display = 'none';
    });


    const checkoutButton = document.querySelector('#cart-check');
checkoutButton.addEventListener('click', function () {
    if (cartProducts.length === 0) {
        alert('No products added to the cart!');
        return;
    }

    // Construct the URL with product details
    let url = 'checkout.php?';
    window.location.href = url;
    cartProducts.forEach((product, index) => {
        url += `name${index}=${encodeURIComponent(product.name)}&price${index}=${encodeURIComponent(product.price)}&quantity${index}=${encodeURIComponent(product.quantity)}&`;
    });
    window.location.href = url;
});


    // Add event listener to remove buttons
    document.addEventListener('click', function (event) {
        if (event.target.classList.contains('remove-btn')) {
            const productDiv = event.target.parentElement;
            const index = cartProducts.findIndex(product => product.element === productDiv);
            if (index !== -1) {
                cartProducts.splice(index, 1); // Remove product from cartProducts array
                productDiv.remove(); // Remove product's div from the cart
            }
        }
    });
});
