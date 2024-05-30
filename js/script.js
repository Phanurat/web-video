document.addEventListener('DOMContentLoaded', function() {
    console.log("JavaScript is loaded and running.");

    // Example function to handle button clicks, if you have any buttons
    const buttons = document.querySelectorAll('button');
    buttons.forEach(button => {
        button.addEventListener('click', function() {
            alert('Button clicked!');
        });
    });

    // Example: Dynamic video loading or any other functionality
    // Add more JavaScript functionalities here as needed
});
