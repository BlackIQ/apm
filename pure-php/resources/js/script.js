// Init localstorage | Clipboard
lStorage = window.localStorage;
url = new URL(window.location.href);

// Logout link
logoutUrl = "?logout=true";

// DataTable init
$(document).ready(function () {
    // DataTable
    $('#example-table').DataTable({
        "language": {
            searchPlaceholder: "رکورد را جستوجو کنید",
            url: "resources/json/fa.json",
        },
    });
    // Open modal by get method
    if (url.searchParams.get('open-example')) {
        $('#example').modal('show');
    }
    // Open modal by user click
    $('#open-example').click(function () {
        $('#example').modal('show');
    });
});

// -- Functions --

// Move user somewhere else
function changeUrl(url) {
    window.location.replace(url);
}

// Insert method for LS
function create(key, value) {
    lStorage.setItem(key, value);
}

// Select method for LS
function read(key) {
    return lStorage.getItem(key);
}

// Update method for LS
function update(key, value) {
    lStorage.setItem(key, value);
}

// Delete method for LS
function del(key) {
    lStorage.removeItem(key);
}

// Change tabs
function show(shown, hidden) {
    document.getElementById(shown).style.display = 'block';
    document.getElementById(hidden).style.display = 'none';
    return false;
}

// -- Clicks events --

// -- Shortcuts --

// Set ctrl + h = Hi
function hi(e) {
    if (e.key === 'h') {
        $('#hi').modal('show');
    }
}

// Add event handler
document.addEventListener('keyup', hi, false);