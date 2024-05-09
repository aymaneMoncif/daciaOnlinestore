// Retrieve the creation date from the data attribute
const creationDateString = document.getElementById("creationDate").dataset.creation;

// Convert the creation date string to a JavaScript Date object
const creationDate = new Date(creationDateString);

// Function to update the elapsed time
function updateElapsedTime() {
    const currentTime = new Date();
    const elapsedTime = currentTime - creationDate;

    const seconds = Math.floor((elapsedTime / 1000) % 60);
    const minutes = Math.floor((elapsedTime / (1000 * 60)) % 60);
    const hours = Math.floor((elapsedTime / (1000 * 60 * 60)) % 24);
    const days = Math.floor(elapsedTime / (1000 * 60 * 60 * 24));

    // Update the HTML elements with the elapsed time
    document.getElementById("days").innerText = days.toString().padStart(2, '0');
    document.getElementById("hours").innerText = hours.toString().padStart(2, '0');
    document.getElementById("minutes").innerText = minutes.toString().padStart(2, '0');
    document.getElementById("seconds").innerText = seconds.toString().padStart(2, '0');

    document.getElementById("daysM").innerText = days.toString().padStart(2, '0');
    document.getElementById("hoursM").innerText = hours.toString().padStart(2, '0');
    document.getElementById("minutesM").innerText = minutes.toString().padStart(2, '0');
    document.getElementById("secondsM").innerText = seconds.toString().padStart(2, '0');

    // Check if comptableValidation is 1 and stop counting if true
    if (comptableValidation === 1) {
        clearInterval(interval);
    }
}


// Update the elapsed time every second
const interval = setInterval(updateElapsedTime, 1000);

// Initial update
updateElapsedTime();