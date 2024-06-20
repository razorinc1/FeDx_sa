function updateDates() {
    let currentDate = new Date();
    let delayedCurrentDate = new Date(currentDate.getTime() - (48 * 60 * 60 * 1000)); // 48 hours ago
    let receivedByFedexDate = new Date(currentDate.getTime() - (28 * 60 * 60 * 1000)); // 28 hours ago
    let shippedDate = new Date(currentDate.getTime() - (26 * 60 * 60 * 1000)); // 26 hours ago
    let arrivedDate = new Date(currentDate.getTime() - (4 * 60 * 60 * 1000)); // 26 hours ago
    let outDeliveryDate = new Date(currentDate.getTime() + (12 * 60 * 60 * 1000)); // 12 hours from now
    let deliveredDate = new Date(currentDate.getTime() + (24 * 60 * 60 * 1000)); // 24 hours from now

    document.getElementById('order-placed-date').textContent = delayedCurrentDate.toLocaleDateString('en-US');
    document.getElementById('received-by-fedex-date').textContent = receivedByFedexDate.toLocaleDateString('en-US');
    document.getElementById('shipped-date').textContent = shippedDate.toLocaleDateString('en-US');
    document.getElementById('arrived-date').textContent = arrivedDate.toLocaleDateString('en-US');
    document.getElementById('delayed-current-date').textContent = currentDate.toLocaleString('en-US');
    document.getElementById('out-delivery-date').textContent = outDeliveryDate.toLocaleString('en-US');
    document.getElementById('delivered-date').textContent = deliveredDate.toLocaleString('en-US');
}

// Call `updateDates` once immediately to show the dates right away
updateDates();

// Call `updateDates` every second to keep the dates updated 
setInterval(updateDates, 1000);
